<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Siculo;
use App\Models\Curso;
use App\Models\Clace;
use App\Models\Sala;
use App\Models\Turma;
use App\Models\Aluno;
use App\Http\Requests\AlunoRequest;
class AlunosController extends Controller
{
    public function index(){    
        $classes= Clace::with(['curso','siculo'])->get();     
        $turmas=Turma::with(['clace','sala'])->get();
        $alunos=Aluno::with(['curso','sala','turma','siculo','clace'])->
        orderBy('nome','asc')->get();

        if(auth()->user()->status==true) {

        return view('painel.alunos',compact('classes','alunos','turmas'));

    }else {
            
        Auth::logout();
    
        return redirect()->route('login')->with('sms','Usuário Desativado!');
            }
    }


    public function store(Request $request){
     
     $request->validate([
        'nome'=>['required','string','max:50','min:5'],
        'email'=>['required','email',"unique:alunos,email"],
        'data'=>['required'],
        'localiza'=>['required','string','max:35','min:15'],
        'fone'=>['required','integer',"unique:alunos,fone"],
        'classe_id'=>['required'],
        'turma_id'=>['required'],
        'img'=>['required','image','mimes:jpg,png'],
        'doc'=>['required','mimes:pdf'],
        'sexo'=>['required']
     ]);
         
        $turma=Turma::find($request->turma_id);
        $classe=Clace::find($request->classe_id);
        $idade=date('Y')- date('Y', strtotime($request->data));
        if($turma->clace_id==$request->classe_id) {
         
            if ($idade>=5) {
                Aluno::create([
                    'nome'=>$request->nome,
                    'sexo'=>$request->sexo,
                    'email'=>$request->email,
                    'data'=>$request->data,
                    'localiza'=>$request->localiza,
                    'fone'=>$request->fone,
                    'localiza'=>$request->localiza,
                    'clace_id'=>$request->classe_id,
                    'turma_id'=>$request->turma_id,
           //passando siculo ao aluno
                    'siculo_id'=>isset($classe->siculo_id)?
                     Siculo::find($classe->siculo_id)->id:null,
           //Paasando curso ao aluno
                    'curso_id'=>isset($classe->curso_id)?
                    Curso::find($classe->curso_id)->id:null,
                    //
                    'sala_id'=> Sala::find($turma->sala_id)->id,
                       'img'=>$request->img->store('alunos/fotos',"public"),
                       'doc'=>$request->doc->store('alunos/docs',"public")
                   ]);
                   return redirect()->back()
                ->with('sms1','Aluno inserido com sucesso!');
            }else {
                return redirect()->back()
                ->with('warning','A idade mínima para se estudar é 5 nos de idade!'); 
            }
           
        }else{

            return redirect()->back()
            ->with('warning','A classe e a Turma selecionada devem ser compatíveis!');
        }
     

    }


    public function  edit(AlunoRequest $request,$id){
      
         
        $turma=Turma::find($request->turma_id);
        $classe=Clace::find($request->classe_id);
        
        if($turma->clace_id==$request->classe_id) {

            if ((date('Y')- date('Y', strtotime($request->data))) >=5) {
                $aluno=Aluno::find($id);
                  $aluno->update([
                'nome'=>$request->nome,
                'sexo'=>$request->sexo,
                'email'=>$request->email,
                'data'=>$request->data,
                'localiza'=>$request->localiza,
                'fone'=>$request->fone,
                'localiza'=>$request->localiza,
                'clace_id'=>$request->classe_id,
                'turma_id'=>$request->turma_id,
       //passando siculo ao aluno
                'siculo_id'=>isset($classe->siculo_id)?
                 Siculo::find($classe->siculo_id)->id:null,
       //Paasando curso ao aluno
                'curso_id'=>isset($classe->curso_id)?
                Curso::find($classe->curso_id)->id:null,
                //
                'sala_id'=> Sala::find($turma->sala_id)->id,
                   'img'=>($request->filled('img'))?
                   $request->img->store('alunos/fotos',"public")
                   :$aluno->img,

                   'doc'=>($request->filled('doc'))?
                   $request->doc->store('alunos/docs',"public"):$aluno->doc
               ]);
               return redirect()->back()
            ->with('sms3','Aluno editado com sucesso!');
        }else {
            return redirect()->back()
            ->with('warning','A idade mínima para se estudar é 5 nos de idade!'); 
        }
        }else{

            return redirect()->back()
            ->with('warning','A classe e a Turma selecionada devem ser compatíveis!');
        }
     
        
    }


    public function destroy($id){
        if (is_numeric($id)) {
            Aluno::find($id)->delete();
            return redirect()->back()->with('sms2','Aluno deletado com sucesso!');
          }else{
           return redirect()->back();
          }
    }
}
