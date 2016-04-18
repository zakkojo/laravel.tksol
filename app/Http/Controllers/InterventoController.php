<?php namespace App\Http\Controllers;

use App\Cliente;
use App\Consulente;
use App\Http\Requests\InterventiRequest;
use App\Progetto;
use App\Intervento;
use Carbon\Carbon;
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
    public function store(InterventiRequest $request)
    {
        $data = $request->all();
        if (Intervento::create($data)) return true;
        else return false;
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
            if ($consulente_id)
            {
                $where[0][] = ['consulente_id' => $consulente_id];
                $calendario = Intervento::where('data_start', '>=', $data_start)->where('data_start', '<=', $data_end)->where($where)->get();
            } elseif ($progetto_id)
            {
                $calendario = Intervento::with(['listinoInterventi.contratto.progetto' => function ($query) use ($progetto_id)
                {
                    $query->where('id', '=', $progetto_id);
                }])->where('data_start', '>=', $data_start)->where('data_start', '<=', $data_end)->get();
            } else $calenrio = [];

            $calendario->each(function ($evento)
            {
                if ($evento['stato'] == 'PIANIFICATO')
                {
                    $intervento = Intervento::findOrFail($evento['id']);
                    $evento['title'] = 'P:' . $intervento->consulente->nominativo .
                        '|' . $intervento->listinoInterventi->contratto->progetto->descrizione .
                        '|' . $intervento->attivita->descrizione;
                    $evento['start'] = $evento['data_start'];
                    $evento['end'] = $evento['data_end'];
                    $evento['className'] = 'pianificato';

                    return $evento;
                }
            });

            return $calendario;
        }

        return ['msg' => 'errore'];
    }

    public function ajaxCreateIntervento()
    {
        $data = [
            //'' => Input::get('contratto'),
            'listino_id'    => Input::get('listinoContratto'),
            'attivita_id'   => Input::get('attivita'),
            'consulente_id' => Input::get('consulente'),
            'data_start'    => Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_start'))->format('Y-m-d H:i:s'),
            'data_end'      => Carbon::createFromFormat('d/m/Y H:i', Input::get('data') . ' ' . Input::get('ora_end'))->format('Y-m-d H:i:s'),
        ];

        $request = InterventiRequest::create( 'interventi', 'POST', $data );
        $response = Route::dispatch( $request );

        if ($response) return ['status' => 'success'];
        return ['status' => 'fail'];
    }
}

?>