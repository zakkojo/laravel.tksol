<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class HelperController extends Controller {

    public function ajaxSetSession()
    {
        $key = Input::get('key');
        $val = Input::get('val');
        if($key)
            session()->put($key,$val);
        session()->save();
        dd(session()->all());
    }

    public function ajaxPushSession()
    {
       //
    }

    public function ajaxPullSession()
    {
        $key = Input::get('key');
        $val = Input::get('val');
        session()->pull($key, $val);
        session()->save();
        dd(session()->all());
    }

}