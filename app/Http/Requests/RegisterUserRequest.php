<?php

namespace App\Http\Requests;

#Import
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Collection;

use function PHPUnit\Framework\throwException;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        collect($this->header()) ->contains(["accept" , "application/json"]);
        if(!(collect($this->header()) ->contains(["accept" , "application/json"]))){
            abort(404);
            return Response::json([
                'message' => 'faltando informacoes no cabecalho'
            ],404);
        }
        return $this->isJson();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users,email'
        ];
    }

}
