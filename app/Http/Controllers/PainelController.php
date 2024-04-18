<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siculo;
use App\Models\Curso;
use App\Models\Clace;
use App\Models\Sala;
use App\Models\Turma;
use App\Models\User;
use App\Models\Funcionario;
use App\Models\Aluno;
use Illuminate\Support\Facades\Auth;
class PainelController extends Controller
{
    
    public function index(){
        $usuarios=User::all()->count();
        $fucnionarios=Funcionario::all()->count();
        $alunos=Aluno::all()->count();
        $usuarios=User::all()->count();
        $turmas=Turma::all()->count();
        if(auth()->user()->status==true) {
            return view('painel.painel',
        compact('usuarios','fucnionarios','alunos','usuarios','turmas'));

        }else {
            
    Auth::logout();

    return redirect()->route('login')->with('sms','Usuário Desativado!');
        }
            }

    public function config(){
         $siculos= Siculo::all();
         $cursos= Curso::all();
         $classes= Clace::with(['curso','siculo'])->get();
         $salas= Sala::all();
         $turmas=Turma::with(['clace','sala'])->get();
         if(auth()->user()->status==true) {
        
        if((auth()->user()->perfil=='SEO' OR 
        auth()->user()->perfil=='Dir Administrativo' OR auth()->user()->perfil=='Dir Geral' OR 
        auth()->user()->perfil=='Dr Pedagógico')){

            return view('painel.configuracao',compact('turmas','siculos','cursos','salas','classes'));

        
        }else {
            return redirect()->back();
        }
        
    }else {
            
        Auth::logout();
    
        return redirect()->route('login')->with('sms','Usuário Desativado!');
            }
}

}