<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class ConsulentiRequest extends FormRequest
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
                    'cognome'=> 'required',
                    'nome'=> 'required',
                    'email'=> 'required|email|unique:users,email,',
                    //'indirizzo'=> 'required',
                    //'citta'=> 'required',
                    //'provincia'=> 'required',
                    //'cap'=> 'required',
                    'telefono' => 'required_without:mobile',
                    'mobile' => 'required_without:telefono',
                    'partita_iva'=> 'required',
                    'tipo'=> 'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $user = User::withTrashed()->where('email', '=', $this->user_email)->first();
                return [
                    'cognome'=> 'required',
                    'nome'=> 'required',
                    'email'=> 'required|email|unique:users,email,'.$user->id,
                    //'indirizzo'=> 'required',
                    //'citta'=> 'required',
                    //'provincia'=> 'required',
                    //'cap'=> 'required',
                    'telefono' => 'required_without:mobile',
                    'mobile' => 'required_without:telefono',
                    'partita_iva'=> 'required',
                    'tipo'=> 'required'
                ];
            }
            default:
                break;
        }
    }
}
