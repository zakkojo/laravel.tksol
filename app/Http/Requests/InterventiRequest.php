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
                    'listino_id'  => 'required|numeric',
                    'attivita_id' => 'required|numeric',
                    'user_id'     => 'required|numeric',
                    'data_start'  => 'required|date',
                    'data_end'    => 'required|date',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $rules = [
                    "listinoContratto" => 'required|numeric',
                    "user_id"          => 'required|numeric',
                    "attivita"         => 'required|numeric',
                    "intervento_id"    => 'required|numeric',

                    "data" => 'required',
                    "sede" => 'required',
                ];
                if ($this->attributes->get('stampa') == '1')
                {
                    $rules->push(
                        ["ora_start_reale" => 'required',
                         "ora_end_reale"   => 'required',
                         "ore_lavorate"    => 'required',
                        ]
                    );
                }

                return $rules;
                //"ora_start_reale" => 'required',
                //"ora_end_reale"   => 'required',
                //"ore_lavorate"    => 'required',

                //"attivitaPianificate"   => "0",
                //"attivitaSvolte"        => "",
                //"attivitaCaricoCliente" => "",
                //"problemiAperti"        => "",
            }
            default:
                break;
        }
    }

}
