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
use App\Models\Pagamento;
use App\Models\TipoPagamento;
use App\Http\Requests\TipoPagamentos;
use App\Models\Mese;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\Auth;

class PagamentosController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $classes = Clace::all();
        $tipos = TipoPagamento::with('clace')->get();
        $alunos = Aluno::orderBy('nome', 'asc')->get();
        $funcionarios = Funcionario::all();
        $meses = Mese::all();

        $entrada1 = Pagamento::where('aluno_id', '!=', null)->orWhere('outro', '!=', NULL)->get()->toArray();
        $saidas1 = Pagamento::where('aluno_id', null)->where('outro', null)->get()->toArray();
        $pamentosEntradas = Pagamento::with(['aluno', 'meses', 'tipo_pagamento'])
            ->where('aluno_id', '>', 0)->orWhere('outro', '!=', NULL)->orderBy('id', 'desc')->get();
        $pamentosSaidas = Pagamento::with(['aluno', 'meses', 'tipo_pagamento', 'funcionario'])
            ->where('aluno_id', null)->where('outro', null)->orderBy('id', 'desc')->get();
        $entradas = array_filter($entrada1, function ($item) {
            if (date('m', strtotime($item['created_at'])) == date('m')) {
                return true;
            } else {
                return false;
            }
        });

        $saidas = array_filter($saidas1, function ($item) {
            if (date('m', strtotime($item['created_at'])) == date('m')) {
                return true;
            } else {
                return false;
            }
        });

        $totalEntradas = 0;
        foreach ($entradas as $value) {
            $totalEntradas += $value['total'];
        }

        $totalSaidas = 0;
        foreach ($saidas as $value) {
            $totalSaidas += $value['total'];
        }

        $total1 = Pagamento::where('aluno_id', '!=', null)->Orwhere('outro', '!=', NULL)->get();
        $total = 0;
        $saidas2 = Pagamento::where('aluno_id', null)->where('outro', NULL)->get();
        $sub = 0;
        foreach ($saidas2 as $value) {
            $sub += $value->total;
        }
        foreach ($total1 as $value) {
            $total += $value->total;
        }
        $totalMes = ($totalEntradas - $totalSaidas);
        if ($user->status == true) {
            if (($user->perfil == 'SEO' or
                $user->perfil == 'Dir Administrativo' or $user->perfil == 'Dir Geral' or
                $user->perfil == 'Secretário Financeiro' or
                $user->perfil == 'Financeiro')) {
                return view('painel.pagamentos', compact([
                    'tipos',
                    'classes',
                    'funcionarios',
                    'alunos',
                    'meses',
                    'totalEntradas',
                    'pamentosEntradas',
                    'total',
                    'totalSaidas',
                    'sub',
                    'totalMes',
                    'pamentosSaidas'
                ]));
            } else {
                ToastMagic::warning('Acesso negado!');
                return redirect()->back();
            }
        } else {
            Auth::logout();
            ToastMagic::warning('Usuário Desativado!');
            return redirect()->route('login');
        }
    }

    public function addTipoPagamento(TipoPagamentos $request)
    {
        try {
            $tipo = TipoPagamento::where('tipo', $request->tipo)
                ->where('clace_id', $request->clace_id)->first() ?? false;
            if ($tipo == false) {
                TipoPagamento::create([
                    'tipo' => $request->tipo,
                    'clace_id' => $request->clace_id,
                    'preco' => $request->preco
                ]);
                ToastMagic::success('Tipo de pagamento inserido com sucesso!');
                return redirect()->back();
            } else {
                ToastMagic::warning('Já existe esse tipo de pagamento para esta classe!');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            ToastMagic::error('Erro ao inserir o tipo de pagamento!');
            return redirect()->back();
        }
    }

    public function deleteTipoPagamentos($id)
    {
        try {
            TipoPagamento::find($id)->delete();
            ToastMagic::success('Tipo de pagamento deletado com sucesso!');
            return redirect()->back();
        } catch (\Throwable $th) {
            ToastMagic::error('Erro ao deletar tipo de pagamento!');
            return redirect()->back();
        }
    }

    public function editTipoPagamentos(TipoPagamentos $request, $id)
    {
        try {
            TipoPagamento::find($id)->update(
                [
                    'tipo' => $request->tipo,
                    'clace_id' => $request->clace_id,
                    'preco' => $request->preco
                ]
            );
            ToastMagic::success('Tipo de pagamento editado com sucesso!');
            return redirect()->back();
        } catch (\Throwable $th) {
            ToastMagic::error('Erro ao editar o tipo de pagamento!');
            return redirect()->back();
        }
    }

    public function addPagamento(Request $request)
    {
        try {
            $tipo = TipoPagamento::find($request->tipo_pagamento_id) ?? false;
            $aluno = Aluno::find($request->aluno_id) ?? false;
            if ($tipo != false and $aluno != false) {
                $request->validate([
                    'aluno_id' => ['required', 'integer'],
                    'tipo_pagamento_id' => ['required', 'integer'],
                ]);

                if ($tipo->clace_id == $aluno->clace_id) {
                    if (($tipo->tipo == "Propina" or $tipo->tipo == "propina")) {
                        // pagamento de propinas
                        if (isset($request->meses) and $request->meses != null) {
                            $pagamento = Pagamento::create([
                                'tipo_pagamento_id' => $request->tipo_pagamento_id,
                                'aluno_id' => $request->aluno_id,
                                'total' => ($tipo->preco * count($request->meses))
                            ]);
                            $pagamento->meses()->sync($request->meses);
                            ToastMagic::success('Pagamento efectuado com sucesso!');
                            return redirect()->back();
                        } else {
                            ToastMagic::warning('Para se inserir propinas é necessário selecionar os meses a pagar!');
                            return redirect()->back();
                        }
                    } elseif (($tipo->tipo != "Propina" or $tipo->tipo != "propina")) {
                        // pagamentos do aluno sem propina
                        $pagamento = Pagamento::create([
                            'tipo_pagamento_id' => $request->tipo_pagamento_id,
                            'aluno_id' => $request->aluno_id,
                            'total' => isset($request->qnt) ? $tipo->preco * $request->qnt : $tipo->preco,
                            'qnt' => $request->qnt,
                            'outro' => $request->outro
                        ]);

                        $pagamento->meses()->sync($request->meses);
                        ToastMagic::success('Pagamento efectuado com sucesso!');
                        return redirect()->back();
                    }
                } else {
                    ToastMagic::warning('A classe do aluno selecionado
                seve ser compatível com a classe do tipo de pagamento!');
                    return redirect()->back();
                }
            } else {

                $request->validate([
                    'preco' => ['required', 'integer'],
                    'outro' => ['required', 'string', 'max:100']
                ]);
                $pagamento = Pagamento::create([
                    'total' => isset($request->qnt) ? $request->preco * $request->qnt : $request->preco,
                    'qnt' => $request->qnt,
                    'outro' => $request->outro
                ]);

                $pagamento->meses()->sync($request->meses);
                ToastMagic::success('Pagamento efectuado com sucesso!');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            ToastMagic::error('Erro ao efectuar o pagamento!');
            return redirect()->back();
        }
    }


    public function editPagamento(Request $request, $id)
    {
        try {
            $tipo = TipoPagamento::find($request->tipo_pagamento_id);
            $aluno = Aluno::find($request->aluno_id);
            $paga = Pagamento::find($id);

            if ($tipo != false and $aluno != false) {
                $request->validate([
                    'aluno_id' => ['required', 'integer'],
                    'tipo_pagamento_id' => ['required', 'integer'],
                ]);

                if ($tipo->clace_id == $aluno->clace_id) {
                    if (($tipo->tipo == "Propina" or $tipo->tipo == "propina")) {
                        // pagamento de propinas
                        if (isset($request->meses) and $request->meses != null) {
                            $paga->update([
                                'tipo_pagamento_id' => $request->tipo_pagamento_id ?? $paga->tipo_pagamento_id,
                                'aluno_id' => $request->aluno_id ?? $paga->aluno_id,
                                'total' => ($tipo->preco * count($request->meses)) ?? $paga->total
                            ]);
                            $paga->meses()->sync($request->meses);
                            ToastMagic::success('Pagamento efectuado com sucesso!');
                            return redirect()->back();
                        } else {
                            ToastMagic::warning('Para se inserir propinas é necessário selecionar os meses a pagar!');
                            return redirect()->back();
                        }
                    } elseif (($tipo->tipo != "Propina" or $tipo->tipo != "propina")) {
                        // pagamentos do aluno sem propina
                        $paga->update([
                            'tipo_pagamento_id' => $request->tipo_pagamento_id ?? $paga->tipo_pagamento_id,
                            'aluno_id' => $request->aluno_id ?? $paga->aluno_id,
                            'total' => isset($request->qnt) ? $tipo->preco * $request->qnt : $tipo->preco ?? $paga->total,
                            'qnt' => $request->qnt ?? $paga->qnt,
                            'outro' => $request->outro ?? $paga->outro
                        ]);

                        $paga->meses()->sync($request->meses);
                        ToastMagic::success('Pagamento efectuado com sucesso!');
                        return redirect()->back();
                    }
                } else {
                    ToastMagic::success('A classe do aluno selecionado
                seve ser compatível com a classe do tipo de pagamento!');
                    return redirect()->back();
                }
            } else {

                $request->validate([
                    'preco' => ['required', 'integer'],
                    'outro' => ['required', 'string', 'max:100']
                ]);
                $paga->update([
                    'total' => isset($request->qnt) ? $request->preco * $request->qnt : $request->preco,
                    'qnt' => $request->qnt ?? $paga->qnt,
                    'outro' => $request->outro ?? $paga->outro
                ]);

                $paga->meses()->sync($request->meses);
                ToastMagic::success('Pagamento efectuado com sucesso!');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            ToastMagic::error('Erro ao editar o pagamento!');
            return redirect()->back();
        }
    }


    public function DeleteEntradas($id)
    {
        try {
            Pagamento::find($id)->delete();
            ToastMagic::success('Pagamento deletado com sucesso!');
            return redirect()->back();
        } catch (\Throwable $th) {
            ToastMagic::error('Erro ao deletar o pagamento!');
            return redirect()->back();
        }
    }

    public function addSaida(Request $request)
    {
        try {
            $saldo = Pagamento::all();
            $actual = 0;
            foreach ($saldo as $item) {
                $actual += $item->total;
            }

            if (
                $request->tipo == "Salário" or $request->tipo == "salário" or
                $request->tipo == "Salario" or $request->tipo == "salario"  and
                $request->filled('meses')
            ) {

                $func = Funcionario::find($request->funcionario_id);
                $request->validate([
                    'tipo' => ['required', 'string', 'max:50'],
                    'funcionario_id' => ['required', 'integer'],
                    'meses' => ['required']
                ]);

                if (($actual > $func->salario)) {
                    Pagamento::create([
                        'funcionario_id' => $request->funcionario_id,
                        'tipo' => $request->tipo,
                        'desci' => $request->descri,
                        'total' => $func->salario * count($request->meses)
                    ]);
                    ToastMagic::success('Saída de valor efectuado com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('O saldo é insuficiente para efectuar a saída de Valor!');
                    return redirect()->back();
                }
            } elseif (
                $request->tipo != 'Salário' or $request->tipo != 'salário'
                or    $request->tipo != "Salario" or $request->tipo != "salario"
            ) {

                $request->validate([
                    'tipo' => ['required', 'string', 'max:50'],
                    'descri' => ['required', 'string', 'max:100'],
                    'preco' => ['required', 'integer']
                ]);
                $valor = isset($request->qnt) ? $request->preco * $request->qnt : $request->preco;
                if ($actual > $valor) {
                    Pagamento::create([
                        'tipo' => $request->tipo,
                        'desci' => $request->descri,
                        'price' => $request->preco,
                        'total' => isset($request->qnt) ?
                            $request->preco * $request->qnt : $request->preco,
                        'qnt' => $request->qnt,
                        'funcionario_id' => is_numeric($request->funcionario_id) ? $request->funcionario_id : NULL
                    ]);
                    ToastMagic::success('Saída de valor efectuado com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('O saldo é insuficiente para efectuar a saída de Valor!');
                    return redirect()->back();
                }
            } else {
                ToastMagic::warning('Para efectuar o pagamento de salário é necessário 
            selecionar os meses e o funcionário');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            ToastMagic::error('Erro ao efectuar a saída de valor!');
            return redirect()->back();
        }
    }


    public function editSaida(Request $request, $id)
    {
        try {
            $saida = Pagamento::find($id);
            if (!$saida) {
                ToastMagic::error('Saída de valor não encontrada!');
                return redirect()->back();
            }

            $saldo = Pagamento::all();
            $actual = 0;
            foreach ($saldo as $item) {
                $actual += $item->total;
            }

            if (
                $request->tipo == "Salário" or $request->tipo == "salário" or
                $request->tipo == "Salario" or $request->tipo == "salario"  and
                $request->filled('meses')
            ) {

                $func = Funcionario::find($request->funcionario_id);
                $request->validate([
                    'tipo' => ['required', 'string', 'max:50'],
                    'funcionario_id' => ['required', 'integer'],
                    'meses' => ['required']
                ]);

                if (($actual > $func->salario)) {
                    $saida->update([
                        'funcionario_id' => $request->funcionario_id,
                        'tipo' => $request->tipo,
                        'desci' => $request->descri,
                        'total' => $func->salario * count($request->meses)
                    ]);
                    ToastMagic::success('Saída de valor efectuado com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('O saldo é insuficiente para efectuar a saída de Valor!');
                    return redirect()->back();
                }
            } elseif (
                $request->tipo != 'Salário' or $request->tipo != 'salário'
                or    $request->tipo != "Salario" or $request->tipo != "salario"
            ) {

                $request->validate([
                    'tipo' => ['required', 'string', 'max:50'],
                    'descri' => ['required', 'string', 'max:100'],
                    'preco' => ['required', 'integer'],
                    'qnt' => ['required', 'integer']
                ]);
                $valor = isset($request->qnt) ? $request->preco * $request->qnt : $request->preco;
                if ($actual > $valor) {
                    $saida->update([
                        'tipo' => $request->tipo,
                        'desci' => $request->descri,
                        'price' => $request->preco,
                        'total' => isset($request->qnt) ?
                            $request->preco * $request->qnt : $request->preco,
                        'qnt' => $request->qnt,
                        'funcionario_id' => is_numeric($request->funcionario_id) ? $request->funcionario_id : NULL
                    ]);
                    ToastMagic::success('Saída de valor efectuado com sucesso!');
                    return redirect()->back();
                } else {
                    ToastMagic::warning('O saldo é insuficiente para efectuar a saída de Valor!');
                    return redirect()->back();
                }
            } else {
                ToastMagic::warning('Para efectuar o pagamento de salário é necessário 
            selecionar os meses e o funcionário');
                return redirect()->back();
            }
        } catch (\Throwable $th) 
        {
            ToastMagic::error('Erro ao editar a saída de valor!');
            return redirect()->back();
        }
    }
}
