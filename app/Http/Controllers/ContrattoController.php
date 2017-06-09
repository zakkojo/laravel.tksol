<?php

namespace App\Http\Controllers;

use App\ConsulenteContratto;
use App\Http\Requests;
use App\Cliente;
use App\Progetto;
use App\Consulente;
use App\Contratto;
use App\Societa;
use App\Http\Requests\ContrattiRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class ContrattoController extends Controller {


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $societa = Societa::all();
        $clienti = Cliente::all();
        $progetti = Progetto::all();
        $consulenti = Consulente::all();

        return view('contratti.create', compact('societa','clienti', 'progetti', 'consulenti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ContrattiRequest $request)
    {
        if (!(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin'))
        {
            abort(503, 'Unauthorized action.');
        }
        $data = $request->all();
        $ret = Contratto::create($data);

        $consulenteContratto_data = ['contratto_id'=> $ret->id, 'consulente_id' => Auth::User()->consulente->id, 'ruolo' => 'Capo Progetto'];

        ConsulenteContratto::create($consulenteContratto_data);

        return redirect()->action('ContrattoController@edit', $ret->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $societa = Societa::all();
        $clienti = Cliente::all();
        $progetti = Progetto::all();
        $contratto = Contratto::findOrFail($id);
        $consulentiContratto = ConsulenteContratto::with('consulente')->where('contratto_id', $id)->get();

        return view('contratti.edit', compact('contratto', 'societa','clienti', 'progetti', 'consulentiContratto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, ContrattiRequest $request)
    {
        if (!(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin'))
        {
            abort(503, 'Unauthorized action.');
        }
        //return $request->all();
        $contratto = Contratto::findOrFail($id);
        $contratto->update($request->all());

        return redirect()->action('ContrattoController@edit', $contratto->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin'))
        {
            abort(503, 'Unauthorized action.');
        }
        $cliente_id = Contratto::find($id)->cliente->id;
        $resp = Contratto::destroy($id);

        return redirect()->action('ClienteController@show', $cliente_id);
    }

    public function ajaxGetListinoInterventi()
    {
        $contratto = Contratto::findOrFail(Input::get('contratto_id'));

        return $contratto->listinoInterventi;
    }

    public function ajaxGetProgetti()
    {
        return Contratto::with('progetto')->where('id', Input::get('contratto_id'))->get();
    }
}
