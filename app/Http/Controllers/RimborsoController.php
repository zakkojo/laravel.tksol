<?php 
namespace App\Http\Controllers;

use App\Intervento;
use App\Rimborso;
use App\Http\Requests;
use App\Http\Requests\RimborsiRequest;
use Illuminate\Support\Facades\Auth;


class RimborsoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('rimborsi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($intervento_id)
    {
        $intervento = Intervento::findOrFail($intervento_id);
        return view('rimborsi.create', compact('intervento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RimborsiRequest $request)
    {
        $data = $request->all();
        $ret = Rimborso::create($data);

        return redirect()->action('InterventoController@edit', $data['intervento_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
echo "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($intervento_id,$id)
    {
        $rimborso = Rimborso::findOrFail($id);
        $intervento = Intervento::findOrFail($intervento_id);
        return view('rimborsi.edit',compact('intervento','rimborso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(RimborsiRequest $request,$intervento_id,$id)
    {
        $rimborso = Rimborso::findOrFail($id);
        $rimborso->update($request->all());
        return redirect()->action('InterventoController@edit', $intervento_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(RimborsiRequest $request, $intervento_id, $id)
    {
        Rimborso::destroy($id);
        return redirect()->action('InterventoController@edit', $intervento_id);
    }

}

?>