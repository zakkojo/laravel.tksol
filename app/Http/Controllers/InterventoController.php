<?php namespace App\Http\Controllers;

use App\Cliente;
use App\Consulente;
use App\Contratto;
use App\ContrattoIntervento;
use App\Http\Requests\AjaxInterventiRequest;
use App\Http\Requests\InterventiRequest;
use App\Intervento;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        $clienti = Cliente::all();

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
        $data = $request->all();
        if (Intervento::create($data)) return true;
        else return false;
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
        if ($intervento->stampa == 0) return redirect()->action('InterventoController@edit', $id);

        return view('interventi.inviaStampa', compact('intervento'));
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
        $consulente = $intervento->consulente;
        $cliente = $intervento->listinoInterventi->contratto->cliente;
        $contratto = $intervento->listinoInterventi->contratto;
        $rimborsi = $intervento->rimborsi;
        $user = Consulente::findOrFail(Auth::User()->consulente->id);

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

        $intervento = Intervento::findOrFail($id);

        $intervento->data_modifica = Carbon::now();
        $intervento->creatore_id = Auth::User()->id;

        $intervento->listino_id = Input::get('listinoContratto');
        $intervento->consulente_id = Input::get('consulente_id');
        $intervento->attivita_id = Input::get('attivita');

        $intervento->attivitaPianificate = Input::get('attivitaPianificate');
        $intervento->attivitaSvolte = Input::get('attivitaSvolte');
        $intervento->attivitaCaricoCliente = Input::get('attivitaCaricoCliente');
        $intervento->problemiAperti = Input::get('problemiAperti');
        $intervento->sede = Input::get('sede');

        if (Input::get('fatturabile') == 'on') $fatturabile = 1; else $fatturabile = 0;
        $intervento->fatturabile = $fatturabile;

        $intervento->data_start_reale = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_start_reale'));
        $intervento->data_end_reale = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_end_reale'));
        $intervento->save();
        //se clicco sul pulsante stampa
        if (Input::get('stampa') == 1)
        {
            $temp = Intervento::join('contratto_intervento', 'intervento.listino_id', '=', 'contratto_intervento.id')->where('intervento.id', $intervento->id)->get(['contratto_intervento.contratto_id'])->first();
            $prossimoIntervento = Intervento::join('contratto_intervento', 'intervento.listino_id', '=', 'contratto_intervento.id')
                ->where('contratto_intervento.contratto_id', $temp->contratto_id)
                ->where('data_start', '>', $intervento->data_start_reale)
                ->where('stampa', '<>', '1')->get();
            //return $prossimoIntervento;
            //se è già pianificato un intervento
            if (!empty($prossimoIntervento))
            {
                $intervento->stampa = 1;
                $intervento->save();

                return redirect()->action('InterventoController@show', $id);
            } else
            {
                //altrimenti chiedo l'inserimento del prossimo intervento
                session()->flash('attivita', Input::get('problemiAperti'));
                session()->flash('stampaIntervento', $id);

                return redirect()->action('InterventoController@create');
            }
        } else
        {
            return redirect()->action('InterventoController@edit', $id);
        }
    }

    public function stampa($id)
    {
        $intervento = Intervento::findOrFail($id);

        $pdf = SnappyPdf::loadView('interventi.stampa', compact('intervento'));

        return $pdf->setPaper('a5')->setOption('margin-bottom', 0)->setOption('margin-top', 0)->setOption('margin-left', 0)->setOption('margin-right', 0)->inline();
    }

    public function invia($id)
    {
        $recipients = Input::get('recipients');
        $intervento = Intervento::findOrFail($id);
        $user = Auth::user();
        $pdf = SnappyPdf::loadView('interventi.stampa', compact('intervento'));

        $base_path = base_path();
        $pdf->save($base_path . '/resources/tmp/rapportino_' . $id . '.pdf', true);

        Mail::send('email.inviaRapportino', compact('intervento'), function ($m) use ($user, $id, $base_path, $recipients)
        {
            $m->from('rapportini@tksol.net', 'Rapportini Teikos Solutions');
            $m->replyTo($user->email, $user->consulente->nominativo);
            foreach ($recipients as $recipient)
            {
                if ($recipient) $m->to($recipient);
            }
            $m->bcc($user->email, $user->consulente->nominativo);
            $m->subject('Rapportino Teikos Solutions');
            $m->attach($base_path . '/resources/tmp/rapportino_' . $id . '.pdf');
        });

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


    public function ajaxGetCalendar()
    {
        $data_start = Input::get('start');
        $data_end = Input::get('end');
        if ($data_start AND $data_end)
        {
            $consulente_id = Input::get('consulente_id');
            $cliente_id = Input::get('cliente_id');
            if (Input::get('stampa')) $stampa = 1;
            else $stampa = 0;

            $calendario = [];

            if ($consulente_id AND !$cliente_id)
            {
                $where[0][] = ['consulente_id' => $consulente_id];
                $calendario = Intervento::where('data_start', '>=', $data_start)->where('data_start', '<=', $data_end)->where($where)->where('stampa', $stampa)->get();
            }
            if ($cliente_id AND !$consulente_id)
            {
                $calendario = Intervento::join('contratto_intervento', 'intervento.listino_id', '=', 'contratto_intervento.id')
                    ->join('contratto', 'contratto_intervento.contratto_id', '=', 'contratto.id')
                    ->where('cliente_id', $cliente_id)
                    ->where('data_start', '>=', $data_start)
                    ->where('data_start', '<=', $data_end)
                    ->where('stampa', $stampa)->get(['intervento.*']);

            }
            if ($calendario != [])
            {
                $calendario->each(function ($evento)
                {
                    $intervento = Intervento::findOrFail($evento['id']);
                    $evento['contratto_id'] = '' . $intervento->listinoInterventi_wt->contratto->id;
                    $evento['consulente_id'] = '' . $intervento->consulente->id;
                    $evento['cliente_id'] = '' . $intervento->listinoInterventi_wt->contratto->cliente->id;
                    $evento['progetto_id'] = '' . $intervento->listinoInterventi_wt->contratto->progetto->id;
                    $evento['title'] = $intervento->consulente->nominativo;
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

        return ['msg' => 'errore', 'start' => $data_start];
    }

    public function ajaxCreateIntervento(AjaxInterventiRequest $request)
    {
        $data = [
            'listino_id'          => Input::get('listinoContratto'),
            'attivita_id'         => Input::get('attivita'),
            'consulente_id'       => Input::get('consulente'),
            'attivitaPianificate' => Input::get('attivitaPianificate'),
            'data_start'          => Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_start'))->format('Y-m-d H:i:s'),
            'data_end'            => Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_end'))->format('Y-m-d H:i:s'),
            'data_modifica'       => Carbon::now(),
            'creatore_id'         => Input::get('creatore_id'),
        ];
        //if (Input::get('creatore_id') == Input::get('consulente'))
        //    $data['data_accettazione'] = Carbon::now();
        //-------------------------------------------
        $response = Intervento::create($data);
        $response->intervento_id = $response->id;
        $response->save();
        //-------------------------------------------
        if ($response)
        {
            if ($id_padre = Input::get('stampaIntervento'))
            {
                $intervento = Intervento::findOrFail($id_padre);
                $intervento->stampa = 1;
                if ($intervento->save())
                {
                    return ['status' => 'success', 'action' => 'stampa', 'id_padre' => $id_padre];
                } else return ['status' => 'fail'];
            } else return ['status' => 'success', 'msg' => Input::get('stampaIntervento')];

            return ['status' => 'success'];
        }

        return ['status' => 'fail'];
    }

    public function ajaxUpdateIntervento(AjaxInterventiRequest $request)
    {
        $intervento = Intervento::findOrFail(Input::get('id'));

        $intervento->listino_id = Input::get('listinoContratto');
        $intervento->attivita_id = Input::get('attivita');
        $intervento->consulente_id = Input::get('consulente');
        $intervento->attivitaPianificate = Input::get('attivitaPianificate');
        $intervento->data_start = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_start'))->format('Y-m-d H:i:s');
        $intervento->data_end = Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_end'))->format('Y-m-d H:i:s');
        $intervento->data_modifica = Carbon::now();
        $intervento->creatore_id = Auth::User()->id;

        $response = $intervento->storicizza();

        if ($response) return ['status' => 'success'];

        return ['status' => 'fail'];
    }

    public function ajaxDeleteIntervento(AjaxInterventiRequest $request)
    {
        $response = Intervento::destroy(Input::get('id'));

        if ($response) return ['status' => 'success'];

        return ['status' => 'fail'];
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

        if ($res) return ['status' => 'success', 'result' => true];
        else return ['status' => 'success', 'result' => false];

    }

}

?>