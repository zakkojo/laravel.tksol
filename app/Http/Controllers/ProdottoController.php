<?php namespace App\Http\Controllers;

use App\Http\Requests\ProdottiRequest;
use App\Prodotto;

class ProdottoController extends Controller {

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
        $prodotti = Prodotto::all();

        return view('prodotti.index')->with(compact('prodotti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('prodotti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ProdottiRequest $request)
    {
        $data = $request->all();
        $ret = Prodotto::create($data);

        return redirect()->action('ProdottoController@index');
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
    public function edit($id)
    {
        $prodotto = Prodotto::findOrFail($id);

        return view('prodotti.edit', compact('prodotto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(ProdottiRequest $request,$id)
    {
        if ($prodotto = Prodotto::findOrFail($id))
        {
            $prodotto->update($request->all());
            return redirect()->action('ProdottoController@index');
        } else
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

}

?>