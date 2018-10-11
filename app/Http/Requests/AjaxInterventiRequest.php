<?php

namespace App\Http\Requests;

Use App\Intervento;

class AjaxInterventiRequest extends Request {

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
                    'listinoContratto' => 'required|numeric',
                    'attivita'         => 'required|numeric',
                    'consulente'       => 'required|numeric',
                    'ora_start'        => 'required',
                    'ora_end'          => 'required',
                    'data'             => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'listinoContratto' => 'required|numeric',
                    'attivita'         => 'required|numeric',
                    'consulente'       => 'required|numeric',
                    'ora_start'        => 'required',
                    'ora_end'          => 'required',
                    'data'             => 'required',                    
                ];
            }
            default:
                break;
        }
    }

}
