<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class TurmasController extends Controller
{

    // aidiconar turmas
    
    public function store(Request $request)
    {
        $request->validate([
       'turma'=>['required','min:2','max:30'],
       'periodo'=>['required'],
       'clace_id'=>['required'],
       'sala_id'=>['required']
        ]);
 
        try 
        {
            Turma::create(
            [
                'nome'=>$request->turma,
                'periodo'=>$request->periodo,
                'clace_id'=>$request->clace_id,
                'sala_id'=>$request->sala_id
            ]);
            ToastMagic::success('Turma inserida com sucesso!');
        } catch (\Throwable $th) 
        {
            ToastMagic::warning('Erro ao inserir turma!');
        }
        return redirect()->back();
    }

    // mover para lixeira

    public function destroy($id)
    {
        try 
        {
            Turma::find($id)->delete();
            ToastMagic::success('Turma deletada com sucesso!');
        } catch (\Throwable $th)
        {
            ToastMagic::warning('Erro ao deletar turma!');
        }
        return redirect()->back();
     }
 
     //edição de turmas

     public function edit(Request $request,$id)
     {
         $siculo = Turma::find($id);
         $request->validate([
            'turma'=>['required','min:2','max:30'],
            'periodo'=>['required'],
            'clace_id'=>['required'],
            'sala_id'=>['required']
         ]);

        try 
        {
            $siculo->update([
                'nome'=>$request->turma,
                'periodo'=>$request->periodo,
                'clace_id'=>$request->clace_id,
                'sala_id'=>$request->sala_id
            ]);
            ToastMagic::warning('Turma editada com sucesso!');
            return redirect()->back();
        } catch (\Throwable $th)
        {
            ToastMagic::warning('Erro ao editar turma!');
            return redirect()->back();
        }   
     }
}
