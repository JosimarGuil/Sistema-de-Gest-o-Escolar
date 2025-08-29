<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class CursoController extends Controller
{
    //adicionar cursos
    public function store(Request $request)
    {
        try 
        {
            $request->validate(
            [
                'curso'=>['required','string','max:30',
                'min:5','unique:cursos,nome,except,id'],
                'sigla'=>['required','string','max:6',
                'min:2','unique:cursos,sigla,except,id']
            ]);       
            Curso::create(
            [
                'nome'=>$request->curso,
                'sigla'=>$request->sigla
            ]);
            ToastMagic::success('Curso inserido com sucesso!');
        } catch (\Throwable $th) 
        {
            ToastMagic::success('Erro ao inserir curso!');
        }
      
        return redirect()->back();
    }

    // Mover para lixeira
    public function destroy($id)
    {
        try
        {
            Curso::find($id)->delete();
            ToastMagic::success('Curso deletado com sucesso!');
        } catch (\Throwable $th) 
        {
            ToastMagic::error('Erro ao deletar curso!');
        }
        return redirect()->back();
    }
 
     //editar cursos
     public function edit(Request $request,$id)
     {
        try 
        {
            $curso=Curso::find($id);
            $request->validate(
            [
                'curso'=>['required','string','max:30',
                'min:5',"unique:cursos,nome,$curso->id"],
                'sigla'=>['required','string','max:6',
                'min:2',"unique:cursos,sigla,$curso->id"]
            ]);
            $curso->update([
                'nome'=>$request->curso,
                'sigla'=>$request->sigla
            ]);
            ToastMagic::success('Curso editado com sucesso!');
        } catch (\Throwable $th) 
        {
            ToastMagic::success('Erro ao editar curso!');
        }
        return redirect()->back();
     }
}
