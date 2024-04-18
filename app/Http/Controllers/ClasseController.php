<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siculo;
use App\Models\Curso;
use App\Models\Clace;
class ClasseController extends Controller
{
 
// Adicionar calsses

    public function store(Request $request){
        $request->validate([
       'classe'=>['required','string','max:30',
       'min:1','unique:claces,nome,except,id'],
        ]);
        $verify=$request->classe;
        $siculo=Siculo::where('id',$request->siculo_id)->first();
        $curso= Curso::where('id',$request->curso_id)->first();
        $req=$request;

        if(($verify <=6) and isset($siculo->nome) and 
        ($siculo->nome=="Ensino Primário")){
            if ($request->filled('siculo_id') and $request->curso_id==null) {
              
                Clace::create([
                    'nome'=>$request->classe==0? 'Iniciação':$request->classe.'-classe',
                    'siculo_id'=>$request->siculo_id,
                    'curso_id'=>$request->curso_id
                ]);
                return redirect()->back()->with('sms1','Classe inserida com sucesso!');
            }else {
              return redirect()->back()->with('warning','
              É necessário selecionar o cíclo do Ensino Primário para esta classe!'); 
            }

        }elseif(($verify >=7 and $verify <=9 ) AND isset($siculo->nome) and 
         ($siculo->nome=='Primeiro Cíclo')){

            if ($request->filled('siculo_id') and $request->curso_id==null) {

                Clace::create([
                    'nome'=>$request->classe.'-classe',
                    'siculo_id'=>$request->siculo_id,
                    'curso_id'=>$request->curso_id
                ]);
                return redirect()->back()->with('sms1','Classe inserida com sucesso!');
            }else {
              return redirect()->back()->with('warning','
              É necessário selecionar o cíclo do Primeiro Cíclo para esta classe!'); 
            }

     }elseif(($verify >=10 ) AND isset($curso->nome)){
        if ($request->filled('curso_id') and $request->siculo_id==null) {
            Clace::create([
                'nome'=>$request->classe.'-classe',
                'siculo_id'=>$request->siculo_id,
                'curso_id'=>$request->curso_id
            ]);
            return redirect()->back()->with('sms1','Classe inserida com sucesso!');
        }else {
          return redirect()->back()->with('warning','
          É necessário selecionar um curso!'); 
        }
 }else {
 return   redirect()->back()->with('warning','A classe inserida não pertence ao cíclo ou curso selecionada!');
 }
     
    }

  // Mover para lixeira 

        public function destroy($id){
            if (is_numeric($id)) {
                Clace::find($id)->delete();
              return redirect()->back()->with('sms2','Classe movida para lixeira!');
            }else{
             return redirect()->back();
            }
         }

  // editar classe

         public function edit(Request $request,$id){
             $classe=Clace::find($id);
            
                    $request->validate([
                        'classe'=>['required','string','max:30',
                        'min:1',"unique:claces,nome,$classe->id"]
                         ]);
                         $verify=$request->classe;
                         $siculo=Siculo::where('id',$request->siculo_id)->first();
                         $curso= Curso::where('id',$request->curso_id)->first();
                         $req=$request;
                     
             if(($verify <=6 ) and isset($siculo->nome) and 
             ($siculo->nome=="Ensino Primário")){
                if ($request->filled('siculo_id') and $request->curso_id==null) {
                    $classe->update([
                        'nome'=>$request->classe==0? 'Iniciação':$request->classe.'-classe',
                        'siculo_id'=>$request->siculo_id,
                    ]);
                    return redirect()->back()->with('sms3','Classe editada com sucesso!');
                }else {
                  return redirect()->back()->with('warning','
                  É necessário selecionar o cíclo do Ensino Primário para esta classe!'); 
                }
    
            }elseif(($verify >=7 and $verify <=9 ) AND isset($siculo->nome) and 
            ($siculo->nome=='Primeiro Cíclo')){
    
                if ($request->filled('siculo_id') and $request->curso_id==null) {
                    $classe->update([
                        'nome'=>$request->classe.'-classe',
                        'siculo_id'=>$request->siculo_id
                    ]);
                    return redirect()->back()->with('sms3','Classe editada com sucesso!');
                }else {
                  return redirect()->back()->with('warning','
                  É necessário selecionar o cíclo do Primeiro Cíclo para esta classe!'); 
                }
    
         }elseif(($verify >=10 ) AND isset($curso->nome)){
            if ($request->filled('curso_id') and $request->siculo_id==null){
                $classe->update([
                    'nome'=>$request->classe.'-classe',
                    'curso_id'=>$request->curso_id
                ]);
                return redirect()->back()->with('sms3','Classe editada com sucesso!');
            }else {
              return redirect()->back()->with('warning','
              É necessário selecionar um curso!'); 
            }
     }else {
     return   redirect()->back()->with('warning','A classe inserida não pertence ao cíclo ou curso selecionada!');
         }
   
}

}
