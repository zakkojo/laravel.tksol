<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ProgettiRequest;
use App\Progetto;
use App\Attivita;

use Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class ProgettoController extends Controller
{
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
        $progetti = Progetto::all();

        return view('progetti.index')->with(compact('progetti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('progetti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ProgettiRequest $request)
    {
        $data = $request->all();
        $progetto = Progetto::create($data);
        return redirect()->action('ProgettoController@edit', compact('progetto'));
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
        $progetto = Progetto::findOrFail($id);
        $listAttivita = Attivita::getDataTree($id);
        return view('progetti.edit', compact('progetto', 'listAttivita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

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

    public function ajaxGetAttivita()
    {
        $progetto = Progetto::findOrFail(Input::get('progetto_id'));
        return $progetto->attivita;
    }

}

?>