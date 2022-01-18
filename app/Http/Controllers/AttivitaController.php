<?php namespace App\Http\Controllers;

use App\Http\Requests\AttivitaRequest;
use App\Attivita;
use App\Progetto;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class AttivitaController extends Controller
{
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
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(AttivitaRequest $request)
    {
        if (!(Auth::User()->consulente->tipo == 'Partner' or Auth::User()->consulente->tipo == 'Admin')) {
            abort(503, 'Unauthorized action.');
        }
        $data = $request->all();
        Attivita::create($data);
        $attivita = Attivita::find($request->parent_id);
        //if ($request->parent_id != 0) {
        //    $attivita = Attivita::findOrFail($request->parent_id);
        //}
        $progetto = Progetto::findOrFail($request->progetto_id);

        return redirect()->action('ProgettoController@edit', compact('progetto', 'attivita'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(AttivitaRequest $request)
    {
        if (!(Auth::User()->consulente->tipo == 'Partner' or Auth::User()->consulente->tipo == 'Admin')) {
            abort(503, 'Unauthorized action.');
        }
        $attivita = Attivita::findOrFail($request->selected);
        $progetto = Progetto::findOrFail($request->progetto_id);
        $attivita->descrizione = $request->descrizione;
        $attivita->save();

        return redirect()->action('ProgettoController@edit', compact('progetto', 'attivita'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!(Auth::User()->consulente->tipo == 'Partner' or Auth::User()->consulente->tipo == 'Admin')) {
            abort(503, 'Unauthorized action.');
        }
        $attivita = Attivita::findOrFail($id);
        $progetto = Progetto::findOrFail($attivita->progetto_id);
        $attivita->delete();
        return redirect()->action('ProgettoController@edit', compact('progetto'));
    }

    public function ajaxMoveDown()
    {
        $attivita = Attivita::findOrFail(Input::get('id'));
        if ($attivita->getNextSibling()->progetto_id == Input::get('progetto_id')) {
            $msg = $attivita->down();
        } else {
            $msg = 'out of scope';
        }
        $response = [
            'status' => 'success',
            'msg' => $msg,
        ];
        return Response::json($response);
    }
    
    public function ajaxMoveUp()
    {
        $attivita = Attivita::findOrFail(Input::get('id'));
        if ($attivita->getPrevSibling()->progetto_id == Input::get('progetto_id')) {
            $msg = $attivita->up();
        } else {
            $msg = 'out of scope';
        }
        $response = [
            'status' => 'success',
            'msg' => $msg,
        ];
        return Response::json($response);
    }

    public function ajaxGetDataTree()
    {
        $listaAttivita = Attivita::getDataTree(Input::get('progetto_id'));
        return Response::json($listaAttivita);
    }
}
