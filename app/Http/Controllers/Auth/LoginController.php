<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'redirectToProvider', 'handleProviderCallback']);
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

        $googleUser = Socialite::driver('google')->user();
        if (Auth::User())
        {
            $existingUser = Auth::User();
            $existingUser->googleAccount = $googleUser->email;
            $existingUser->googleAvatar = $googleUser->avatar;
            $existingUser->googleAvatarOriginal = $googleUser->avatar_original;
            $existingUser->save();
            $existingUser->createGoogleCalendarAppuntamenti($existingUser->id);
            return redirect()->action('ConsulenteController@edit', $existingUser->consulente->id);
        } else
        {
            if ($existingUser = User::where('email', $googleUser->email)->first())
            {
                // update user info
                $existingUser->googleAccount = $googleUser->email;
                $existingUser->googleAvatar = $googleUser->avatar;
                $existingUser->googleAvatarOriginal = $googleUser->avatar_original;
                $existingUser->save();
                // log them in
                auth()->login($existingUser, true);
                User::createGoogleCalendarAppuntamenti($existingUser->id);
                return redirect()->to('/');
            } elseif ($existingUser = User::where('googleAccount', $googleUser->email)->first())
            {
                // update user info
                $existingUser->googleAccount = $googleUser->email;
                $existingUser->googleAvatar = $googleUser->avatar;
                $existingUser->googleAvatarOriginal = $googleUser->avatar_original;
                $existingUser->save();
                // log them in
                auth()->login($existingUser, true);
                User::createGoogleCalendarAppuntamenti($existingUser->id);
                return redirect()->to('/');
            } else
                return redirect('/login')->withErrors(['Account Google non associato a nessun utente']);

        }
    }
}
