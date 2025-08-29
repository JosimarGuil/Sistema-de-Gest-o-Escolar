@extends('tema.tema')

@section('title', 'Configurações da Escola Canongue')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            Configurações gerais
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Painel</a></li>
                            <li class="breadcrumb-item active">Configurações da Escola</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Mensagens de retorno -->
        <section class="content-header">
            <div class="container-fluid">
                @if (session('sms1'))
                    <div class="" style=" margin-bottom: 5px;">
                        <div class="card">
                            <div class="bg-primary" style="width:100%; margin: auto;padding: 10px; ">
                                <span>{{ session('sms1') }}</span>
                                <div class="card-tools" style="float: right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
                @if (session('sms2'))
                    <div class=" " style=" margin-bottom: 5px; ">
                        <div class="card">
                            <div class="bg-danger" style="width:100%; margin: auto;padding: 10px; ">
                                <span>{{ session('sms2') }}</span>
                                <div class="card-tools" style="float: right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
                @if (session('sms3'))
                    <div class=" " style=" margin-bottom: 5px; border-radius: 5px ">
                        <div class="card">
                            <div class="bg-success" style="width:100%; margin: auto;padding: 10px; ">
                                <span>{{ session('sms3') }}</span>
                                <div class="card-tools" style="float: right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
                @if (session('warning'))
                    <div class="" style=" margin-bottom: 5px;">
                        <div class="bg-warning" style="width:100%; margin: auto;padding: 10px;">
                            <span>{{ session('warning') }}</span>
                            <div class="card-tools" style="float: right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Painel de Configuração
                        </h3>
                    </div>
                    <div class="card-body  justify-content-around">
                        @if (count($siculos) < 2)
                            <button type="button" class="btn btn-success toastrDefaultSuccess text-white" data-toggle="modal"
                                data-target="#modal-defaultciclus1">
                                Adicionar Cíclo
                            </button>
                        @endif
                        <button type="button" class="btn btn-info  toastrDefaultInfo" data-toggle="modal"
                            data-target="#modal-defaultcursos2">
                            Adicionar cursos
                        </button>

                        <button type="button" class="btn btn-warning  toastrDefaultInfo text-white" data-toggle="modal"
                            data-target="#modal-defaultclasses5">
                            Adicionar Classe
                        </button>

                        <button type="button" class="btn btn-primary  toastrDefaultWarning" data-toggle="modal"
                            data-target="#modal-defaultsalas4">
                            Adicionar salas
                        </button>

                        <button type="button" class="btn btn-danger  toastrDefaultError" data-toggle="modal"
                            data-target="#modal-defaultturmas3">
                            Adicionar Turmas
                        </button>

                        <div class="text-muted mt-3">
                            <span>Zona restrita aos administradores do Canongue</span>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Ajustar Configurações da escola</h3><br>
                        <hr>
                        <button id="bci" type="button" class="btn btn-default toastrDefaultError"
                            onclick=" siculos(this)" style="color: white;background-color:#007bff ">
                            Ver todos Cíclos
                        </button>

                        <button id="bcu" type="button" class="btn btn-default toastrDefaultError"
                            onclick=" cursos(this)">
                            Ver todos Cursos
                        </button>
                        <button id="bcla" type="button" class="btn btn-default toastrDefaultError"
                            onclick="classes(this)">
                            Ver todas Classes
                        </button>
                        <button id="bsala" type="button" class="btn btn-default toastrDefaultError"
                            onclick="salas(this)">
                            Ver todas Salas
                        </button>
                        <button id="bturmas" type="button" class="btn btn-default toastrDefaultError"
                            onclick="turmas(this)">
                            Ver todas Turmas
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!--TABELA DOS SICULOS-->
                        <div id="siculo" style="display: block">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Cíclo</th>
                                        <th>----</th>
                                        <th>----</th>
                                        <th>----</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($siculos as $siculo)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $siculo->nome }}</td>
                                            <td>----</td>
                                            <th>----</th>
                                            <th>----</th>
                                            <td>
                                                <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#modal-defaulteditciclu1{{ $siculo->id }}"
                                                    style="display: inline-block"><i class="fas fa-trash"
                                                    title="Mover para Lixeira"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-defaulteditciclu1{{ $siculo->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class=" text-warning text-md"> <b>AVISO!</b> </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span style="background-color:#ccc; margin:auto;
                                                        display :block; width:50px; height:50px; text-align:center;
                                                        display:flex; align-items:center; justify-content:center;
                                                        border-radius: 50%; font-size:25px;" class="text-danger">
                                                           <i class="fas fa-trash " title="Mover para Lixeira"></i>
                                                        </span>
                                                        <p class="text-default text-center mt-2">Tem certeza que deseja mover este cíclo
                                                            para a lixeira? </p>
                                                        <form action="{{ route('deleteSiculo', $siculo->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="card-footer">
                                                                <button type="submit"
                                                                    class="btn btn-success
                                                            text-white px-4">Sim
                                                            </button>
                                                        </form>
                                                        <button type="button"
                                                            class="btn btn-danger
                                                            text-white px-4"
                                                            data-dismiss="modal">Não</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                        {{-- <div class="modal fade" id="modal-defaulteditciclu{{ $siculo->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Editar Cíclo</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="quickForm"
                                                            action="{{ route('updateSiculo', $siculo->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Cíclo</label>
                                                                    <select name="ciclu" class="form-control"
                                                                        id="nome" required>
                                                                        <option value="">Selecione um Cíclo</option>
                                                                        <option value="Ensino Primário"
                                                                            {{ $siculo->nome == 'Ensino Primário' ? 'selected' : '' }}>
                                                                            Ensino Primário</option>
                                                                        <option value="Ensino de Base"
                                                                            {{ $siculo->nome == 'Ensino de Base' ? 'selected' : '' }}>
                                                                            Ensino de Base</option>
                                                                    </select>

                                                                    @error('ciclu')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <!-- /.card-body -->
                                                            <div class="card-footer">

                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Fechar</button>

                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div> --}}
                    @empty
                        <p class="text-danger">Nenhum Cíclo foi encontrado!</p>
                        @endforelse
                        <tfoot>
                            <tr>
                                <th>Codigo</th>
                                <th>Cíclo</th>
                                <th>----</th>
                                <th>----</th>
                                <th>----</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <!--TABELA DAS TURMAS-->
                    <div id="turmas" style="display: none">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Código</td>
                                    <th>Turmas</th>
                                    <th>Período</th>
                                    <th>Classe</th>
                                    <th>Sala</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($turmas as $turma)
                                    <tr>
                                        <td>{{ $turma->id }}</td>
                                        <td>{{ $turma->nome }}</td>
                                        <td>{{ $turma->periodo }}</td>
                                        <td>
                                            {{ $turma->clace->curso_id > 0 ? $turma->clace->nome . '-' . $turma->clace->curso->nome : $turma->clace->nome }}
                                        </td>
                                        <td>{{ $turma->sala->sala }}</td>
                                        <td>
                                            <button class="btn btn-success" data-toggle="modal"
                                                data-target="#modal-defaulteditturma{{ $turma->id }}"><i
                                                    class="fas fa-edit"></i></button>
                                            <button class="btn btn-warning" data-toggle="modal"
                                                data-target="#modal-defaulteditturma1{{ $turma->id }}"
                                                style="display: inline-block"><i class="fas fa-trash"
                                                    title="Mover para Lixeira"></i></button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-defaulteditturma1{{ $turma->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title text-md"> <b>AVISO!</b> </h4>
                                                </div>
                                                <div class="modal-body">
                                                  <span style="background-color:#ccc; margin:auto;
                                                        display :block; width:50px; height:50px; text-align:center;
                                                        display:flex; align-items:center; justify-content:center;
                                                        border-radius: 50%; font-size:25px;" class="text-danger">
                                                           <i class="fas fa-trash " title="Mover para Lixeira"></i>
                                                        </span>
                                                    <p class="text-default text-center mt-2">Tem certeza que deseja mover esta turma para a
                                                        lixeira? </p>
                                                    <form action="{{ route('deleteTurma', $turma->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="card-footer">
                                                            <button type="submit"
                                                                class="btn btn-warning
                                                            text-white px-4">Sim</button>
                                                    </form>
                                                    <button type="button"
                                                        class="btn btn-danger
                                                            text-white px-4"
                                                        data-dismiss="modal">Não</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                    <div class="modal fade" id="modal-defaulteditturma{{ $turma->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar Turma</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="quickForm" action="{{ route('updateTurma', $turma->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Turma</label>
                                                <input type="text" name="turma" required class="form-control"
                                                    id="exampleInputEmail1" placeholder="Turma" maxlength="30"
                                                    minlength="2" value="{{ old('turma', $turma->nome) }}">
                                                @error('turma')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Período</label>
                                                <select name="periodo" id="" class="form-control" required>
                                                    <option value="">Selecionar Período</option>
                                                    <option value="Manhã"
                                                        {{ $turma->periodo == 'Manhã' ? 'selected' : '' }}>
                                                        Manhã</option>
                                                    <option value="Tarde"
                                                        {{ $turma->periodo == 'Tarde' ? 'selected' : '' }}>
                                                        Tarde</option>
                                                    <option value="Noite"
                                                        {{ $turma->periodo == 'Noite' ? 'selected' : '' }}>
                                                        Noite</option>
                                                </select>
                                                @error('periodo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Classe</label>
                                                <select name="clace_id" id="" class="form-control" required>
                                                    <option value="">Selecionar Classe</option>
                                                    @forelse ($classes as $siculo)
                                                        @if (isset($siculo->curso_id) and $siculo->curso_id != '')
                                                            <option value="{{ $siculo->id }}"
                                                                {{ $turma->clace->nome == $siculo->nome ? 'selected' : '' }}>
                                                                {{ $siculo->nome . '-' . $siculo->curso->nome }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $siculo->id }}"
                                                                {{ $turma->clace->nome == $siculo->nome ? 'selected' : '' }}>
                                                                {{ $siculo->nome . '-' . $siculo->siculo->nome }}
                                                            </option>
                                                        @endif

                                                    @empty
                                                    @endforelse
                                                </select>
                                                @error('clace_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Salas</label>
                                                <select name="sala_id" id="" class="form-control" required>
                                                    <option value="">Selecionar Salas</option>
                                                    @forelse ($salas as $curso)
                                                        <option value="{{ $curso->id }}"
                                                            {{ $turma->sala->sala == $curso->sala ? 'selected' : '' }}>
                                                            {{ $curso->sala }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                @error('sala_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="fas fa-edit"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                @empty
                    <span class="text-danger">Nenhuma sala foi encontrado!</span>
                    @endforelse
                    <tfoot>
                        <tr>
                            <td>Id</td>
                            <th>Turmas</th>
                            <th>Período</th>
                            <th>Classe</th>
                            <th>Sala</th>

                            <th>Ações</th>
                        </tr>
                    </tfoot>
                    </table>
                </div>


                <!--TABELA DAS SALAS-->
                <div id="salas" style="display: none">
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Salas</th>
                                <th>----</th>
                                <th>----</th>
                                <th>----</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($salas as $sala)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $sala->sala }}</td>
                                    <td>----</td>
                                    <th>----</th>
                                    <th>----</th>
                                    <td>
                                        <button class="btn btn-success" data-toggle="modal"
                                            data-target="#modal-defaulteditsala{{ $sala->id }}"><i
                                                class="fas fa-edit"></i></button>

                                        <button class="btn btn-warning" data-toggle="modal"
                                            data-target="#modal-defaulteditsala1{{ $sala->id }}"
                                            style="display: inline-block" title="Mover para Lixeira"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-defaulteditsala1{{ $sala->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="text-md text-warning"> <b>AVISO!</b> </h4>
                                            </div>
                                            <div class="modal-body">
                                                    <span style="background-color:#ccc; margin:auto;
                                                        display :block; width:50px; height:50px; text-align:center;
                                                        display:flex; align-items:center; justify-content:center;
                                                        border-radius: 50%; font-size:25px;" class="text-danger">
                                                           <i class="fas fa-trash " title="Mover para Lixeira"></i>
                                                    </span>
                                                <p class="text-default text-center mt-2">Tem certeza que deseja mover esta sala para a
                                                    lixeira? </p>
                                                <form action="{{ route('deleteSala', $sala->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="card-footer">
                                                        <button type="submit"
                                                            class="btn btn-warning px-4
                                                            text-white">Sim</button>
                                                </form>
                                                <button type="button"
                                                    class="btn btn-danger
                                                            text-white px-4"
                                                    data-dismiss="modal">Não</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                </div>
                <div class="modal fade" id="modal-defaulteditsala{{ $sala->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Editar Sala</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="quickForm" action="{{ route('updateSala', $sala->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Sala</label>
                                            <input type="number" name="sala" required class="form-control"
                                                id="exampleInputEmail1" placeholder="Nome do Siculo" maxlength="30"
                                                minlength="5" value="{{ old('sala', $sala->sala) }}">
                                            @error('sala')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-edit"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            @empty
                <span class="text-danger">Nenhuma sala foi encontrado!</span>
                @endforelse
                <tfoot>
                    <tr>
                        <th>Codigo</th>
                        <th>Cíclo</th>
                        <th>----</th>
                        <th>----</th>
                        <th>----</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
                </table>
            </div>


            <!--TABELA DOS CURSOS-->
            <div id="curso" style="display: none">
                <table id="example4" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Curso</th>
                            <th>Sigla</th>
                            <th>----</th>
                            <th>----</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cursos as $curso)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $curso->nome }}</td>
                                <td>{{ $curso->sigla }}</td>
                                <th>----</th>
                                <th>----</th>
                                <td>

                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-defaulteditcurso{{ $curso->id }}"><i
                                            class="fas fa-edit"></i></button>

                                    <button class="btn btn-warning" data-toggle="modal"
                                        data-target="#modal-defaulteditcurso1{{ $curso->id }}"
                                        style="display: inline-block" title="Mover para Lixeira"><i
                                            class="fas fa-trash"></i></button>

                                </td>

                                <div class="modal fade" id="modal-defaulteditcurso1{{ $curso->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="text-md text-warning"> <b>AVISO!</b> </h4>
                                            </div>
                                            <div class="modal-body">
                                            <span style="background-color:#ccc; margin:auto;
                                                display :block; width:50px; height:50px; text-align:center;
                                                display:flex; align-items:center; justify-content:center;
                                                border-radius: 50%; font-size:25px;" class="text-danger">
                                                    <i class="fas fa-trash " title="Mover para Lixeira"></i>
                                            </span>
                                                <p class="text-default text-center mt-2">Tem certeza que deseja mover este curso para lixeira?</p>
                                                <form action="{{ route('deleteCurso', $curso->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit"
                                                    class="btn btn-warning
                                                        text-white px-4">Sim</button>
                                                </form>
                                                <button type="button"
                                                    class="btn btn-danger
                                                        text-white px-4"
                                                    data-dismiss="modal">Não</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="modal-defaulteditcurso{{ $curso->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Editar Curso</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="quickForm" action="{{ route('updateCurso', $curso->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Curso</label>
                                                            <input type="text" name="curso" required
                                                                class="form-control" id="exampleInputEmail1"
                                                                placeholder="Nome do Curso" maxlength="30" minlength="5"
                                                                value="{{ old('curso', $curso->nome) }}">
                                                            @error('curso')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Sígla</label>
                                                            <input type="text" name="sigla" required
                                                                class="form-control" id="exampleInputEmail1"
                                                                placeholder="Sígla do Siculo" maxlength="6"
                                                                minlength="2" value="{{ old('sigla', $curso->sigla) }}">
                                                            @error('sigla')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-success"><i
                                                                class="fas fa-edit"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Fechar</button>

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </tr>
                        @empty
                            <span class="text-danger">Nenhum Cíclo foi encontrado!</span>
                        @endforelse

                    <tfoot>
                        <tr>
                            <th>Codigo</th>
                            <th>Curso</th>
                            <th>----</th>
                            <th>----</th>
                            <th>----</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!--TABELA DAS CLASSES-->
            <div id="classes" style="display: none">
                <table id="example6" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Associação da Classe</th>
                            <th>Código</th>
                            <th>Classe</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($classes as $classe)
                            <tr>
                                @if (isset($classe->siculo->nome) and $classe->siculo->nome == 'Ensino Primário')
                                    <th>Cíclo</th>
                                    <td>Ensino Primário</td>
                                @endif
                                @if (isset($classe->siculo->nome) and $classe->siculo->nome == 'Primeiro Cíclo')
                                    <th>Cíclo</th>
                                    <td>Primeiro Cíclo</td>
                                @endif
                                @if (isset($classe->curso->nome))
                                    <th>Curso</th>
                                    <td>{{ $classe->curso->nome }}</td>
                                @endif
                                <td>{{ $classe->id }}</td>
                                <td>{{ $classe->nome }}</td>
                                <td>
                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-defaulteditclasse2{{ $classe->id }}"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-warning" data-toggle="modal"
                                        data-target="#modal-defaulteditclasse1{{ $classe->id }}"
                                        style="display: inline-block" title="Mover para Lixeira"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                                <div class="modal fade" id="modal-defaulteditclasse1{{ $classe->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="text-md text-warning mt-2"> <b>AVISO!</b> </h4>
                                            </div>
                                            <div class="modal-body">
                                            <span style="background-color:#ccc; margin:auto;
                                                        display :block; width:50px; height:50px; text-align:center;
                                                        display:flex; align-items:center; justify-content:center;
                                                        border-radius: 50%; font-size:25px;" class="text-danger">
                                                           <i class="fas fa-trash " title="Mover para Lixeira"></i>
                                                        </span>
                                                <p class="text-default text-center mt-2">Tem certeza que deseja mover este cíclo para a
                                                    lixeira?</p>
                                                <form action="{{ route('deleteClasse', $classe->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="card-footer">
                                                        <button type="submit"
                                                            class="btn btn-warning
                                                                text-white px-4">Sim</button>
                                                </form>
                                                <button type="button"
                                                    class="btn btn-danger
                                                                text-white px-4"
                                                    data-dismiss="modal">Não</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            </div>
            <div class="modal fade" id="modal-defaulteditclasse2{{ $classe->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Classe</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="quickForm" action="{{ route('updateClasse', $classe->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Classe</label>
                                        <select name="classe" id="" required class="form-control">
                                            <option value="">Selecione Uma Classe
                                            </option>
                                            <option value="">Ensino de Base</option>
                                            <option value="0" {{ $classe->nome == 'Iniciação' ? 'selected' : '' }}>
                                                Iniciação</option>
                                            <option value="1" {{ $classe->nome == '1-classe' ? 'selected' : '' }}>
                                                1-classe</option>
                                            <option value="2" {{ $classe->nome == '2-classe' ? 'selected' : '' }}>
                                                2-classe</option>
                                            <option value="3" {{ $classe->nome == '3-classe' ? 'selected' : '' }}>
                                                3-classe</option>
                                            <option value="4" {{ $classe->nome == '4-classe' ? 'selected' : '' }}>
                                                4-classe</option>
                                            <option value="5" {{ $classe->nome == '5-classe' ? 'selected' : '' }}>
                                                5-classe</option>
                                            <option value="6" {{ $classe->nome == '6-classe' ? 'selected' : '' }}>
                                                6-classe</option>
                                            <option value="">Ensino Primário</option>
                                            <option value="7" {{ $classe->nome == '7-classe' ? 'selected' : '' }}>
                                                7-classe</option>
                                            <option value="8" {{ $classe->nome == '8-classe' ? 'selected' : '' }}>
                                                8-classe</option>
                                            <option value="9" {{ $classe->nome == '9-classe' ? 'selected' : '' }}>
                                                9-classe</option>
                                            <option value="">Ensino Secundário
                                            </option>
                                            <option value="10" {{ $classe->nome == '10-classe' ? 'selected' : '' }}>
                                                10-classe</option>
                                            <option value="11" {{ $classe->nome == '11-classe' ? 'selected' : '' }}>
                                                11-classe</option>
                                            <option value="12" {{ $classe->nome == '12-classe' ? 'selected' : '' }}>
                                                12-classe</option>
                                            <option value="13" {{ $classe->nome == '13-classe' ? 'selected' : '' }}>
                                                13-classe</option>
                                        </select>
                                        @error('classe')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cíclo</label>
                                        <select name="siculo_id" id="" class="form-control">
                                            <option value="">Selecionar Cíclo
                                            </option>
                                            @forelse ($siculos as $siculo)
                                                <option value="{{ old('siculo_id', $siculo->id) }}"
                                                    {{ $siculo->id == $classe->siculo_id ? 'selected' : '' }}>
                                                    {{ $siculo->nome }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('siculo_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cursos</label>
                                        <select name="curso_id" id="" class="form-control">
                                            <option value="">Selecionar Curso
                                            </option>
                                            @forelse ($cursos as $curso)
                                                <option value="{{ old('curso_id', $curso->id) }}"
                                                    {{ $curso->id == $classe->curso_id ? 'selected' : '' }}>
                                                    {{ $curso->nome }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('curso_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            </tr>
        @empty
            <span class="text-danger">Nenhuma Clase foi encontrado!</span>
            @endforelse

            <tfoot>
                <tr>
                    <th colspan="2">Associação da Classe</th>
                    <th>Codigo</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
            </table>
    </div>
    </div>
    <!-- /.card-body -->
    </div>

    </div>

    <!--MODAL DOS SICULOS-->

    <div class="modal fade" id="modal-defaultciclus1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Cíclo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quickForm" action="{{ route('addSiculo') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cíclo</label>
                                <select name="ciclu" class="form-control" id="nome" required>
                                    <option value="">Selecione um Cíclo</option>
                                    <option value="Ensino Primário">Ensino Primário</option>
                                    <option value="Primeiro Cíclo">Primeiro Cíclo</option>
                                </select>

                                @error('ciclu')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL DAS CLASS-->
    <div class="modal fade" id="modal-defaultclasses5">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Classes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quickForm" action="{{ route('addClasse') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Classe</label>
                                <select name="classe" id="" required class="form-control">
                                    <option value="">Selecione Uma Classe</option>
                                    <option value="">Ensino de Primário</option>
                                    <option value="0">Iniciação</option>
                                    <option value="1">1-classe</option>
                                    <option value="2">2-classe</option>
                                    <option value="3">3-classe</option>
                                    <option value="4">4-classe</option>
                                    <option value="5">5-classe</option>
                                    <option value="6">6-classe</option>
                                    <option value="">Primeiro Cíclo</option>
                                    <option value="7">7-classe</option>
                                    <option value="8">8-classe</option>
                                    <option value="9">9-classe</option>
                                    <option value="">Ensino Secundário</option>
                                    <option value="10">10-classe</option>
                                    <option value="11">11-classe</option>
                                    <option value="12">12-classe</option>
                                    <option value="13">13-classe</option>
                                </select>
                                @error('classe')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cíclo</label>
                                <select name="siculo_id" id="" class="form-control">
                                    <option value="">Selecionar Cíclo</option>
                                    @forelse ($siculos as $siculo)
                                        <option value="{{ $siculo->id }}">{{ $siculo->nome }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('siculo_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Cursos</label>
                                <select name="curso_id" id="" class="form-control">
                                    <option value="">Selecionar Curso</option>
                                    @forelse ($cursos as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('curso_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--MODAL DOS CURSOS-->
    <div class="modal fade" id="modal-defaultcursos2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Cursos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quickForm" action="{{ route('addCurso') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Curso</label>
                                <input type="text" name="curso" required class="form-control"
                                    id="exampleInputEmail1" placeholder="Nome do Curso" maxlength="50" minlength="5"
                                    value="{{ old('curso') }}">
                                @error('curso')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sígla</label>
                                <input type="text" name="sigla" required class="form-control"
                                    id="exampleInputEmail1" placeholder="Sígla do Siculo" maxlength="6" minlength="2"
                                    value="{{ old('sigla') }}">
                                @error('sigla')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>

                </div>
                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        style="float: right">Fechar</button>

                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--MODAL DAS TURMAS-->

    <div class="modal fade" id="modal-defaultturmas3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Turmas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quickForm" action="{{ route('addTurma') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Turma</label>
                                <input type="text" name="turma" required class="form-control"
                                    id="exampleInputEmail1" placeholder="Turma" maxlength="30" minlength="2"
                                    value="{{ old('turma') }}">
                                @error('turma')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Período</label>
                                <select name="periodo" id="" class="form-control" required>
                                    <option value="">Selecionar Período</option>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                                @error('periodo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Classe</label>
                                <select name="clace_id" id="" class="form-control" required>
                                    <option value="">Selecionar Classes</option>
                                    @forelse ($classes as $siculo)
                                        @if (isset($siculo->curso_id))
                                            <option value="{{ $siculo->id }}">
                                                {{ $siculo->nome . '-' . $siculo->curso->nome }}</option>
                                        @else
                                            <option value="{{ $siculo->id }}">
                                                {{ $siculo->nome }}</option>
                                        @endif

                                    @empty
                                    @endforelse
                                </select>
                                @error('clace_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Sala</label>
                                <select name="sala_id" id="" class="form-control" required>
                                    <option value="">Selecionar Salas</option>
                                    @forelse ($salas as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->sala }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('sala_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--MODAL DAS SALAS-->

    <div class="modal fade" id="modal-defaultsalas4">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Salas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quickForm" action="{{ route('addSala') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sala</label>
                                <input type="number" name="sala" required class="form-control"
                                    id="exampleInputEmail1" placeholder="Sala" maxlength="30" minlength="5"
                                    value="{{ old('sala') }}">
                                @error('sala')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ./row -->
    </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
    </div>
@endsection
