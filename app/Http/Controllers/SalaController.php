<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
class SalaController extends Controller
{
    //Adicinar salas

    public function store(Request $request){
        $request->validate([
       'sala'=>['required','integer',
       'unique:salas,sala,except,id']
        ]);
        if ($request->sala >0) {
            Sala::create($request->all());
            return redirect()->back()->with('sms1','Sala inserida com sucesso!'); 
        }else {
            return redirect()->back()->with('warning','O númro da sala não pode ser negativo!');
        }
    }

    // mover para lixeira
    public function destroy($id){
        if (is_numeric($id)) {
          Sala::find($id)->delete();
          return redirect()->back()->with('sms2','Sala movida para lixeira!');
        }else{
         return redirect()->back();
        }
     }
     //EDITAR SALA
 
     public function edit(Request $request,$id){
         $sala=Sala::find($id);
         $request->validate([
            'sala'=>['required','integer',
            "unique:salas,sala,$sala->id"]
         ]);
         
         if ($request->sala >0) {
         $sala->update($request->all());
         return redirect()->back()->with('sms3','Sala editada com sucesso!');
        }else {
            return redirect()->back()->with('warning','O númro da sala não pode ser negativo!');
        }
     }
}
