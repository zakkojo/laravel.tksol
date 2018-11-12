<?php

namespace App\Http\Requests;

use App\Cliente;

class ProdottiRequest extends Request
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
                    'nome'=> 'required',
                    'codice'=> 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'nome'=> 'required',
                    'codice'=> 'required',
                ];
            }
            default:
                break;
        }
    }
}
