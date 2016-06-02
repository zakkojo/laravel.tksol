<?php namespace App\Http\Controllers;

use App\Consulente;
use App\ConsulenteContratto;
use App\Contratto;
use App\Http\Requests\ConsulentiContrattiRequest;


class ConsulenteContrattoController extends Controller {


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
        $consulenti = Consulente::all();
        $contratto = Contratto::findOrFail($contratto_id);

        return view('consulentiContratti.create', compact('contratto','consulenti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ConsulentiContrattiRequest $request)
    {
        $data = $request->all();
        $ret = ConsulenteContratto::create($data);
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
        $consulenteContratto = ConsulenteContratto::findOrFail($id);
        $consulenti = Consulente::all();
        return view('consulentiContratti.edit', compact('consulenteContratto','consulenti'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ConsulentiContrattiRequest $request,$contratto_id, $id)
    {
        $consulenteContratto = ConsulenteContratto::findOrFail($id);
        $consulenteContratto->update($request->all());
        $consulenteContratto->save();
        
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