<?php

namespace App\Http\Controllers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Cliente;
use App\Consulente;
use Illuminate\Support\Facades\Auth;
use App\Intervento;
use App\User;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function show()
    {

        echo Carbon::now();
        $authUser = Auth::User()->id;
        $consulente = User::findOrFail($authUser)->consulente;
        $daApprovare = collect();
        $consulente->capoProgetto->each(function ($contratto, $key) use ($daApprovare) {
            $contratto->interventiDaApprovare->each(function ($intervento, $key) use ($daApprovare) {
                $daApprovare->push($intervento);
            });
        });
        dd($daApprovare->toArray());
    }
}
