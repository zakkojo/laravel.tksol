<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\ContrattoIntervento;
use App\Contratto;
use App\Http\Requests\ContrattiInterventiRequest;
class ContrattoInterventoController extends Controller {

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
  public function create($contratto_id)
  {
    $contratto = Contratto::findOrFail($contratto_id);

    return view('contrattiInterventi.create', compact('contratto'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(ContrattiInterventiRequest $request)
  {
      $data = $request->all();
      $ret = ContrattoIntervento::create($data);
      return redirect()->action('ContrattoController@edit', $data['contratto_id']);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($contratto_id,$id)
  {
      $listinoIntervento = ContrattoIntervento::findOrFail($id);
      $contratto = Contratto::findOrFail($contratto_id);
      return view('contrattiInterventi.edit', compact('contratto', 'listinoIntervento'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(ContrattiInterventiRequest $request, $contratto_id, $id)
  {
      $listinoIntertvento = ContrattoIntervento::findOrFail($id);
      $listinoIntertvento->update($request->all());
      return redirect()->action('ContrattoController@edit', $contratto_id);
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