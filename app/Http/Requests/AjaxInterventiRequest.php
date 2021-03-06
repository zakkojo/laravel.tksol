<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Intervento;

class AjaxInterventiRequest extends FormRequest
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
            {
                return [
                    'listinoContratto' => 'required|numeric',
                    'attivita'         => 'required|numeric',
                    'user_id'       => 'required|numeric',
                    'ora_start'        => 'required',
                    'ora_end'          => 'required',
                    'data'             => 'required',
                ];
            }
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'listinoContratto' => 'required|numeric',
                    'attivita'         => 'required|numeric',
                    'user_id'       => 'required|numeric',
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
                    'user_id'       => 'required|numeric',
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
