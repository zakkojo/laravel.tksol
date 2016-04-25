<?php

namespace App\Http\Requests;

Use App\Intervento;

class InterventiRequest extends Request {

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
                    'listino_id'    => 'required|numeric',
                    'attivita_id'   => 'required|numeric',
                    'consulente_id' => 'required|numeric',
                    'data_start'    => 'required|date',
                    'data_end'      => 'required|date',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    "listinoContratto"      => 'required|numeric',
                    "consulente_id"         => 'required|numeric',
                    "attivita"              => 'required|numeric',
                    "intervento_id"         => 'required|numeric',
                    
                    "data"                  => 'required',
                    "ora_start"             => 'required',
                    "ora_end"               => 'required',
                    "stato"                 => 'required',
                    
                    //"attivitaPianificate"   => "0",
                    //"attivitaSvolte"        => "",
                    //"attivitaCaricoCliente" => "",
                    //"problemiAperti"        => "",
                ];
            }
            default:
                break;
        }
    }

}
