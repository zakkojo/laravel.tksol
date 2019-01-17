<?php namespace App\Http\Controllers;

use App\Cliente;
use App\Consulente;
use App\User;
use App\ContrattoIntervento;
use App\Http\Requests\AjaxInterventiRequest;
use App\Http\Requests\InterventiEstrazioneXlsxRequest;
use App\Http\Requests\InterventiRequest;
use App\Intervento;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Excel;
use DB;
use Html2Text\Html2Text;
use App\Exports\DaFatturareExport;
use App\Exports\InterventiExport;
use App\Imports\FattureGammaImport;
use Illuminate\Pagination\LengthAwarePaginator;

class InterventoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return redirect()->action('InterventoController@create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $consulenti = Consulente::all();
        //$clienti = Cliente::all();
        $consulente_id = Auth::user()->consulente->id;
        $clienti = Cliente::fromQuery("
            SELECT cli.* FROM laravel_tksol.cliente cli
            JOIN contratto con ON con.cliente_id = cli.id
            JOIN consulente_contratto cc ON cc.contratto_id = con.id
            WHERE cc.consulente_id = '{$consulente_id}'
            AND con.stato <> 'CLOSED' AND (DATE(con.data_chiusura_progetto) >= '".Carbon::today()->format('Y-m-d')."' OR con.data_chiusura_progetto IS NULL)
            AND cli.deleted_at IS NULL
            AND con.deleted_at IS NULL
            ORDER BY cli.ragione_sociale");

        return view('interventi.planning', compact('consulenti', 'clienti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(InterventiRequest $request)
    {
        $request->request->add(['data_modifica' => Carbon::now()]);
        $request->request->add(['creatore_id' => Auth::User()->id]);
        $request->request->add(['contratto_id' => ContrattoIntervento::findOrFail($request->listinoContratto)->contratto->id]);
        if (ContrattoIntervento::findOrFail($request->listinoContratto)->contratto->fatturazione_default)
        {
            $request->request->add(['fatturabile' => 1]);
        } else
        {
            $request->request->add(['fatturabile' => 0]);
        }
        $data = $request->all();
        if (Intervento::create($data))
        {
            return true;
        } else
        {
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $intervento = Intervento::findOrFail($id);
        //return $intervento;
        if ($intervento->fatturato == 1 or session()->get('stampaIntervento') == $intervento->id)
        {
            if (session()->get('stampaIntervento'))
            {
                session()->forget('stampaIntervento');
            }

            return view('interventi.inviaStampa', compact('intervento'));
        } else
        {
            return redirect('/interventi/' . $id . '/edit');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $intervento = Intervento::findOrFail($id);
        $user = $intervento->user;
        $cliente = $intervento->listinoInterventi->contratto->cliente;
        $contratto = $intervento->listinoInterventi->contratto;
        $rimborsi = $intervento->rimborsi;

        return view('interventi.edit', compact('intervento', 'consulente', 'cliente', 'rimborsi', 'user', 'contratto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(InterventiRequest $request, $id)
    {
        //return Input::all();
        $intervento = Intervento::findOrFail($id);
        //if (Carbon::now()->gte(Carbon::parse($intervento->data_start))) //update orari solo dopo inizio evento
        //{
        $intervento->user_id_modifica = Auth::User()->id;
        $intervento->contratto_id = $intervento->listinoInterventi_wt->contratto->id;
        $intervento->listino_id = Input::get('listinoContratto');
        $intervento->user_id = Input::get('user_id');
        $intervento->attivita_id = Input::get('attivita');

        $intervento->attivitaPianificate = Input::get('attivitaPianificate');
        $intervento->attivitaSvolte = Input::get('attivitaSvolte');
        $intervento->attivitaCaricoCliente = Input::get('attivitaCaricoCliente');
        $intervento->problemiAperti = Input::get('problemiAperti');
        $intervento->sede = Input::get('sede');

        if (Input::get('fatturabile'))
        {
            $fatturabile = 1;
        } else
        {
            $fatturabile = 0;
        }
        $intervento->fatturabile = $fatturabile;
        //se l'intervento è iniziato secondo calendario posso aggioranre l'oraio di lavoro effettivo
        if (Carbon::now()->gte(Carbon::parse($intervento->data_start)))
        {
            $intervento->data_start_reale = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_start_reale'));
            $intervento->data_end_reale = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_end_reale'));
            $intervento->ore_lavorate = Input::get('ore_lavorate');
            $intervento->ore_fatturate = Input::get('ore_lavorate');
        }
        //dd($request->all());
        $intervento->save();

        //se clicco sul pulsante stampa o chiudi
        if (Input::get('stampa') == 1)
        {
            //se posso pianificare e è necessario
            if (Auth::user()->consulente->canPianificare($intervento->contratto->id) and $intervento->contratto->ripianifica == 1)
            {
                $prossimiInterventi = $intervento->contratto->prossimiInterventi;
                //se non ci sono prossimiInterventi
                //dd(count($prossimiInterventi));
                if (count($prossimiInterventi) == 0)
                {
                    //altrimenti chiedo l'inserimento del prossimo intervento
                    //session()->flash('attivita', str_replace("\r\n","",Input::get('problemiAperti')));
                    session()->flash('stampaIntervento', $id);
                    //{"filtro_calendar":{"clienti":[1,2,3,4], "consulenti":[1,2,3,4]}}
                    $filtroCalendar = new \stdClass();
                    $filtroCalendar->clienti = [$intervento->contratto->cliente->id => ''];
                    //$filtroCalendar->consulenti = [];
                    session()->flash('ripianifica', json_encode($filtroCalendar, true));

                    return redirect()->action('InterventoController@create', ['data' => Carbon::parse($intervento->data_start)->format('Y-m-d'), 'eventId' => $id]);
                }
            }
            //se è necessario inviare il rapportino
            if ($intervento->contratto->rapportino == 1)
            {
                return view('interventi.inviaStampa', compact('intervento'));
            } else
            {
                $intervento->inviato = 1;
                $intervento->save();

                return redirect('/interventi/create');
            }
        }
        //}
        $intervento->save();

        return redirect('/interventi/' . $id . '/edit');
    }

    public function stampa($id)
    {
        $intervento = Intervento::findOrFail($id);
        $pdf = SnappyPdf::loadView('interventi.' . $intervento->contratto->societa->file_stampa, compact('intervento'))->setOption('encoding', 'utf-8');

        return $pdf->setPaper('a5')->setOption('margin-bottom', 0)->setOption('margin-top', 0)->setOption('margin-left', 0)->setOption('margin-right', 0)->inline();
    }

    public function invia($id)
    {
        $intervento = Intervento::findOrFail($id);
        $intervento->contratto_id = $intervento->listinoInterventi_wt->contratto->id;
        if (Input::get('invia') != 1)
        {
            return view('interventi.inviaStampa', compact('intervento'));
        }
        $recipients = Input::get('recipients');
        $intervento->stampa = 1;
        $intervento->inviato = 1;
        if (config('app.debug') == false)
        {
            $user = Auth::user();
            $pdf = SnappyPdf::loadView('interventi.' . $intervento->contratto->societa->file_stampa, compact('intervento'));

            $base_path = base_path();
            $pdf->save($base_path . '/resources/tmp/rapportino_' . $id . '.pdf', true);
            $societa = $intervento->contratto->societa;
            Mail::send('email.inviaRapportino', compact('intervento'), function ($m) use ($user, $societa, $id, $base_path, $recipients)
            {
                $m->from($societa->email, 'Rapportini ' . $societa->nome);
                $m->replyTo($user->email, $user->consulente->nominativo);
                if (config('app.customer_email'))
                {
                    if (is_array($recipients))
                    {
                        foreach ($recipients as $recipient)
                        {
                            if ($recipient)
                            {
                                $m->to($recipient);
                            }
                        }
                    }
                    $m->subject('Rapportino ' . $societa->nome);
                } else
                {
                    $m->subject('***NON INVIATO AL CLIENTE*** Rapportino ' . $societa->nome);
                }
                $m->bcc($user->email, $user->consulente->nominativo);
                $m->attach($base_path . '/resources/tmp/rapportino_' . $id . '.pdf');
            });
        }
        $intervento->save();

        return ['status' => 'success'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
    }

    /*public function ajaxAcceptIntervento()
    {
        $id = Input::get('id');
        $intervento = Intervento::findOrFail($id);
        if (Auth::User()->consulente->id == $intervento->consulente_id AND !$intervento->data_accettazione)
        {
            $intervento->data_accettazione = Carbon::now();
            $intervento->save();

            return ['status' => 'success', 'result' => true];
        } else return ['status' => 'Non autorizzato', 'result' => false];
    }*/

    public function approvaIntervento()
    {
        $consulente = Auth::User()->consulente;
        $daApprovare = collect();
        $consulente->contrattiDaFatturare->each(function ($contratto, $key) use ($daApprovare)
        {
            $contratto->interventiDaApprovare->each(function ($intervento, $key) use ($daApprovare)
            {
                $daApprovare->push($intervento);
            });
        });

        return view('interventi.approva', compact('daApprovare'));
    }

    public function registraFattura()
    {
        $page = Input::get('page', '1');
        //$daFatturare = Intervento::whereNull('fatturato')->where('approvato', '1')->get();
        $paginate = Input::get('paginate', '100');
        //$daFatturare = Intervento::whereRaw('approvato = "1" AND ore_fatturate <> 0 AND ( fatturato is null OR data_fattura is null)')->orderBy('data_start', 'desc')->paginate($paginate);


        if (Input::get('di'))
            $wdi = ' AND i.data_start >= STR_TO_DATE("' . Input::get('di') . '", "%d/%m/%Y") ';
        else $wdi='';
        if (Input::get('df'))
            $wdf = ' AND i.data_end >= STR_TO_DATE("' . Input::get('df') . '", "%d/%m/%Y") ';
        else $wdf='';
        if (Input::get('filtro'))
            $wfiltro = ' AND  CONCAT_WS(" ", cons.nome, cons.cognome, cli.ragione_sociale, pro.nome, soc.nome, ci.descrizione) like "%' . Input::get('filtro') . '%" ';
        else $wfiltro='';


        $query = DB::select('
        SELECT i.* 
        FROM laravel_tksol.intervento i 				
        JOIN users ON(users.id = i.user_id)						
            JOIN consulente cons ON(cons.user_id = users.id)			
        JOIN contratto_intervento conint ON (i.listino_id = conint.id) 				
            JOIN contratto con ON (conint.contratto_id = con.id) 			
                JOIN cliente cli ON (con.cliente_id = cli.id)		
                JOIN cliente fat ON (con.fatturazione_id = fat.id)				
                JOIN progetto pro ON (con.progetto_id = pro.id)				
                JOIN societa soc ON(con.societa_id = soc.id)				
        JOIN attivita att ON (att.id = i.attivita_id)
        JOIN contratto_intervento ci ON (ci.id = i.listino_id)
        WHERE 
        i.deleted_at IS NULL
        AND i.fatturabile = 1
        AND i.approvato = "1" 
        AND i.ore_fatturate <> 0 
        AND ( i.fatturato IS NULL OR i.fatturato ="" OR i.data_fattura IS NULL OR i.data_fattura = "") ' . $wdi . $wdf . $wfiltro . ' order BY i.data_start DESC');

        $interventi = Intervento::hydrate($query);


        //$currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $interventi->slice($paginate * ($page - 1), $paginate);

        $paginator = new LengthAwarePaginator($currentItems, $interventi->count(), $paginate, $page);
        $paginator->withPath('registraFattura');
        $daFatturare = $paginator->appends(request()->except('page'));
        return view('interventi.registraFattura', compact('daFatturare'));
    }

    public function uploadFattureGamma(Request $request)
    {
        $request->fattureGamma->storeAs('fattureGamma', 'uploadGamma' . Carbon::now()->format('Ymdhis') . '.csv');
        Excel::import(new FattureGammaImport, $request->fattureGamma);

        return redirect()->action('InterventoController@registraFattura');
    }

    public function ajaxRegistraFattura()
    {
        $intervento_id = Input::get('id');
        //$data = Input::has('dataFattura') ? Input::get('dataFattura') : null;
        if (Input::get('dataFattura') == 'Invalid date')
        {
            $data = null;
        } else
        {
            $data = Input::get('dataFattura');
        }
        $numero = Input::has('fatturato') ? Input::get('fatturato') : null;
        $note = Input::has('note') ? Input::get('note') : null;
        $input = Input::all();
        if ($intervento_id)
        {
            $intervento = Intervento::findOrFail($intervento_id);
            if (!($intervento->fatturato and $intervento->data_fattura))
            {
                if ($data)
                {
                    $intervento->data_fattura = $data;
                }
                $intervento->fatturato = $numero;
                $intervento->note_fattura = $note;
                $intervento->save();
                if ($intervento_id and $intervento->data_fattura and $intervento->fatturato)
                {
                    //se ci sono data e numero fattura chiudo la fattura
                    return json_encode(['status' => 'success', 'intervento' => $intervento]); //success = chiudo fattura
                } else
                {
                    return json_encode(['status' => 'update', 'intervento' => $intervento, 'input' => $input]); //aggiorno fattura
                }
            }
        }

        return ['status' => 'errore', 'input' => Input::all()];
    }

    public function ajaxGetCalendar()
    {
        $data_start = Input::get('start');
        $data_end = Input::get('end');
        if ($data_start and $data_end)
        {
            $user_id = Input::get('user_id');
            $cliente_id = Input::get('cliente_id');
            if (Input::get('inviato'))
            {
                $inviato = 1;
            } else
            {
                $inviato = 0;
            }

            $calendario = [];

            if ($user_id and !$cliente_id)
            {
                $where[0][] = ['user_id' => $user_id];
                $calendario = Intervento::where('data_start', '>=', $data_start)->where('data_start', '<=', $data_end)->where($where)->where('inviato', $inviato)->get();
            }
            if ($cliente_id and !$user_id)
            {
                $calendario = Intervento::join('contratto_intervento', 'intervento.listino_id', '=', 'contratto_intervento.id')
                    ->join('contratto', 'contratto_intervento.contratto_id', '=', 'contratto.id')
                    ->where('cliente_id', $cliente_id)
                    ->where('data_start', '>=', $data_start)
                    ->where('data_start', '<=', $data_end)
                    ->where('inviato', $inviato)->get(['intervento.*']);
            }
            if (!$calendario->isEmpty())
            {
                $calendario->each(function ($evento)
                {
                    $intervento = Intervento::findOrFail($evento['id']);
                    $evento['contratto_id'] = '' . $intervento->listinoInterventi_wt->contratto->id;
                    $evento['user_id'] = '' . $intervento->user_id;
                    $evento['cliente_id'] = '' . $intervento->listinoInterventi_wt->contratto->cliente->id;
                    $evento['progetto_id'] = '' . $intervento->listinoInterventi_wt->contratto->progetto->id;
                    $evento['title'] = $intervento->user->consulente->nominativo;
                    $evento['description'] = '<span class="description">' .
                        $intervento->listinoInterventi_wt->contratto->cliente->ragione_sociale .
                        '<br/>' . $intervento->listinoInterventi_wt->contratto->progetto->nome .
                        '<br/>' . $intervento->attivita->descrizione . '</span>';
                    $evento['attivitaPianificate'] = htmlspecialchars_decode($intervento->attivitaPianificate);
                    $evento['start'] = $evento['data_start'];
                    $evento['end'] = $evento['data_end'];
                    $evento['className'] = 'pianificato';

                    return $evento;
                });
            }

            return $calendario;
        }

        return ['msg' => 'errore', 'input' => Input::all()];
    }

    public function ajaxGetIntervento()
    {
        $intervento = Intervento::find(Input::get('id'));

        $intervento->contratto_id = $intervento->listinoInterventi_wt->contratto->id;
        $intervento->cliente_id = $intervento->listinoInterventi_wt->contratto->cliente->id;
        $intervento->progetto_id = $intervento->listinoInterventi_wt->contratto->progetto->id;

        if ($intervento)
        {
            return ['status' => 'success', 'intervento' => $intervento];
        }

        return ['status' => 'fail'];
    }


    public function ajaxCreateIntervento(AjaxInterventiRequest $request)
    {
        $intervento = new Intervento();
        $intervento->listino_id = Input::get('listinoContratto');
        $intervento->attivita_id = Input::get('attivita');
        $intervento->user_id = Input::get('user_id'); //user id del consulente associato ad intervento
        $intervento->user_id_modifica = Auth::User()->id; //utente che crea l'intervento
        $intervento->attivitaPianificate = Input::get('attivitaPianificate');
        $intervento->data_start = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_start'))->format('Y-m-d H:i:s');
        $intervento->data_end = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_end'))->format('Y-m-d H:i:s');
        $intervento->contratto_id = ContrattoIntervento::findOrFail(Input::get('listinoContratto'))->contratto->id;
        $intervento->fatturabile = ContrattoIntervento::findOrFail(Input::get('listinoContratto'))->contratto->fatturazione_default;
        //if (Input::get('creatore_id') == Input::get('consulente'))
        //    $data['data_accettazione'] = Carbon::now();
        //-------------------------------------------
        $response = $intervento->save();
        //-------------------------------------------
        if ($response)
        {
            if ($id_padre = Input::get('stampaIntervento'))
            {
                $intervento = Intervento::findOrFail($id_padre);
                session(['stampaIntervento' => $id_padre]);
                //session()->set('stampaIntervento', $id_padre); //5.5 fix
                $intervento->stampa = 1;
                if ($intervento->save())
                {
                    return ['status' => 'success', 'action' => 'stampa', 'id_padre' => $id_padre];
                } else
                {
                    return ['status' => 'fail'];
                }
            } else
            {
                return ['status' => 'success', 'msg' => Input::get('stampaIntervento')];
            }

            return ['status' => 'success'];
        }

        return ['status' => 'fail', 'input' => Input::all()];
    }

    public function ajaxUpdateIntervento(AjaxInterventiRequest $request)
    {

        $intervento = Intervento::findOrFail(Input::get('id'));

        $intervento->listino_id = Input::get('listinoContratto');
        $intervento->attivita_id = Input::get('attivita');
        $intervento->user_id = Input::get('user_id'); //user_id del consulente associato ad intervento
        $intervento->user_id_modifica = Auth::User()->id; //utente che effettua l'update
        $intervento->attivitaPianificate = Input::get('attivitaPianificate');
        $intervento->data_start = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_start'))->format('Y-m-d H:i:s');
        $intervento->data_end = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_end'))->format('Y-m-d H:i:s');
        $intervento->contratto_id = $intervento->listinoInterventi_wt->contratto->id;
        $response = $intervento->update();

        if ($response)
        {
            return ['status' => 'success', 'input' => Input::all()];
        }

        return ['status' => 'fail'];
    }

    public function ajaxDeleteIntervento()
    {
        $error = 0;
        $id = Input::get('id');
        $intervento = Intervento::findOrFail($id);
        //intervento non consuntivato
        if ($intervento->inviato == 1)
        {
            $error = 1;
            $msg[] = "Intervento già inviato al cliente";
        }

        //se è necessario ripianificare
        if ($intervento->contratto->ripianifica == '1')
        {
            //intervento futuro stesso contratto <=30gg
            $nextIntervento = $intervento->contratto->prossimiInterventi->first(function ($element, $key) use ($id)
            {
                return ($element['id'] != $id and Carbon::parse($element['data_start'])->gte(Carbon::today()));
            });
            if (is_null($nextIntervento))
            {
                $error = 1;
                $msg[] = "Nessun intervento nei prossimi 30 giorni";
            }
        }
        if ($error == 0)
        {
            $response = $intervento->delete();

            if ($response)
            {
                if (isset($nextIntervento))
                {
                    return ['status' => 'success', $nextIntervento];
                } else
                {
                    return ['status' => 'success'];
                }
            }
        }

        return ['status' => 'fail', 'msg' => $msg];
    }

    public function ajaxGetPermissionUpdatePianificazione()
    {
        $res = Intervento::where('id', Input::get('intervento_id'))->where('consulente_id', Input::get('user_id'))->count();
        /*
        $res = Contratto::where('id',Input::get('contratto_id'))->whereHas('consulenti', function ($query) use ($user)
        {
            $query->where('consulente_id', $user);
        })->count();
        */

        if ($res)
        {
            return ['status' => 'success', 'result' => true];
        } else
        {
            return ['status' => 'success', 'result' => false];
        }
    }

    public function ajaxApprovaIntervento()
    {
        $id = Input::get('id');
        $ore_fatturate = Input::get('ore_approvate');
        $fatturabile = Input::get('fatturabile');

        $intervento = Intervento::findOrFail($id);
        $intervento->ore_fatturate = $ore_fatturate;
        $intervento->fatturabile = $fatturabile;
        $intervento->note_fattura = Input::get('noteFattura');
        $intervento->approvato = Input::get('approva');
//        if ($ore_fatturate != '')
//        {
//            $intervento->approvato = 1;
//        } else
//        {
//            $intervento->approvato = 0;
//        }
        $res = $intervento->save();
        if ($res)
        {
            return ['status' => 'success', 'id' => $id, 'ore' => $ore_fatturate];
        } else
        {
            return ['status' => 'fail', 'id' => $id];
        }
    }

    private function excel_format_cell(&$item1, $key, $val)
    {
        $item1 = str_replace("<br>", "\n", $val);
        $item1 = str_replace("<br/>", "\n", $val);
        $item1 = strip_tags($val);
    }

    public function export_xlsx_daFatturare()
    {
        $filename = 'crm_daFatturare_' . Carbon::now()->format('Ymd') . '.xlsx';

        return Excel::download(new daFatturareExport, $filename);
    }

    public function estrazioneConsulente()
    {
        $consulenti = Consulente::all();
        $clienti = Cliente::all();

        return view('interventi.estrazioneConsulente', compact('consulenti', 'clienti'));
    }

    public function estrazioneConsulenteExportXlsx(InterventiEstrazioneXlsxRequest $request)
    {
        $filtro_consulenti = " ";
        $filtro_clienti = " ";
        $di = Carbon::createFromFormat('d/m/Y', $request->di);
        $df = Carbon::createFromFormat('d/m/Y', $request->df);
        $filtro['data_start'] = $di->format('Y-m-d');
        $filtro['data_end'] = $df->format('Y-m-d');
        if ($consulenti = session()->get('filtri_estrazioneConsulente.consulenti'))
        {
            foreach ($consulenti as $k => $v)
            {
                $k = User::withTrashed()->findorFail($k)->consulente->id;
                $filtro_consulenti .= $k . ',';
            }
            $filtro['consulenti'] = " AND cons.id IN (" . substr($filtro_consulenti, 0, -1) . ") ";

        } else $filtro['consulenti'] = "";
        //
        if ($clienti = session()->get('filtri_estrazioneConsulente.clienti'))
        {
            foreach ($clienti as $k => $v)
            {
                $filtro_clienti .= $k . ',';
            }
            $filtro['clienti'] = " AND cli.id IN (" . substr($filtro_clienti, 0, -1) . ") ";
        } else $filtro['clienti'] = "";

        $filename = 'crm_interventi_' . Carbon::now()->format('Ymd') . '.xlsx';

        return Excel::download(new interventiExport($filtro), $filename);
    }
}
