<?php namespace App\Http\Controllers;

use App\Cliente;
use App\Consulente;
use App\Progetto;
use App\Intervento;
use Illuminate\Support\Facades\Input;
use DB;

class InterventoController extends Controller {

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
        $consulenti = Consulente::all();
        $clienti = Cliente::all();
        $progetti = Progetto::all();

        return view('interventi.create', compact('consulenti', 'clienti', 'progetti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

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


    public function ajaxGetCalendar()
    {
        $data_start = Input::get('start');
        $data_end = Input::get('end');
        if ($data_start AND $data_end)
        {
            $consulente_id = Input::get('consulente_id');
            $progetto_id = Input::get('progetto_id');
            if ($consulente_id){
                $where[0][] = ['consulente_id' => $consulente_id];
                $calendario = Intervento::where('data_intervento', '>=', $data_start)->where('data_intervento', '<=', $data_end)->where($where)->get();
            }
            elseif ($progetto_id) {
                $calendario = Intervento::with(['listinoInterventi.contratto.progetto' => function ($query) use ($progetto_id) {
                    $query->where('id', '=', $progetto_id);
                }])->where('data_intervento', '>=', $data_start)->where('data_intervento', '<=', $data_end)->get();
            }
            else $calenrio = [];

            $calendario->each(function ($evento)
            {
                if ($evento['stato'] == 'PIANIFICATO')
                {
                    $intervento = Intervento::findOrFail($evento['id']);
                    $evento['title'] = 'P:' . $intervento->consulente->nominativo.
                        '|'.$intervento->listinoInterventi->contratto->progetto->descrizione.
                        '|'.$intervento->attivita->descrizione;
                    $evento['start'] = $evento['data_intervento'];
                    $evento['className'] = 'pianificato';
                    return $evento;
                }
            });

            return $calendario;
        }

        return ['msg' => 'errore'];

        /*if($attivita->getPrevSibling()->progetto_id == Input::get('progetto_id'))
            $msg = $attivita->up();
        else $msg = 'out of scope';
        $response = array(
            'status' => 'success',
            'msg' => $msg,
        );
        return Response::json( $response );*/
    }
}

?>