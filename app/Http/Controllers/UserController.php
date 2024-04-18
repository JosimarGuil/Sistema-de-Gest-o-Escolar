<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\User_Request;
use App\Models\Funcionario;
class UserController extends Controller
{
    public function index(){
        $user=User::where('id','!=',1)->where('perfil','!=','SEO')->get();
        if(auth()->user()->status==true ) {

        if ((auth()->user()->perfil=='SEO' OR 
        auth()->user()->perfil=='Dir Geral') ) {
            return view('painel.usuario',compact('user'));
            
        }else {
            return redirect()->back();
        }
      
    }else{
            
        Auth::logout();
    
        return redirect()->route('login')->with('sms','Usuário Desativado!');
            }
 
    }

    public function Promover(Request $request){
         $request->validate([
            'nome'=>['required','max:50','min:5'],
            'email'=>['required','email',"unique:users,email"],
            'data'=>['required'],
            'morada'=>['required','string','max:35','min:15'],
            'perfil'=>['required'],     
            'sexo'=>['required'],
            'fone'=>['required'],
            'password'=>['required','max:15','min:8'],
            'confirm'=>['required','max:15','min:8','same:password']
         ]);
           User::create([
            'name'=>$request->nome,
            'fone'=>$request->fone,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'status'=>true,
            'sexo'=>$request->sexo,
            'morada'=>$request->morada,
            'data'=>$request->data,
            'foto'=>$request->foto,
            'documentos'=>$request->doc,
            'perfil'=>$request->perfil
           ]);

            Funcionario::find($request->promo)->update([
                'promocao'=>true
            ]);
                   
               return redirect()->back()->with('sms3','Funcionário promovido com sucesso!');

    }


    public function edit(User_Request $request, $id){

        if ((date('Y')- date('Y', strtotime($request->data))) >=18) {
            $user=User::find($id);
              $user->update([
                'name'=>$request->nome,
                'sexo'=>$request->sexo,
                'email'=>$request->email,
                'data'=>$request->data,
                'morada'=>$request->morada,
                'fone'=>$request->fone,
                'perfil'=>$request->perfil,
                'foto'=>($request->filled('foto'))?
               $request->foto->store('users/fotos',"public")
               :$user->foto,
               'documentos'=>($request->filled('doc'))?
               $request->doc->store('users/docs',"public"):$user->documentos
           ]);
           return redirect()->back()
        ->with('sms3','Usuário editado com sucesso!');
    }else {
        return redirect()->back()
        ->with('warning','A idade é insuficiente!'); 
    }

    }


    public function desbilitar(Request $request, $id){
        User::find($id)->update([
            'status'=>$request->status
        ]);

        return redirect()->back()->with('sms3','Status do usuário editado com sucesso!');
    }

    public function destroy($id){
        if (is_numeric($id)) {
            $user=User::find($id);
            $func=Funcionario::where('email',$user->email)->first()?? false;
            if ($func) {
                $func->update([
                    'promocao'=>false
                ]);
            }
         
            User::find($id)->delete();
            return redirect()->back()->with('sms2','Usuário movido para a lixeira!');
          }else{
           return redirect()->back();
          }
    }

}
