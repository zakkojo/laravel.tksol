<?php

namespace App\Http\Requests;


class ClientiRequest extends Request
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
            'codice_fiscale'=> 'required',
            'partita_iva'=> 'required',
            'ragione_sociale'=> 'required',
        ];
    }
}
