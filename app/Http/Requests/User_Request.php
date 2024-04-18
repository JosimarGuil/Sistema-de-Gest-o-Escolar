<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User_Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome'=>['required','max:50','min:5'],
            'email'=>['required',"unique:users,email,$this->id"],
            'data'=>['required'],
            'morada'=>['required','string','max:35','min:15'],
            'fone'=>['required','integer',"unique:users,fone,$this->id"],
            'perfil'=>['required'],
            'foto'=>['image','mimes:jpg,png'],
            'doc'=>['mimes:pdf'],
            'sexo'=>['required'],
        ];
    }
}
