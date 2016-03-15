<?php

namespace App\Http\Requests;
Use App\User;

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

        switch ($this->method())
        {
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
                    'telefono' => 'required_without:mobile',
                    'mobile' => 'required_without:telefono',
                    'email'=> 'required|email|unique:users,email',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $user = User::withTrashed()->where('email', '=', $this->email)->first();
                return [
                    'descrizione'=> 'required',
                    //'indirizzo'=> 'required',
                    //'citta'=> 'required',
                    //'provincia'=> 'required',
                    //'cap'=> 'required',
                    'telefono' => 'required_without:mobile',
                    'mobile' => 'required_without:telefono',
                    'email'=> 'required|email|unique:users,email,'.$user->id,
                ];
            }
            default:
                break;
        }
    }

}
