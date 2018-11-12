<?php

namespace App\Http\Requests;

use App\Attivita;

class AttivitaRequest extends Request
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
                    'descrizione'=> 'required',
                    'progetto_id' => 'required|numeric',
                    'parent_id' => 'required|numeric',
                    'lft_id'=> 'numeric',
                    'rgt_id'=> 'numeric',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'descrizione'=> 'required',
                    'progetto_id' => 'required|numeric',
                    'parent_id' => 'required|numeric',
                    'lft_id'=> 'numeric',
                    'rgt_id'=> 'numeric',
                ];
            }
            default:
                break;
        }
    }
}
