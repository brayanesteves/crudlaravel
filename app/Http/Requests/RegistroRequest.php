<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|max:30|unique:email,email',
            'password' => 'required',
            'nombres' => 'max:40',
            'apellidos' => 'max:40',
            'telefono' => 'max:11',
            'documentoidentificacion' => 'max:11'
        ];
    }
}
