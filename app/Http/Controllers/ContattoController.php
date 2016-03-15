<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ContattiRequest;
use App\Contatto;
use App\User;

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
        $user = User::create(['email'=>$request->email, 'password' => bcrypt('tksol'), 'tipo_utente' => '2']);
        $contatto =  Contatto::create($data);
        $contatto->user()->associate($user->id);
        $contatto->save();
        $user->delete();
        return redirect()->action('ClienteController@show',$contatto->cliente_id);

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