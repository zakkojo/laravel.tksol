<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Consulente;
use App\Contatto;
use App\User;

use Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class UserController extends Controller {

  public function __construct()
  {
    $this->middleware('auth');
  }
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
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }

    public function ajaxToggleUser()
    {
        if(Input::get('tipo_utente') == 1){
            $utente =  Consulente::findOrFail(Input::get('id'));
        }
        elseif(Input::get('tipo_utente') == 2) {
            $utente =  Contatto::findOrFail(Input::get('id'));
        }
        if(count($utente->user)){
            $user = User::find($utente->user_id);
            $user->delete();
            $msg = 'Accesso Disabilitato';
        }
        else{
            $utente->user()->withTrashed()->first()->restore();
            $msg = 'Accesso Abilitato';
        }

        $response = array(
            'status' => 'success',
            'msg' => $msg,
        );
        return Response::json( $response );
    }
  
}

?>