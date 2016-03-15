<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ContattiRequest;
use App\Contatto;

use Request;
class ContattoController extends Controller {

  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(ContattiRequest $request)
  {
      $data = $request->all();
      $contatto =  Contatto::create($data);
      return redirect()->action('ClienteController@show', $contatto->cliente->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
      return redirect()->action('ContattoController@edit', $id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      $contatto = Contatto::findOrFail($id);
      $cliente = $contatto->cliente;
      return view('contatti.edit', compact('contatto','cliente'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id,ContattiRequest $request)
  {
      $contatto = Contatto::findOrFail($id);
      $contatto->update($request->all());
      return redirect()->action('ClienteController@show', $contatto->cliente->id);
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