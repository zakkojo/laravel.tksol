<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\ContrattoProdotto;
use App\Contratto;
use App\Prodotto;
use App\Cliente;
use App\Http\Requests\ContrattiProdottiRequest;

class ContrattoProdottoController extends Controller {

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
        $softwarehouse = Cliente::getSoftwarehouse();
        $prodotti = Prodotto::all();

        return view('contrattiProdotti.create', compact('contratto', 'softwarehouse','prodotti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ContrattiProdottiRequest $request)
    {
        $data = $request->all();
        $ret = ContrattoProdotto::create($data);
        return redirect()->action('ContrattoController@edit', $data['contratto_id']);
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
    public function edit($contratto_id,$id)
    {
        $listinoProdotto = ContrattoProdotto::findOrFail($id);
        $softwarehouse = Cliente::getSoftwarehouse();
        $prodotti = Prodotto::all();
        $contratto = Contratto::findOrFail($contratto_id);
        return view('contrattiProdotti.edit', compact('contratto', 'listinoProdotto','softwarehouse','prodotti'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ContrattiProdottiRequest $request, $contratto_id, $id)
    {
        $listinoIntertvento = ContrattoProdotto::findOrFail($id);
        $listinoIntertvento->update($request->all());
        return redirect()->action('ContrattoController@edit', $contratto_id);
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

}

?>