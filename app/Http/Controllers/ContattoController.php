<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ContattiRequest;
use App\Contatto;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use App\ClienteContatto;
use Exception;


class ContattoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function create($id)
    {
        return redirect()->action('ContattoController@create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ContattiRequest $request)
    {
        $messages = [];
        $data = $request->all();
        $user = User::withTrashed()->where('email', $request->email);
        if ($user->count() > 0)
        {
            if ($user->first()->tipo_utente == 1)
            {
                $messages[] = "Un consulente non può essere associato come contatto <a href='" . action('ConsulenteController@edit', $user->first()->consulente->id) . "'> Link al CONSULENTE</a>";

                return redirect()->back()->withErrors($messages);
            } else
            {
                if ($request->cliente_id)
                    ClienteContatto::firstOrCreate(['cliente_id' => $request->cliente_id, 'contatto_id' => $user->first()->contatto->id]);

                return redirect()->action('ContattoController@edit', $user->first()->contatto->id)->withErrors($messages);
            }
        }
        else
        {
            $user = User::create(['email' => $request->email, 'password' => bcrypt('tksol'), 'tipo_utente' => '2']);
            $contatto = Contatto::create($data);
            $contatto->user()->associate($user->id);
            $contatto->save();
            //crea link cliente-contatto
            if ($request->cliente_id)
                ClienteContatto::firstOrCreate(['cliente_id' => $request->cliente_id, 'contatto_id' => $contatto->id]);

            return redirect()->action('ContattoController@edit', $contatto->id)->withErrors($messages);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return redirect()->action('ContattoController@edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $contatto = Contatto::findOrFail($id);
        $clientiContatto = ClienteContatto::where('contatto_id', $contatto->id)->get();

        //dd($clientiContatto->first()->cliente->ragione_sociale);
        return view('contatti.edit', compact('contatto', 'clientiContatto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, ContattiRequest $request)
    {
        $contatto = Contatto::findOrFail($id);
        $user = User::withTrashed()->findOrFail($contatto->user_id);


        $emailUtente = User::withTrashed()->where('email', $request->email);
        if ($emailUtente->count() > 0)
        {
            if ($emailUtente->first()->email != $user->email)
            {
                if ($emailUtente->first()->tipo_utente == 1)
                    $messages[] = "Email già presente in rubrica <a href='" . action('ConsulenteController@edit', $emailUtente->first()->consulente->id) . "'> Link al CONSULENTE collegato</a>";
                else
                    $messages[] = "Email già presente in rubrica <a href='" . action('ContattoController@edit', $emailUtente->first()->contatto->id) . "'> Link al CONTATTO collegato</a>";

                return redirect()->action('ContattoController@edit', $contatto->id)->withErrors($messages);
            }
        }
        $user->email = $request->email;
        $user->save();
        $contatto->update($request->all());

        return redirect()->action('ContattoController@edit', $contatto->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $cliente_id = Contatto::find($id)->cliente->id;
        $resp = Contatto::destroy($id);

        return redirect()->action('ClienteController@show', $cliente_id);
    }
}
