<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ContattiRequest;
use App\Contatto;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use App\ClienteContatto;

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
        $user = User::where('email', $request->email);
        if ($user->count() == 0)
        {
            $user = User::create(['email' => $request->email, 'password' => bcrypt('tksol'), 'tipo_utente' => '2']);
            $user->save();
        } else $user = $user->first();
        if ($contatto = $user->contatto)
        {
            $messages[] = "Contatto già esistente sei stato rediretto verso la pagina di gestione del contatto!";
            //$contatto = $contatto->first();
        } else
        {
            $contatto = Contatto::create($data);
            $contatto->user()->associate($user->id);
            $contatto->save();
        }
        //crea link cliente-contatto
        //clienteContatto::create(['cliente_id'=>$request->cliente_id, 'contatto_id' => $contatto->id]);
        ClienteContatto::firstOrCreate(['cliente_id' => $request->cliente_id, 'contatto_id' => $contatto->id]);

        return redirect()->action('ContattoController@edit', $contatto->id)->withErrors($messages);
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
        $clientiContatto = ClienteContatto::where('contatto_id',$contatto->id)->get();
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
        $contatto->update($request->all());
        $user = User::withTrashed()->where('email', '=', $request->user_email)->firstOrFail();
        $user->email = $request->email;
        $user->save();

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
