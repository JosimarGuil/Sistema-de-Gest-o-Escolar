<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
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
            'nome'=>['required','string','max:50','min:5'],
            'email'=>['required','email',"unique:funcionarios,email,$this->id"],
            'data'=>['required'],
            'morada'=>['required','string','max:35','min:15'],
            'fone'=>['required','integer',"unique:funcionarios,fone,$this->id"],
            'cargo'=>['required'],
            'salario'=>['required'],
            'foto'=>['mimes:jpg,png,jpeg','max:1024'],
            'doc'=>['mimes:pdf','max:2024'],
            'sexo'=>['required']
        ];
    }
}
