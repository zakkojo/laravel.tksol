<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsulentiContrattiRequest extends FormRequest
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
            }
            case 'POST':
            {
                return [
                    'contratto_id'  => 'required',
                    'consulente_id' => 'required|unique:consulente_contratto,consulente_id,NULL,id,contratto_id,' . $this->contratto_id,
                    'ruolo'         => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'id' => 'required',
                    'contratto_id'  => 'required',
                    'consulente_id' => 'required|unique:consulente_contratto,consulente_id,'.$this->id.',id,consulente_id,' . $this->consulente_id . ',contratto_id,' . $this->contratto_id,
                    'ruolo'         => 'required',
                ];
            }
            default:
                break;
        }
    }
}
