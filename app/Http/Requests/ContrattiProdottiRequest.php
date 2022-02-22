<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContrattiProdottiRequest extends FormRequest
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
                    'prodotto_id'=> 'required',
                    'importo'=> 'required|numeric',
                    'iva' => 'required',
                    'tipo_iva' => 'required',
                    'fee' => 'numeric',
                    'softwarehouse_id' => 'numeric',
                    'scadenza'=> 'date_format:d/m/Y'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'contratto_id'=> 'required',
                    'prodotto_id'=> 'required',
                    'importo'=> 'required|numeric',
                    'iva' => 'required',
                    'tipo_iva' => 'required',
                    'fee' => 'numeric',
                    'softwarehouse_id' => 'numeric',
                    'scadenza'=> 'date_format:d/m/Y'
                ];
            }
            default:
                break;
        }
    }
}
