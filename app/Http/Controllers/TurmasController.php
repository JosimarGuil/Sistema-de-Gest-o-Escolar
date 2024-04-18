<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
class TurmasController extends Controller
{

    // aidiconar turmas
    
    public function store(Request $request){

        $request->validate([
       'turma'=>['required','min:2','max:30'],
       'periodo'=>['required'],
       'clace_id'=>['required'],
       'sala_id'=>['required']
        ]);
 
            Turma::create([
                'nome'=>$request->turma,
                'periodo'=>$request->periodo,
                'clace_id'=>$request->clace_id,
                'sala_id'=>$request->sala_id
            ]);
            return redirect()->back()->with('sms1','Turma inserida com sucesso!');
    }

    // mover para lixeira

    public function destroy($id){
        if (is_numeric($id)) {
            Turma::find($id)->delete();
          return redirect()->back()->with('sms2','Turma movida para a lixeira!');
        }else{
         return redirect()->back();
        }
     }
 
     //edição de turmas

     public function edit(Request $request,$id){
         $siculo=Turma::find($id);
         $request->validate([
            'turma'=>['required','min:2','max:30'],
            'periodo'=>['required'],
            'clace_id'=>['required'],
            'sala_id'=>['required']
         ]);
         
         $siculo->update([
            'nome'=>$request->turma,
            'periodo'=>$request->periodo,
            'clace_id'=>$request->clace_id,
            'sala_id'=>$request->sala_id
        ]);
         return redirect()->back()->with('sms3','Turma editada com sucesso!');
 
     }
}
