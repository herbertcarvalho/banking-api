<?php

namespace App\Http\Requests;

#Import
use Illuminate\Foundation\Http\FormRequest;

class transferAmountRequest extends FormRequest
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
        return [
            'conta_doador' => 'required',
            'agencia_doador' => 'required',
            'conta_receptor' => 'required',
            'agencia_receptor' => 'required',
            'valor' => 'required'
        ];
    }
}
