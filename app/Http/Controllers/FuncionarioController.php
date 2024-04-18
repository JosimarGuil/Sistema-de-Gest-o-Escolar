<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Http\Requests\FuncionarioRequest;
use App\Models\User;
class FuncionarioController extends Controller
{
    public function index(){
        $funcionario=Funcionario::all();
        $usuarios= User::where('status',true)->get();
        
        if(auth()->user()->status==true) {        
            if((auth()->user()->perfil=='SEO' OR 
            auth()->user()->perfil=='Dir Administrativo' OR auth()->user()->perfil=='Dir Geral' OR 
            auth()->user()->perfil=='Secretário Financeiro' OR 
            auth()->user()->perfil=='Financeiro')){
        return view('painel.trabalhador',compact(
            'funcionario',
            'usuarios'
        ));
    }else {
        return redirect()->back();
    }
}else {
    Auth::logout();

    return redirect()->route('login')->with('sms','Usuário Desativado!');
        }
    }
    public function store(Request $request){
        $request->validate([
            'nome'=>['required','string','max:50','min:5'],
            'email'=>['required','email',"unique:funcionarios,email"],
            'data'=>['required'],
            'morada'=>['required','string','max:35','min:15'],
            'fone'=>['required','integer',"unique:funcionarios,fone"],
            'cargo'=>['required'],
            'salario'=>['required'],
            'foto'=>['required','image','mimes:jpg,png,jpeg','max:1024'],
            'doc'=>['required','mimes:pdf','max:2024'],
            'sexo'=>['required']
         ]);

            if ((date('Y')- date('Y', strtotime($request->data))) >=18) {
                    Funcionario::create([
                        'nome'=>$request->nome,
                        'sexo'=>$request->sexo,
                        'email'=>$request->email,
                        'data'=>$request->data,
                        'morada'=>$request->morada,
                        'fone'=>$request->fone,
                        'cargo'=>$request->cargo,
                        'salario'=>$request->salario,
                        'foto'=>$request->foto->store('funcionarios/fotos',"public"),
                        'documentos'=>$request->doc->store('funcionarios/docs',"public"),
                        'promocao'=>false
                       ]);
                       return redirect()->back()
                    ->with('sms1','Funcionário inserido com sucesso!');
                }else {
                    return redirect()->back()
                    ->with('warning','O funcionário de ter uma idade entre 18 ou mais para ser um membro da Empresa!'); 
                }
    }

    public function edit(FuncionarioRequest $request, $id){

        if ((date('Y')- date('Y', strtotime($request->data))) >=18) {
            $funcionario=Funcionario::find($id);
              $funcionario->update([
                'nome'=>$request->nome,
                'sexo'=>$request->sexo,
                'email'=>$request->email,
                'data'=>$request->data,
                'morada'=>$request->morada,
                'fone'=>$request->fone,
                'cargo'=>$request->cargo,
                'salario'=>$request->salario,
               'foto'=>($request->filled('img'))?
               $request->img->store('funcionarios/fotos',"public")
               :$funcionario->foto,

               'documentos'=>($request->filled('doc'))?
               $request->doc->store('funcionarios/docs',"public"):$funcionario->documentos,
               'promocao'=>$funcionario->promocao
           ]);
           return redirect()->back()
        ->with('sms3','Funcionário editado com sucesso!');
    }else {
        return redirect()->back()
        ->with('warning','O funcionário de ter uma idade entre 18 ou mais para ser um membro da Empresa!'); 
    }

    }

    public function destroy($id){
        if (is_numeric($id)) {
            Funcionario::find($id)->delete();
           
            return redirect()->back()->with('sms2','Funcionário movido para lixeira!');
          }else{
           return redirect()->back();
          }
    }
}
