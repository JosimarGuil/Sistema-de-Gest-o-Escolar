<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
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
            'email'=>['required','email',"unique:alunos,email,$this->id"],
            'data'=>['required'],
            'localiza'=>['required','string','max:35','min:15'],
            'fone'=>['required','integer',"unique:alunos,fone,$this->id"],
            'what'=>["unique:alunos,what,$this->id"],
            'classe_id'=>['required'],
            'turma_id'=>['required'],
            'img'=>['image','mimes:jpg,png'],
            'doc'=>['mimes:pdf'],
            'sexo'=>['required']
        ];
    }
}
