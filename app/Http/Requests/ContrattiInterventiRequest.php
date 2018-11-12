<?php

namespace App\Http\Requests;

class ContrattiInterventiRequest extends Request
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
                    'contratto_id'=> 'required',
                    'descrizione'=> 'required',
                    'tariffa_ora'=> 'required|numeric',
                    'iva' => 'required',
                    'tipo_iva' => 'required',
                    'ore_previste'=> 'numeric'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'contratto_id'=> 'required',
                    'descrizione'=> 'required',
                    'tariffa_ora'=> 'required|numeric',
                    'iva' => 'required|numeric',
                    'tipo_iva' => 'required',
                    'ore_previste'=> 'numeric'
                ];
            }
            default:
                break;
        }
    }
}
