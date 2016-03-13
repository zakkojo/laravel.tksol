<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ClientiRequest;
use App\Cliente;

use Request;


class ClienteController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      return view('clienti.index');
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
      $ret =  Cliente::create($data);
      return redirect()->action('ClienteController@edit', $ret->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
      return redirect()->action('ClienteController@edit', $id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
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
   * @param  int  $id
   * @return Response
   */
  public function update($id, ClientiRequest $request)
  {
      $cliente = Cliente::findOrFail($id);
      $cliente->update($request->all());
      return redirect()->action('ClienteController@edit', $id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>