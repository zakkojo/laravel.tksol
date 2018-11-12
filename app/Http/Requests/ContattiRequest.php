<?php

namespace App\Http\Requests;

use App\User;

class ContattiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'descrizione'=> 'required',
                    //'indirizzo'=> 'required',
                    //'citta'=> 'required',
                    //'provincia'=> 'required',
                    //'cap'=> 'required',
                    'telefono' => 'required_without:telefono2',
                    'telefono2' => 'required_without:telefono',
                    'email'=> 'required|email|unique:users,email',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                if ($user = User::withTrashed()->where('email', '=', $this->user_email)->first()) {
                    $user = $user->id;
                } else {
                    $user = '';
                }
                return [
                    'descrizione'=> 'required',
                    //'indirizzo'=> 'required',
                    //'citta'=> 'required',
                    //'provincia'=> 'required',
                    //'cap'=> 'required',
                    'telefono' => 'required_without:telefono2',
                    'telefono2' => 'required_without:telefono',
                    'email'=> 'required|email|unique:users,email,'.$user,
                ];
            }
            default:
                break;
        }
    }
}
