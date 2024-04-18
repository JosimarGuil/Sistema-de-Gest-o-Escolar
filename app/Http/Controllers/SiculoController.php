<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siculo;
class SiculoController extends Controller
{
    
//Adicionar siculos

    public function store(Request $request){
        $request->validate([
       'ciclu'=>['required','string','max:30','min:5','unique:siculos,nome,except,id']
        ]);       
        Siculo::create([
            'nome'=>$request->ciclu
        ]);
        return redirect()->back()->with('sms1','Cíclo inserido com sucesso!');
    }

// mover para lixeira 

    public function destroy($id){
       if (is_numeric($id)) {
         Siculo::find($id)->delete();
         return redirect()->back()->with('sms2','Cíclo movido para lixeira!');
       }else{
        return redirect()->back();
       }
    }

    // public function edit(Request $request,$id){
    //     $siculo=Siculo::find($id);
    //     $request->validate([
    //    'ciclu'=>['required','string','max:30','min:5',"unique:siculos,nome,$siculo->id"]
    //     ]);
        
    //     $siculo->update([
    //         'nome'=>$request->ciclu
    //     ]);
    //     return redirect()->back()->with('sms3','Cíclu editado com sucesso!');

    // }
}
