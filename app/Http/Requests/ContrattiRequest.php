<?php

namespace App\Http\Requests;

Use App\Cliente;

class ContrattiRequest extends Request {

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
                    'societa_id'              => 'required',
                    'cliente_id'              => 'required',
                    'progetto_id'             => 'required',
                    'stato'                   => 'required',
                    'data_primo_contatto'     => 'required|date_format:d/m/Y',
                    'data_validita_contratto' => 'date_format:d/m/Y|after:data_primo_contatto',
                    'data_avvio_progetto'     => 'date_format:d/m/Y|after:data_primo_contatto',
                    'data_chiusura_progetto'  => 'date_format:d/m/Y|after:data_primo_contatto',
                    'importo'                 => 'numeric',
                    'modalita_fattura'        => 'required',
                    'fatturazione_id'         => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'societa_id'              => 'required',
                    'cliente_id'              => 'required',
                    'progetto_id'             => 'required',
                    'stato'                   => 'required',
                    'data_primo_contatto'     => 'required|date_format:d/m/Y',
                    'data_validita_contratto' => 'date_format:d/m/Y|after:data_primo_contatto',
                    'data_avvio_progetto'     => 'date_format:d/m/Y|after:data_primo_contatto',
                    'data_chiusura_progetto'  => 'date_format:d/m/Y|after:data_primo_contatto',
                    'importo'                 => 'numeric',
                    'modalita_fattura'        => 'required',
                    'fatturazione_id'         => 'required',
                ];
            }
            default:
                break;
        }
    }
}
