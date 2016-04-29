<?php

namespace App\Http\Requests;

Use App\Cliente;

class ClientiRequest extends Request {

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
        if ($this->id)
        {
            return [
                'codice_fiscale'  => 'required|max:16|unique:cliente,id,' . $this->id,
                'partita_iva'     => 'required|unique:cliente,id,' . $this->id,
                'ragione_sociale' => 'required',
            ];
        } else
        {
            return [
                'codice_fiscale'  => 'required|max:16|unique:cliente',
                'partita_iva'     => 'required|unique:cliente',
                'ragione_sociale' => 'required',
            ];
        }
    }
}
