<?php

namespace App\Http\Requests;

use App\Cliente;

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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'codice_fiscale'  => 'required|max:16|unique:cliente',
                    'partita_iva'     => 'required|unique:cliente',
                    'ragione_sociale' => 'required',
                    'rating'          => 'numeric',
                    'email'           => 'required|email',
                    'distanza'        => 'numeric',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'codice_fiscale'  => 'required|max:16|unique:cliente,id,' . $this->id,
                    'partita_iva'     => 'required|unique:cliente,id,' . $this->id,
                    'ragione_sociale' => 'required',
                    'rating'          => 'numeric',
                    'email'           => 'required|email',
                    'distanza'        => 'numeric',
                ];
            }
            default:
                break;
        }
    }
}
