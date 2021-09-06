<?php namespace App\Http\Controllers;

use App\Contratto;
use App\Http\Requests;
use App\Http\Requests\ConsulentiRequest;
use App\Consulente;
use App\Intervento;
use App\User;

use Carbon\Carbon;
use DB;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class ConsulenteController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $consulenti = Consulente::all();

        return view('consulenti.index')->with(compact('consulenti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('consulenti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ConsulentiRequest $request)
    {
        $data = $request->all();
        $user = User::create(['email' => $request->email, 'password' => bcrypt('tksol'), 'tipo_utente' => '1']);
        $consulente = Consulente::create($data);
        $consulente->user()->associate($user->id);
        $consulente->save();

        return redirect()->action('ConsulenteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $consulente = Consulente::findOrFail($id);
        $prossimiInterventi = Intervento::whereRaw("user_id = '".$consulente->user->id."' AND data_start >= now() AND data_start <= (CURDATE() + INTERVAL 30 DAY) AND inviato = 0 AND approvato = 0")->orderBy('data_start')->get();
        //$rapportiniDaInviare = Intervento::where('consulente_id', '=', $consulente->id)->where('stampa', '<', '2');
        $contrattiSenzaInterventi = DB::select("
            SELECT c.id contratto_id, ragione_sociale, pro.nome, min(data_start) data_prossimo_intervento 
            FROM contratto c
            JOIN cliente cli ON (c.cliente_id = cli.id)
            JOIN progetto pro ON (c.progetto_id = pro.id)
            LEFT JOIN contratto_intervento ci on (c.id = ci.contratto_id) 
            LEFT JOIN consulente_contratto cc on (cc.contratto_id = c.id) 
            LEFT JOIN intervento i ON (i.listino_id = ci.id AND i.data_start > '" . Carbon::now() . "') 
            WHERE cc.consulente_id = '" . $consulente->id . "'
            AND c.stato <> 'CLOSED' 
            AND c.deleted_at is null
            AND cc.ruolo = 'Capo Progetto'
            GROUP BY c.id,ragione_sociale, pro.nome
            HAVING (data_prossimo_intervento >= '" . Carbon::now()->addMonths(2) . "' OR data_prossimo_intervento is null)
        ");

        //$interventiDaApprovare = Intervento::where('consulente_id',$consulente->id)->whereRaw('consulente_id <> creatore_id')->whereRaw('data_accettazione is null')->get();


        return view('consulenti.show', compact('consulente', 'prossimiInterventi', 'contrattiSenzaInterventi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $consulente = Consulente::findOrFail($id);
        $consulente->email = $consulente->user()->withTrashed()->first()->email;

        return view('consulenti.edit', compact('consulente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, ConsulentiRequest $request)
    {
        $consulente = Consulente::findOrFail($id);
        $consulente->update($request->all());
        $user = User::withTrashed()->where('email', '=', $request->user_email)->firstOrFail();
        $user->email = $request->email;
        $user->save();

        return redirect()->action('ConsulenteController@index');
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


    public function ajaxGetConsulente()
    {
        $consulente = Consulente::findOrFail(Input::get('id'));

        return $consulente;
    }

    public function ajaxGetContratti()
    {
        $user_id = Input::get('user_id');
        $cliente_id = Input::get('cliente_id');
        $consulente = User::findOrFail($user_id)->consulente;


        if ($consulente->tipo == 'Partner') {
            return Contratto::with('progetto')->where('cliente_id', $cliente_id)->get();
        } else {
            //return Contratto::with('progetto','consulenti')->where('cliente_id', $cliente_id)->get();
            //$contratti = User::find($user)->consulente->contratti;
            $contratti = Contratto::with('progetto')->whereRaw("stato <> 'CLOSED' AND (DATE(data_chiusura_progetto) >= '".Carbon::today()->format('Y-m-d')."' OR data_chiusura_progetto IS NULL)")
                ->whereHas('consulenti', function ($query) use ($consulente) {
                    $query->where('consulente_id', $consulente->id);
                })
                ->where('cliente_id', $cliente_id)->get();
            return $contratti;
        }
    }

    public function ajaxGetInterventiDaApprovare()
    {
        $consulente = Auth::User()->consulente;
        $daApprovare=0;
        $consulente->contrattiDaFatturare->each(function ($contratto, $key) use (&$daApprovare) {
            if ($contratto->interventiDaApprovare) {
                $daApprovare = $daApprovare + $contratto->interventiDaApprovare->count();
            }
        });
        return $daApprovare;
    }
}
