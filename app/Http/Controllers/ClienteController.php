<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ClientiRequest;
use App\Cliente;
use App\Contratto;
use App\Societa;
use App\ClienteSocieta;


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
        if ($request->cliente) $request->merge(array('cliente' => 1));
        else $request->merge(array('cliente' => 0));
        if ($request->softwarehouse) $request->merge(array('softwarehouse' => 1));
        else $request->merge(array('softwarehouse' => 0));

        $data = $request->all();
        $ret = Cliente::create($data);

        if(is_array($request->idGamma))
        {
            foreach ($request->idGamma as $societaId => $idGamma)
            {
                ClienteSocieta::updateOrCreate(['cliente_id' => $ret->id, 'societa_id' => $societaId],
                    ['cliente_id' => $ret->id, 'societa_id' => $societaId, 'idGamma' => $idGamma]);
            }
        }
        return redirect()->action('ClienteController@show', $ret->id);
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
        $societas = Societa::all();
        $cliente_societa = ClienteSocieta::where('cliente_id',$id)->get();

        return view('clienti.edit', compact('cliente', 'societas','cliente_societa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, ClientiRequest $request)
    {
        if ($request->cliente) $request->merge(array('cliente' => 1));
        else $request->merge(array('cliente' => 0));
        if ($request->softwarehouse) $request->merge(array('softwarehouse' => 1));
        else $request->merge(array('softwarehouse' => 0));

        $cliente = Cliente::findOrFail($id);
        foreach ($request->idGamma as $societaId => $idGamma)
        {
            ClienteSocieta::updateOrCreate(['cliente_id' => $cliente->id, 'societa_id' => $societaId],
                ['cliente_id' => $cliente->id, 'societa_id' => $societaId, 'idGamma' => $idGamma]);
        }

        $cliente->update($request->all());

        return redirect()->action('ClienteController@show', $id);
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
        if (!(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin'))
        {
            abort(503, 'Unauthorized action.');
        }
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