<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller {

    public function ajaxSetSession()
    {
        $key = Input::get('key');
        $val = Input::get('val');
        if ($key)
        {
            session()->put($key, $val);
        }
        session()->save();

        return true;
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

        return true;
    }
}
