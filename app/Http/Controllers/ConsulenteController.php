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
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;


class ConsulenteController extends Controller {


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
        $prossimiInterventi = Intervento::where('consulente_id', '=', $consulente->id)->where('data_start', '>=', date('Y-m-d'));
        //$rapportiniDaInviare = Intervento::where('consulente_id', '=', $consulente->id)->where('stampa', '<', '2');
        $contrattiSenzaInterventi = DB::select("
            SELECT c.id,ragione_sociale, pro.nome, data_start FROM contratto c
            JOIN cliente cli ON (c.cliente_id = cli.id)
            JOIN progetto pro ON (c.progetto_id = pro.id)
            LEFT JOIN contratto_intervento ci on (c.id = ci.contratto_id) 
            LEFT JOIN intervento i ON (i.listino_id = ci.id) 
            WHERE capo_progetto = '".$consulente->id."' AND (data_start >= '".Carbon::now()->addMonths(2)."' OR data_start is null)
        ");

        return view('consulenti.show', compact('consulente', 'prossimiInterventi', 'rapportiniDaInviare', 'contrattiSenzaInterventi'));
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

}

?>