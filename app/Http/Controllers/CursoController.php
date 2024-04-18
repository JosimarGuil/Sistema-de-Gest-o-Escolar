<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
class CursoController extends Controller
{
    //adicionar cursos
    public function store(Request $request){
        $request->validate([
       'curso'=>['required','string','max:30',
       'min:5','unique:cursos,nome,except,id'],
       'sigla'=>['required','string','max:6',
       'min:2','unique:cursos,sigla,except,id']
        ]);       
        Curso::create([
            'nome'=>$request->curso,
            'sigla'=>$request->sigla
        ]);
        return redirect()->back()->with('sms1','Curso inserido com sucesso!');
    }

    // Mover para lixeira
    public function destroy($id){
        if (is_numeric($id)) {
            Curso::find($id)->delete();
          return redirect()->back()->with('sms2','Curso movido para a lixeira!');
        }else{
         return redirect()->back();
        }
     }
 
     //editar cursos
     public function edit(Request $request,$id){
         $curso=Curso::find($id);
            $request->validate([
                'curso'=>['required','string','max:30',
                'min:5',"unique:cursos,nome,$curso->id"],
                'sigla'=>['required','string','max:6',
                'min:2',"unique:cursos,sigla,$curso->id"]
                 ]);
         
                 $curso->update([
                    'nome'=>$request->curso,
                    'sigla'=>$request->sigla
                 ]);
         return redirect()->back()->with('sms3','Curso editado com sucesso!');
 
     }
}
