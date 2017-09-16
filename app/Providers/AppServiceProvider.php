<?php

namespace App\Providers;

use App\Intervento;
use App\Storico;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Intervento::saved(function ($intervento) {
            if ($intervento->id)
            {
                $attuale = Intervento::find($intervento->id);
                if ($attuale != $intervento)
                {
                    $storico = new Storico();
                    $storico->record = $intervento->toJson();
                    $storico->user_id = (Auth::check()) ? Auth::User()->id : 0;
                    $storico->storicizza_id = $intervento->id;
                    $storico->storicizza_type = 'App\Intervento';
                    $storico->save();
                }
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
