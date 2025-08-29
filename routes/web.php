<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\SiculoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\TurmasController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagamentosController;
use App\Models\Pagamento;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\Auth;

Route::get('/', [Controller::class, 'index'])->name('login')->middleware('guest');
Route::post('/logar', [Controller::class, 'logar'])->name('entrar');

Route::get('/logout', [Controller::class, 'logout'])->name('logout');

//routas do paine

Route::middleware('auth')->group(function () {

    Route::get('/painel', [PainelController::class, 'index'])
        ->name('painel');

    Route::get('/config', [PainelController::class, 'config'])
        ->name('config');
    // routas do siculo
    Route::post('/addSiculo', [SiculoController::class, 'store'])
        ->name('addSiculo');

    Route::delete('/deleteSiculo/{id}', [SiculoController::class, 'destroy'])
        ->name('deleteSiculo');

    Route::put('/updateSiculo/{id}', [SiculoController::class, 'edit'])
        ->name('updateSiculo');

    //rutas do curso
    Route::post('/addCurso', [CursoController::class, 'store'])
        ->name('addCurso');

    Route::put('/updateCurso/{id}', [CursoController::class, 'edit'])
        ->name('updateCurso');

    Route::delete('/deleteCurso/{id}', [CursoController::class, 'destroy'])
        ->name('deleteCurso');

    //rutas da classe
    Route::post('/addClasse', [ClasseController::class, 'store'])
        ->name('addClasse');

    Route::delete('/deleteClasse/{id}', [ClasseController::class, 'destroy'])
        ->name('deleteClasse');

    Route::put('/updateClasse/{id}', [ClasseController::class, 'edit'])
        ->name('updateClasse');


    //rutas da classe
    Route::post('/addSala', [SalaController::class, 'store'])
        ->name('addSala');

    //rutas da classe
    Route::put('/updateSala/{id}', [SalaController::class, 'edit'])
        ->name('updateSala');

    //rutas da classe
    Route::delete('/deleteSala/{id}', [SalaController::class, 'destroy'])
        ->name('deleteSala');

    //rutas da turma
    Route::post('/addTurma', [TurmasController::class, 'store'])
        ->name('addTurma');

    Route::delete('/deleteTurma/{id}', [TurmasController::class, 'destroy'])
        ->name('deleteTurma');

    Route::put('/updateTurma/{id}', [TurmasController::class, 'edit'])
        ->name('updateTurma');



    //rutas do Aluno
    Route::get('/alunos', [AlunosController::class, 'index'])
        ->name('alunos');

    Route::post('/Addalunos', [AlunosController::class, 'store'])
        ->name('Addalunos');

    Route::put('/Editalunos/{id}', [AlunosController::class, 'edit'])
        ->name('Editalunos');

    Route::delete('/Deletelunos/{id}', [AlunosController::class, 'destroy'])
        ->name('Deletelunos');


    //rutas do Aluno
    Route::get('/funcionaio', [FuncionarioController::class, 'index'])
        ->name('funcionario');

    Route::post('/funcionaio', [FuncionarioController::class, 'store'])
        ->name('Addfuncionario');

    Route::put('/funcionaio/{id}', [FuncionarioController::class, 'edit'])
        ->name('Editfuncionario');

    Route::delete('/Deletefuncionario/{id}', [FuncionarioController::class, 'destroy'])
        ->name('Deletefuncionario');

    //rutas do Usuários
    Route::get('/usuario', [UserController::class, 'index'])
        ->name('usuario');


    Route::post('/Promover', [UserController::class, 'Promover'])
        ->name('Promover');


    Route::put('/Editusuario/{id}', [UserController::class, 'edit'])
        ->name('Editusuario');

    Route::put('/desbilitar/{id}', [UserController::class, 'desbilitar'])
        ->name('desbilitar');

    Route::delete('/Deleteusuario/{id}', [UserController::class, 'destroy'])
        ->name('Deleteusuario');


    //rutas dos Psgamentos
    Route::get('/pagamentos', [PagamentosController::class, 'index'])
        ->name('pagamentos');

    Route::post('/addTipoPagamento', [PagamentosController::class, 'addTipoPagamento'])
        ->name('addTipoPagamento');

    Route::delete('/deleteTipoPagamentos/{id}', [PagamentosController::class, 'deleteTipoPagamentos'])
        ->name('deleteTipoPagamentos');


    Route::put('/editTipoPagamentos/{id}', [PagamentosController::class, 'editTipoPagamentos'])
        ->name('editTipoPagamentos');


    Route::post('/addPagamento', [PagamentosController::class, 'addPagamento'])
        ->name('addPagamento');


    Route::put('/editPagamento/{id}', [PagamentosController::class, 'editPagamento'])
        ->name('editPagamento');

    Route::delete('/DeleteEntradas/{id}', [PagamentosController::class, 'DeleteEntradas'])
        ->name('DeleteEntradas');


    Route::post('/addSaida', [PagamentosController::class, 'addSaida'])
        ->name('addSaida');

    Route::put('/edtSaida/{id}', [PagamentosController::class, 'editSaida'])
        ->name('editSaida');

    Route::get('/invoicePagamentos/{id}', function ($id) {
        $user = Auth::user();
        $pagamento = Pagamento::with([
            'aluno' => function ($query) {
                $query->with('classe', 'turma');
            },
            'meses',
            'tipo_pagamento',
            'funcionario'
        ])->find($id);

        if ($user->status == true) {
            if (($user->perfil == 'SEO' or
                $user->perfil == 'Dir Administrativo' or $user->perfil == 'Dir Geral' or
                $user->perfil == 'Secretário Financeiro' or
                $user->perfil == 'Financeiro')) {
                return view('painel.invoice', compact(['pagamento']));
            } else {
                ToastMagic::warning('Acesso negado!');
                return redirect()->back();
            }
        } else {
            Auth::logout();
            ToastMagic::warning('Usuário Desativado!');
            return redirect()->route('login');
        }
    })
        ->name('invoicePagamentos');
});
