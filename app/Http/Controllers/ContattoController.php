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
  public function index()
  {
      return view('contatti.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      return view('contatti.create');  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(ContattiRequest $request)
  {
      $data = $request->all();
      $ret =  Contatto::create($data);
      return redirect()->action('ContattoController@edit', $ret->id);
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
      return view('contatti.edit', compact('contatto'));
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
      return redirect()->action('ContattoController@edit', $id);
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