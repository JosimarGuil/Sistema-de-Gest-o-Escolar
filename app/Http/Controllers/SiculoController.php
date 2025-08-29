<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siculo;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class SiculoController extends Controller
{
    
//Adicionar siculos

    public function store(Request $request)
    {
        $request->validate([
                'ciclu'=>['required','string','max:30','min:5','unique:siculos,nome,except,id']
        ]);       
        try 
        {
            Siculo::create(['nome'=>$request->ciclu]);
            ToastMagic::success('Cíclo inserido com sucesso!');
        } catch (\Throwable $th) 
        {
              ToastMagic::error('Erro ao inserir cíclo!');
        }
        return redirect()->back(); 
    }

// mover para lixeira 

    public function destroy($id)
    {
        try 
        {
            Siculo::find($id)->delete();
            ToastMagic::success('Cíclo deletado com sucesso!');
        } catch (\Throwable $th) 
        {
            ToastMagic::error('Erro ao deletar cíclo!');
        }
        return redirect()->back();
    }

}
