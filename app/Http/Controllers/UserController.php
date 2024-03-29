<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Consulente;
use App\Contatto;
use App\User;

use Illuminate\Support\Facades\Password;
use Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use Google;
use Google_Service_Calendar;
use Google_Service_Calendar_Calendar;
use Google_Service_Calendar_AclRule;
use Google_Service_Calendar_AclRuleScope;

class UserController extends Controller
{

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
        return view('utenti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $data = Request::all();

        return $data;
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

    public function unlinkGoogle()
    {
        $user = Auth::User();
        $user->googleAccount = null;
        $user->googleAvatar = null;
        $user->googleAvatarOriginal = null;
        $user->save();
        //$googleClient = Google::getClient();
        //$googleClient->revokeToken();
        return redirect()->action('ConsulenteController@edit', $user->consulente->id);
    }

    public function createGoogleCalendarAppuntamenti(Request $request)
    {
        dd("asdsdddddddddd");
        $user = User::findOrFail($request->user_id);
        if ($user->googleCalendarAppuntamenti == null and $user->tipo == 1) {
            //Creo Calendario Appuntamenti
            $serviceClient = Google::getClient();
            $calendar = new Google_Service_Calendar_Calendar();
            $calendar->setSummary('CRM ' . $user->consulente->nominativo);
            $calendar->setTimeZone('Europe/Rome');
            $service = Google::make('calendar');
            $createdCalendar = $service->calendars->insert($calendar);

            $user->googleCalendarAppuntamenti = $createdCalendar->getId();
            $user->save();
        } else return "asdasdasdad";
    }

    public function shareGoogleCalendarAppuntamenti(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($calendar_id = $user->googleCalendarAppuntamenti != null and $user->tipo == 1) {
            $serviceClient = Google::getClient();
            $service = Google::make('calendar');
            //condivido il calendario con la mail google dell'utente in lettura
            $rule = new Google_Service_Calendar_AclRule();
            $scope = new Google_Service_Calendar_AclRuleScope();
            $scope->setType("user");
            $scope->setValue($user->googleAccount);
            $rule->setScope($scope);
            $rule->setRole("reader");
            $createdRule[] = $service->acl->insert($calendar_id, $rule);
            //condivido il calendario con l'account solutions@tksol.net
            $rule = new Google_Service_Calendar_AclRule();
            $scope = new Google_Service_Calendar_AclRuleScope();
            $scope->setType("user");
            $scope->setValue("solutions@tksol.net");
            $rule->setScope($scope);
            $rule->setRole("owner");
            $createdRule[] = $service->acl->insert($calendar_id, $rule);
        } else {
            //create calendar and retry
            return null;
        }
    }

    public function unshareGoogleCalendarAppuntamenti(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($calendar_id = $user->googleCalendarAppuntamenti != null and $user->tipo == 1) {
            $serviceClient = Google::getClient();
            $service = Google::make('calendar');
            $acl = $service->acl->listAcl($calendar_id);
            foreach ($acl->getItems() as $rule) {
                if ($rule->getRole() != "owner") {
                    $service->acl->delete($calendar_id, $rule->getId());
                }
            }
            return null;
        } else {
            //nessun calendario per l'utente
            return null;
        }
    }

    public function ajaxToggleUser()
    {
        if (Input::get('tipo_utente') == 1) {
            $utente = Consulente::withTrashed()->findOrFail(Input::get('id'));
        } elseif (Input::get('tipo_utente') == 2) {
            $utente = Contatto::withTrashed()->findOrFail(Input::get('id'));
        }
        if ($utente->user) {
            $user = $utente->user;
            $user->delete();
            $user->consulente->delete();
            $msg = 'Accesso Disabilitato per: ' . $user->email;
        } else {
            $utente->user()->withTrashed()->first()->restore();
            $utente->withTrashed()->first()->restore();
            $user = User::find($utente->user_id);
            $msg = 'Accesso Abilitato per: ' . $user->email;


            try {
                Password::sendResetLink(['email' => $user->email]);
            } catch (\Exception $ex) {
                $response = [
                    'status'    => 'warning',
                    'msg'       => 'WARNING!\nUtente riattivato correttamente\nImpossibile inviare email reset password',
                    'exception' => $ex->getMessage(),
                ];

                return Response::json($response);
            }
        }
        $response = [
            'status' => 'success',
            'msg'    => $msg,
        ];

        return Response::json($response);
    }
}
