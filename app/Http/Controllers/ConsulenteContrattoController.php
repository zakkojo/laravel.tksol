<?php namespace App\Http\Controllers;

use App\Consulente;
use App\ConsulenteContratto;
use App\Contratto;
use App\Http\Requests\ConsulentiContrattiRequest;
use Illuminate\Support\Facades\Auth;


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
        if(!(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin' OR Auth::User()->consulente->capoProgetto->contains($request->contratto_id))){
            abort(503, 'Unauthorized action.');
        }
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
        if(!(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin' OR Auth::User()->consulente->capoProgetto->contains($contratto_id))){
            return back()->withErrors(['ERRORE' => 'Non autorizzato']);
        }
        else
        {
            $consulenteContratto = ConsulenteContratto::findOrFail($id);
            $originale['ruolo'] = $consulenteContratto->ruolo;
            $originale['consulente_id'] = $consulenteContratto->consulente_id;
            $consulenteContratto->update($request->all());
            $consulenteContratto->save();
            $capoProgetto = ConsulenteContratto::where('contratto_id', $contratto_id)->where('ruolo', 'Capo Progetto')->count();
            if ($capoProgetto == 0)
            {
                $consulenteContratto->update($originale);
                $consulenteContratto->save();
                return back()->withErrors(['ERRORE' => 'Nessun Capo Progetto per il contratto']);
            }
            return redirect()->action('ContrattoController@edit', $contratto_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($contratto_id,$id)
    {
        if(!(Auth::User()->consulente->tipo == 'Partner' OR Auth::User()->consulente->tipo == 'Admin' OR Auth::User()->consulente->capoProgetto->contains($contratto_id))){
            abort(503, 'Unauthorized action.');
        }
        $capoProgetto = ConsulenteContratto::where('contratto_id', $contratto_id)->where('id','<>', $id)->where('ruolo', 'Capo Progetto')->count();
        $resp = ConsulenteContratto::destroy($id);
        return redirect()->action('ContrattoController@edit', $contratto_id);
    }

}
?>