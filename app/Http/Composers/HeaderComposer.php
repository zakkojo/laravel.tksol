<?php
namespace App\Http\Composers;


use App\Intervento;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class HeaderComposer{

    public function compose(View $view)
    {
        if(Auth::User())
        {
            $daAccettare = Intervento::where('consulente_id', Auth::User()->consulente->id)->whereRaw('consulente_id <> creatore_id')->whereRaw('data_accettazione is null')->count();
            $nonAccettati = Intervento::where('creatore_id', Auth::User()->consulente->id)->whereRaw('consulente_id <> creatore_id')->whereRaw('data_accettazione is null')->count();
            $warning = $daAccettare + $nonAccettati;
            $view->with('warning', $warning);
        }
    }
}