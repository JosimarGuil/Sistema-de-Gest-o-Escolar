@extends('tema.tema')

@section('title', 'Gestão dos alunos do Canongue')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Getão dos alunos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Painel</a></li>
                            <li class="breadcrumb-item active">Alunos</li>
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
                            <div class="bg-warning" style="width:100%; margin: auto;padding: 10px; ">
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
                    <div class="" style=" margin-bottom: 10px;">
                        <div class="bg-danger" style="width:100%; margin: auto;padding: 10px;">
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
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Painel de gestão do aluno
                        </h3>
                    </div>
                    <div class="card-body">
                        @if(auth()->user()->perfil=='Secretário Geral' or
                        auth()->user()->perfil=='Secretário Pedagógico' or
                        auth()->user()->perfil=='Dr Pedagógico')
                        <div class="col-12">

                            <button type="button" class="btn btn-info toastrDefaultInfo " data-toggle="modal"
                                data-target="#modal-defaultciclus1" onclick="AddAlunos()" id="badd">
                                Abrir formulário de Cadastro de alunos no sistema
                            </button>

                            <button type="button" class="btn btn-primary toastrDefaultWarning " data-toggle="modal"
                                data-target="#modal-defaultciclus1" onclick="Verlunos()" style="display: none"
                                id="bver">
                                Listar todos alunos cadastrados no sistema
                            </button>

                        </div>  
                        @endif
                        


                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!---ZONA DO FORMULARIO DE ADICAO DE ALUNOS---->
            <section class="content" id="addalunos" style="display: none">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Cadastrar Alunos</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="quickForm" method="post" action="{{ route('Addalunos') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nome Completo*</label>
                                            <input type="text" maxlength="50" minlength="5" name="nome"
                                                class="form-control" id="exampleInputEmail1" required
                                                placeholder="Nome Completo" value="{{ old('nome') }}">
                                            @error('nome')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Sexo*</label><br>
                                            <label for="exampleInputEmail1">Masculino</label>
                                            <input type="radio" name="sexo" id="" value="Masculino">
                                            <label for="exampleInputEmail1">Femenino</label>
                                            <input type="radio" name="sexo" id="" value=" Femenino">
                                            <span>Selecione o sexo do aluno</span>
                                            @error('sexo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group ">
                                            <label for="exampleInputPassword1">Data de Nascimento*</label>
                                            <input type="date" name="data" required class="form-control"
                                                id="exampleInputPassword1" value="{{ old('data') }}"
                                                placeholder="Data de Nascimento">
                                            @error('data')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group ">
                                            <label for="exampleInputPassword1">Localidade*</label>
                                            <input type="map" name="localiza" required class="form-control"
                                                id="exampleInputPassword1" placeholder="Localidade" minlength="15"
                                                maxlength="35" value="{{ old('localiza') }}">
                                            @error('localiza')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email"  name="email"
                                                class="form-control" id="exampleInputEmail1" value="{{ old('email') }}"
                                                placeholder="E-mail">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group ">
                                            <label for="exampleInputPassword1">Telefone*</label>
                                            <input type="tel" name="fone" required class="form-control"
                                                id="exampleInputPassword1" value="{{ old('fone') }}"
                                                placeholder="Telefone" minlength="9" maxlength="9">
                                            @error('fone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group ">
                                            <label for="exampleInputPassword1">Classe*</label>
                                            <select name="classe_id" id="" required class="form-control">
                                                <option value="" selected="selected" data-select2-id="11">Selecionar
                                                    uma Classe</option>
                                                @forelse ($classes as $siculo)
                                                    @if (isset($siculo->curso_id) and $siculo->curso_id != '')
                                                        <option value="{{ $siculo->id }}" data-select2-id="33">
                                                            {{ $siculo->nome . '-' . $siculo->curso->nome }}</option>
                                                    @else
                                                        <option value="{{ $siculo->id }}">
                                                            {{ $siculo->nome }}</option>
                                                    @endif
                                                @empty
                                                @endforelse
                                                @error('classe_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="exampleInputPassword1">Turma*</label>
                                            <select name="turma_id" id="" required class="form-control">

                                                <option value="">Selecionar uma Turma</option>
                                                @forelse ($turmas as $turma)
                                                    <option value="{{ $turma->id }}">
                                                        {{ $turma->clace->curso_id > 0
                                                            ? $turma->nome . '  ' . $turma->clace->nome . '-' . $turma->clace->curso->nome
                                                            : $turma->nome . '  ' . $turma->clace->nome }}
                                                    </option>
                                                @empty
                                                @endforelse
                                                @error('turma_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Foto Meio Corpo*</label>
                                            <input type="file" maxlength="255"  name="img"
                                                class="form-control" id="exampleInputEmail1" required
                                                placeholder="Nome Completo">
                                            @error('img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Documentação Completa*</label>
                                            <input type="file" maxlength="255"  name="doc"
                                                class="form-control" id="exampleInputEmail1" required
                                                placeholder="Nome Completo">
                                            @error('doc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Registrar Aluno</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">

                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>



            <!--TABELA DE LISTAGEM DOS ALUNOS-->

            <div class="container-fluid" id="listalunos">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-header">

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Numero</th>
                                            <th>Nome Completo</th>
                                            <th>Classe</th>
                                            <th>Sala</th>
                                            <th>Turma</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($alunos as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->nome }}</td>
                                                <td>{{ $item->clace->nome }}</td>
                                                <td>{{ $item->sala->sala }}</td>
                                                <td>
                                                    {{ $item->curso_id > 0
                                                        ? $item->turma->nome . '  ' . $item->turma->clace->nome . '-' . $item->turma->clace->curso->nome
                                                        : $item->turma->nome . '  ' . $item->turma->clace->nome . '-' . $item->turma->clace->siculo->nome }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#modal-lgDetalhes{{ $item->id }}"><i
                                                            class="fas fa-eye"></i></button>
                                                 @if (auth()->user()->perfil=='Secretário Geral' or
                                                 auth()->user()->perfil=='Secretário Pedagógico' or
                                                 auth()->user()->perfil=='Dr Pedagógico')
                                                     
                                                     <button class="btn btn-success" data-toggle="modal"
                                                        data-target="#modal-xl{{ $item->id }}"><i
                                                            class="fas fa-edit"></i></button>

                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modal-defaultedialuno{{ $item->id }}"
                                                        style="display: inline-block"><i
                                                            class="fas fa-trash"></i></button>
                                                 @endif
                                                    
                                                </td>
                                                </td>
                                            </tr>
                                            </tr>
                                            <!-- MODAL VER DETALHES DO ALUNO -->

                                            <div class="modal fade" id="modal-lgDetalhes{{ $item->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Detalhes do aluno</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-12">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="post">
                                                                                    <div class="user-block">
                                                                                        <a
                                                                                            href="../storage/{{ $item->img ?? '' }}">
                                                                                            <img class=" img-bordered-sm"
                                                                                                target="_blank"
                                                                                                src="../storage/{{ $item->img ?? '' }}"
                                                                                                alt="user image"
                                                                                                style="width: 150px; height: 150px; border-color:rgb(0, 174, 255);
                                                                             border-radius: 5px">
                                                                             <img class=" "
                                                                             src="kanongue.png"
                                                                             target="_blank"
                                                                             alt="user image"
                                                                             style="width: 100px; height: 100px; float: right">
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <p>
                                                                                            <h3
                                                                                                class="profile-username text-info ">
                                                                                                {{ $item->nome ?? '' }}</h3>
                                                                                            </p>
                                                                                            <p><i
                                                                                                    class="fas fa-user text-info">
                                                                                                    Gênero: </i>
                                                                                                {{ $item->sexo ?? '' }}</p>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <br>
                                                                                            <p><i
                                                                                                    class="fas fa-envelope text-info ">
                                                                                                    E-mail: </i>
                                                                                                {{ $item->email ?? '' }}</p>
                                                                                            <p><i
                                                                                                    class="fas fa-map-marker-alt mr-1 text-info">
                                                                                                    Morada: </i>
                                                                                                {{ $item->localiza ?? '' }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <p><i
                                                                                                    class="fas fa-phone text-info">
                                                                                                    Telefone: </i>
                                                                                                {{ $item->fone ?? '' }}</p>
                                                                                            @if ($item->whatsapp)
                                                                                                <p><i
                                                                                                        class="fas fa-phone text-info">
                                                                                                        Whatsapp: </i>
                                                                                                    {{ $item->whatsapp ?? '' }}
                                                                                                </p>
                                                                                            @endif
                                                                                            <p><i
                                                                                                    class="far fa-circle text-info">
                                                                                                    Código da Classe: </i>
                                                                                                {{ $item->clace->id ?? '' }}
                                                                                            </p>
                                                                                        </div>

                                                                                        <div class="col-md-6">
                                                                                            <p><i
                                                                                                    class="nav-icon far fa-circle text-info">
                                                                                                    Curso / Cíclo: </i>
                                                                                                {{ $item->siculo->nome ?? $item->curso->nome }}
                                                                                            </p>
                                                                                            <p><i
                                                                                                    class="nav-icon far fa-circle text-info">
                                                                                                    Código da Turma: </i>
                                                                                                {{ $item->turma->id ?? '' }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <br><br><br>
                                                                                        <div class="col-md-12">
                                                                                            <br>
                                                                                            <a href="../storage/{{ $item->doc ?? '' }}"
                                                                                                target="_blank"
                                                                                                class="btn btn-info"> Ver
                                                                                                documentação completa do
                                                                                                aluno</a>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">fechar</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                        </div>
                                            <!-- /.modal -->
                                            <div class="modal fade" id="modal-defaultedialuno{{ $item->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-warning"> <b>AVISO!</b> </h4>

                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-default">Tem certeza que deseja mover este este para a lixeira? </p>
                                                            <form action="{{ route('Deletelunos', $item->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-warning
                                                                text-white">Sim</button>
                                                                </form>
                                                                <button type="button" class="btn btn-danger
                                                                text-white"
                                                                    data-dismiss="modal">Não</button>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <h4 class="modal-title text-warning"> <b>AVISO!</b> </h4>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!--ZONA DE EDICAO DE USUARIO--->
                                            <div class="modal fade" id="modal-xl{{ $item->id }}">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title text-primary">Editando o Aluno:
                                                                {{ $item->nome }}</h6>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form id="quickForm" method="post"
                                                                action="{{ route('Editalunos', $item->id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nome
                                                                            Completo*</label>
                                                                        <input type="text" maxlength="50"
                                                                            min="5" name="nome"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            required placeholder="Nome Completo"
                                                                            value="{{ old('nome', $item->nome) }}">
                                                                        @error('nome')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Sexo*</label><br>
                                                                        <label for="exampleInputEmail1">Masculino</label>
                                                                        <input type="radio" name="sexo"
                                                                            id="" value="Masculino"
                                                                            {{ $item->sexo == 'Masculino' ? 'checked' : '' }}>
                                                                        <label for="exampleInputEmail1">Femenino</label>
                                                                        <input type="radio" name="sexo"
                                                                            id="" value=" Femenino"
                                                                            {{ $item->sexo == 'Femenino' ? 'checked' : '' }}>
                                                                        <span>Selecione o sexo do aluno</span>
                                                                        @error('sexo')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label for="exampleInputPassword1">Data de
                                                                            Nascimento*</label>
                                                                        <input type="date" name="data" required
                                                                            class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            value="{{ old('data', $item->data) }}"
                                                                            placeholder="Data de Nascimento">
                                                                        @error('data')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label
                                                                            for="exampleInputPassword1">Localidade*</label>
                                                                        <input type="map" name="localiza" required
                                                                            class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            placeholder="Localidade" minlength="15"
                                                                            maxlength="35"
                                                                            value="{{ old('localiza', $item->localiza) }}">
                                                                        @error('localiza')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Email</label>
                                                                        <input type="email" maxlength="50"
                                                                            minlength="5" name="email"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            value="{{ old('email', $item->email) }}"
                                                                            placeholder="E-mail">
                                                                        @error('email')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label
                                                                            for="exampleInputPassword1">Telefone*</label>
                                                                        <input type="tel" name="fone" required
                                                                            class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            value="{{ old('fone', $item->fone) }}"
                                                                            placeholder="Telefone" min="9"
                                                                            max="9">
                                                                        @error('fone')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group ">
                                                                        <label for="exampleInputPassword1">Classe*</label>
                                                                        <select name="classe_id" id="" required
                                                                            class="form-control">
                                                                            <option value="">Selecior uma Classe
                                                                            </option>
                                                                            @forelse ($classes as $siculo)
                                                                                @if (isset($siculo->curso_id) and $siculo->curso_id != '')
                                                                                    <option value="{{ $siculo->id }}"
                                                                                        {{ $siculo->nome == $item->clace->nome ? 'selected' : '' }}>
                                                                                        {{ $siculo->nome . '-' . $siculo->curso->nome }}
                                                                                    </option>
                                                                                @else
                                                                                    <option value="{{ $siculo->id }}"
                                                                                        {{ $siculo->nome == $item->clace->nome ? 'selected' : '' }}>
                                                                                        {{ $siculo->nome . '-' . $siculo->siculo->nome }}
                                                                                    </option>
                                                                                @endif
                                                                            @empty
                                                                            @endforelse
                                                                            @error('classe_id')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group ">
                                                                        <label for="exampleInputPassword1">Turma*</label>
                                                                        <select name="turma_id" id="" required
                                                                            class="form-control">

                                                                            <option value="">Selecionar uma Turma
                                                                            </option>
                                                                            @forelse ($turmas as $turma)
                                                                                <option value="{{ $turma->id }}"
                                                                                    {{ $turma->nome == $item->turma->nome ? 'selected' : '' }}>
                                                                                    {{ $turma->clace->curso_id > 0
                                                                                        ? $turma->nome . '  ' . $turma->clace->nome . '-' . $turma->clace->curso->nome
                                                                                        : $turma->nome . '  ' . $turma->clace->nome . '-' . $turma->clace->siculo->nome }}
                                                                                </option>
                                                                            @empty
                                                                            @endforelse
                                                                            @error('turma_id')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Foto Meio
                                                                            Corpo*</label>
                                                                        <input type="file" maxlength="50"
                                                                            min="5" name="img"
                                                                            value="storage/{{ $item->img }}"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            placeholder="Nome Completo">
                                                                        @error('img')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Documentação
                                                                            Completa*</label>
                                                                        <input type="file" maxlength="50"
                                                                            min="5" name="doc"
                                                                            value="storage/{{ $item->doc }}"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            placeholder="Nome Completo">
                                                                        @error('doc')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Fechar</button>
                                                            <button type="submit" class="btn btn-success">Editar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        @empty
                                            <span class="text-danger">Nenhum aluno foi cadastrado!</span>
                                        @endforelse

                                    </tbody>
                                    
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
