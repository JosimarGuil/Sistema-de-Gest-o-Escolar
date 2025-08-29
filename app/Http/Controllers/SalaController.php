<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class SalaController extends Controller
{
    //Adicinar salas

    public function store(Request $request)
    {
        $request->validate([
            'sala' => [
                'required',
                'integer',
                'unique:salas,sala,except,id'
            ]
        ]);

        try {
            if ($request->sala > 0) {
                Sala::create($request->all());
                ToastMagic::success('Sala inserida com sucesso!');
            } else {
                ToastMagic::warning('O númro da sala não pode ser negativo!');
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            ToastMagic::warning('Erro ao inserir sala!');
        }
    }

    // mover para lixeira
    public function destroy($id)
    {
        try {
            Sala::find($id)->delete();
            ToastMagic::success('Sala detada com sucesso!');
        } catch (\Throwable $th) {
            ToastMagic::warning('Erro ao deletar sala!');
        }
        return redirect()->back();
    }
    //EDITAR SALA
    public function edit(Request $request, $id)
    {
        $sala = Sala::find($id);
        $request->validate([
            'sala' => [
                'required',
                'integer',
                "unique:salas,sala,$sala->id"
            ]
        ]);

        try {
            if ($request->sala > 0)
            {
                $sala->update($request->all());
                ToastMagic::success('Sala editada com sucesso!');
            } else {
                ToastMagic::warning('O númro da sala não pode ser negativo!');
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            ToastMagic::warning('Erro ao editar sala!');
        }
    }
}
