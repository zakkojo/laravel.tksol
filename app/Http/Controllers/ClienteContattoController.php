<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteContatto;
use App\Http\Controllers\ContattoController;


class ClienteContattoController extends Controller
{
    public function destroy($id)
    {
        $clienteContatto = ClienteContatto::findOrFail($id);
        $contatto = $clienteContatto->contatto;
        ClienteContatto::destroy($id);
        //return redirect()->action('ClienteController@show', $cliente_id);
        return redirect()->action('ContattoController@edit', $contatto->id);
    }
}
