<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as
 BaseController;
use App\Models\User;
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

    if (Auth::attempt($credis)) {
     return redirect()->route('painel')
       ->with('sms','Bem vindo ao painel Admin!');
  //  dd('DEU');
    }else{
//      dd('XX');
      return redirect()->back()->with('sms','Usuário náo encontrado!');
    }


   }

   public function logout(){

    Auth::logout();

    return redirect()->route('login');
   }

}
