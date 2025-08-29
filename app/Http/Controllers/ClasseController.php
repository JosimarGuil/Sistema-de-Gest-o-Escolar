<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siculo;
use App\Models\Curso;
use App\Models\Clace;
use Brian2694\Toastr\Facades\Toastr;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class ClasseController extends Controller
{

    // Adicionar calsses

    public function store(Request $request)
    {
        $request->validate([
            'classe' => [
                'required',
                'string',
                'max:30',
                'min:1',
                'unique:claces,nome,except,id'
            ],
        ]);

        try {

            $verify = $request->classe;
            $siculo = Siculo::where('id', $request->siculo_id)->first();
            $curso = Curso::where('id', $request->curso_id)->first();
            $req = $request;

            if (($verify <= 6) and isset($siculo->nome) and ($siculo->nome == "Ensino Primário")) {
                if ($request->filled('siculo_id') and $request->curso_id == null) {
                    Clace::create(
                        [
                            'nome' => $request->classe == 0 ? 'Iniciação' : $request->classe . '-classe',
                            'siculo_id' => $request->siculo_id,
                            'curso_id' => $request->curso_id
                        ]
                    );
                    ToastMagic::success('Classe inserida com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('É necessário selecionar o cíclo do Ensino Primário para esta classe!');
                    return redirect()->back();
                }
            } elseif (($verify >= 7 and $verify <= 9) and isset($siculo->nome) and
                ($siculo->nome == 'Primeiro Cíclo')
            ) {
                if ($request->filled('siculo_id') and $request->curso_id == null) {
                    Clace::create(
                        [
                            'nome' => $request->classe . '-classe',
                            'siculo_id' => $request->siculo_id,
                            'curso_id' => $request->curso_id
                        ]
                    );
                    ToastMagic::success('Classe inserida com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('É necessário selecionar o cíclo do Primeiro Cíclo para esta classe!');
                    return redirect()->back();
                }
            } elseif (($verify >= 10) and isset($curso->nome)) {
                if ($request->filled('curso_id') and $request->siculo_id == null) {
                    Clace::create([
                        'nome' => $request->classe . '-classe',
                        'siculo_id' => $request->siculo_id,
                        'curso_id' => $request->curso_id
                    ]);
                    ToastMagic::success('Classe inserida com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('É necessário selecionar um curso');
                    return redirect()->back();
                }
            } else {
                ToastMagic::warning('A classe inserida não pertence ao cíclo ou curso selecionado!');
                return   redirect()->back();
            }
        } catch (\Throwable $th) {

            ToastMagic::error('Erro ao inserir a classe!');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            Clace::find($id)->delete();
            ToastMagic::success('Classe deletada com sucesso!');
        } catch (\Throwable $th) {
            ToastMagic::error('Erro ao deletar a classe!');
        }
        return redirect()->back();
    }

    // editar classe

    public function edit(Request $request, $id)
    {
        $classe = Clace::find($id);
        $request->validate(
            [
                'classe' => [
                    'required',
                    'string',
                    'max:30',
                    'min:1',
                    "unique:claces,nome,$classe->id"
                ]
            ]
        );

        try {
            $verify = $request->classe;
            $siculo = Siculo::where('id', $request->siculo_id)->first();
            $curso = Curso::where('id', $request->curso_id)->first();
            $req = $request;
            if (($verify <= 6) and isset($siculo->nome) and
                ($siculo->nome == "Ensino Primário")
            ) {
                if ($request->filled('siculo_id') and $request->curso_id == null) {
                    $classe->update(
                        [
                            'nome' => $request->classe == 0 ? 'Iniciação' : $request->classe . '-classe',
                            'siculo_id' => $request->siculo_id,
                        ]
                    );
                    ToastMagic::success('Classe editada com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('É necessário selecionar o cíclo do Ensino Primário para esta classe!');
                    return redirect()->back();
                }
            } elseif (($verify >= 7 and $verify <= 9) and isset($siculo->nome) and
                ($siculo->nome == 'Primeiro Cíclo')
            ) {

                if ($request->filled('siculo_id') and $request->curso_id == null) {
                    $classe->update([
                        'nome' => $request->classe . '-classe',
                        'siculo_id' => $request->siculo_id
                    ]);
                    ToastMagic::success('Classe editada com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('É necessário selecionar o cíclo do Primeiro Cíclo para esta classe!');
                    return redirect()->back();
                }
            } elseif (($verify >= 10) and isset($curso->nome)) {
                if ($request->filled('curso_id') and $request->siculo_id == null) {
                    $classe->update([
                        'nome' => $request->classe . '-classe',
                        'curso_id' => $request->curso_id
                    ]);
                    ToastMagic::success('Classe editada com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('É necessário selecionar um curso!');
                    return redirect()->back();
                }
            } else {
                ToastMagic::warning('A classe inserida não pertence ao cíclo ou curso selecionado!');
                return   redirect()->back();
            }
        } catch (\Throwable $th) {
            ToastMagic::warning('Erro ao editar a classe!');
            return redirect()->back();
        }
    }
}
