<?php

namespace App\Http\Requests;


class ConsulentiRequest extends Request
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
        return [
            'cognome'=> 'required',
            'nome'=> 'required',
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
}
