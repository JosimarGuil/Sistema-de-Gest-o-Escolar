<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as
 BaseController;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
  
   public function index(){

    return view('auth.login');
 
   }


   public function logar(Request $request){
       
    $credis=[
      'email'=>$request->email,
      'password'=>$request->password
    ];

    if (Auth::attempt($credis)) 
    {
        ToastMagic::success('Usuário logado com sucesso!');
        return redirect()->route('painel');
    }else
    {
      ToastMagic::error('Usuário ou senha inválido');
      return redirect()->back();
    }


   }

   public function logout(){

    Auth::logout();

    return redirect()->route('login');
   }

}
