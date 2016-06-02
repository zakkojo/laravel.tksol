<?php

namespace App\Http\Controllers;
use App\ConsulenteContratto;
use App\Http\Requests;
use App\Cliente;
use App\Progetto;
use App\Consulente;
use App\Contratto;
use App\Http\Requests\ContrattiRequest;
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
        $clienti = Cliente::all();
        $progetti = Progetto::all();
        $consulenti = Consulente::all();

        return view('contratti.create', compact('clienti', 'progetti', 'consulenti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ContrattiRequest $request)
    {
        $data = $request->all();
        $ret = Contratto::create($data);
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
        $clienti = Cliente::all();
        $progetti = Progetto::all();
        $contratto = Contratto::findOrFail($id);
        $consulentiContratto = ConsulenteContratto::with('consulente')->where('contratto_id',$id)->get();
        return view('contratti.edit', compact('contratto', 'clienti', 'progetti', 'consulentiContratto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, ContrattiRequest $request)
    {
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

    }

    public function ajaxGetListinoInterventi()
    {
        $contratto = Contratto::findOrFail(Input::get('contratto_id'));
        return $contratto->listinoInterventi;
    }

    public function ajaxGetProgetti(){
        return Contratto::with('progetto')->where('id',Input::get('contratto_id'))->get();
    }
}
