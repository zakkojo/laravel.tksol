<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Requests\ConsulentiRequest;
use App\Consulente;

use Request;


class ConsulenteController extends Controller {

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
    return view('consulenti.index');
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
      $ret =  Consulente::create($data);
      return redirect()->action('ConsulenteController@edit', $ret->id);

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
      return redirect()->action('ConsulenteController@edit', $id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $consulente = Consulente::findOrFail($id);
      return view('consulenti.edit', compact('consulente'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, ConsulentiRequest $request)
  {
      $consulente = Consulente::findOrFail($id);
      $consulente->update($request->all());
      return redirect()->action('ConsulenteController@edit', $id);
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