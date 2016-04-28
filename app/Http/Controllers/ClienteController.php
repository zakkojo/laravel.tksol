<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ClientiRequest;
use App\Cliente;
use App\Contratto;

use Illuminate\Support\Facades\Auth;
use Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;


class ClienteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clienti = Cliente::all();

        return view('clienti.index')->with(compact('clienti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('clienti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ClientiRequest $request)
    {
        $data = $request->all();
        $ret = Cliente::create($data);

        return redirect()->action('ClienteController@edit', $ret->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clienti.show')->with(compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clienti.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, ClientiRequest $request)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->action('ClienteController@edit', $id);
    }

    public function associa($id_cliente)
    {
        if ($cliente = Cliente::findOrFail($id_cliente))
            return view('contatti.create')->with(compact('cliente'));
        else
            abort(404);
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

    public function ajaxGetContratti()
    {
        //return Cliente::with('contratti.progetto')->where('id',Input::get('cliente_id'))->first();
        //return Contratto::with('progetto')->where('cliente_id', Input::get('cliente_id'))->get();

        $user = Input::get('user');

        return Contratto::with('progetto')->where('cliente_id', Input::get('cliente_id'))->whereHas('consulenti', function ($query) use ($user)
        {
            $query->where('consulente_id', $user);
        })->get();

    }
    
}

?>