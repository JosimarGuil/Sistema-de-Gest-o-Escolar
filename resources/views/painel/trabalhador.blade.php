@extends('tema.tema')

@section('title', 'Gestão dos Funcionários  do Canongue')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestão de funcionários Canongue</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Painel</a></li>
                            <li class="breadcrumb-item active">Funcionários</li>
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
                    <div class=" " style=" margin-bottom: 5px; ">
                        <div class="card">
                            <div class="bg-success" style="width:100%; margin: auto; padding: 10px; ">
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
                        <div class="bg-warning" style="width:100%; margin: auto;padding: 5px;">
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
                            Painel de Gestão de funcionários
                        </h3>
                    </div>
                    <div class="card-body">
                        @if (auth()->user()->perfil=='SEO' OR  auth()->user()->perfil=='Dir Geral' )
                        <div class="col-12">
                            <button type="button" class="btn btn-info toastrDefaultInfo " data-toggle="modal"
                                data-target="#modal-defaultciclus1" onclick="AddAlunos()" id="badd">
                                Abrir formulário de Cadastro de funcionário no sistema
                            </button>
                            <button type="button" class="btn btn-primary toastrDefaultWarning " data-toggle="modal"
                                data-target="#modal-defaultciclus1" onclick="Verlunos()" style="display: none"
                                id="bver">
                                Listar todos funcionários cadastrados no sistema
                            </button>
                        </div>  
                        @endif
                        
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!---ZONA DO FORMULARIO DE ADICAO DE FUNCIONARIO---->
            <section class="content" id="addalunos" style="display: none">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- jquery validation -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Cadastrar Funcionario</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="quickForm" method="post" action="{{ route('Addfuncionario') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nome Completo*</label>
                                            <input type="text" maxlength="50" minlength="5" name="nome"
                                                class="form-control" id="exampleInputEmail1" required
                                                placeholder="Nome Completo" value="{{old('nome')}}">
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
                                            <span>Selecione o genero</span>
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
                                            <label for="exampleInputPassword1">Endereço*</label>
                                            <input type="map" name="morada" required class="form-control"
                                                id="exampleInputPassword1" placeholder="Localidade" minlength="15"
                                                maxlength="35" value="{{ old('morada') }}">
                                            @error('morada')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email*</label>
                                            <input type="email" maxlength="50" required minlength="5" name="email"
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
                                            <label for="exampleInputPassword1">Cargo*</label>
                                            <select name="cargo" id="" required class="form-control">
                                                <option value="">Selecior uma Classe</option>
                                                <option value="SEO">SEO</option>
                                                <option value="Professor">Professor</option>
                                                <option value="Dir Geral">Dir Geral</option>
                                                <option value="Dir Administrativo">Dir Administrativo</option>
                                                <option value="Secretário Geral">Secretário Geral</option>
                                                <option value="Secretário Pedagógico">Secretário Pedagógico</option>
                                                <option value="Secretário Financeiro">Secretário Financeiro</option>
                                                <option value="Financeiro">Financeiro</option>
                                                <option value="Dr Pedagógico">Dr Pedagógico</option>
                                                <option value="Segurança">Segurança</option>
                                                <option value="Dir Geral">Dir Geral</option>
                                                <option value="Higiene/Limpeza">Higiene/Limpeza</option>
                                                <option value="Vigilante">Vigilante</option>
                                                @error('cargo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="exampleInputPassword1">Salário*</label>
                                            <input type="number" name="salario" class="form-control"
                                                id="exampleInputPassword1" value="{{ old('salario') }}"
                                                placeholder="Salário" required>
                                            @error('salario')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Foto Meio Corpo*</label>
                                            <input type="file" maxlength="255"  name="foto"
                                                class="form-control" id="exampleInputEmail1" required
                                                placeholder="Nome Completo">
                                            @error('foto')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <p class="text-default">Extenções: jpg, png ,jpeg, Tamanho: 1024KB</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Documentação Completa*</label>
                                            <input type="file" maxlength="255"  name="doc"
                                                class="form-control" id="exampleInputEmail1" required
                                                placeholder="Nome Completo">
                                               
                                            @error('doc')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <p class="text-default">Extenções: pdf, Tamanho: 2024KB</p>
                                        </div>
                                    </div>

                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Registrar Funcionario</button>
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
            <!--TABELA DE LISTAGEM DOS FUNCIONARIOS-->

            <div class="container-fluid" id="listalunos">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-header">
                              <p>
                                <i class="fas fa-trash" title="Ver Lixeira"> 0 </i> <span class="text-default">Tabela Funcionários do Canongue</span>
                              </p>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nome Completo</th>
                                            <th>Email</th>
                                            <th>Cargo</th>
                                            <th>Telefone</th>
                                            <th>Salário</th>
                                            <th>ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($funcionario as $item)
                                            <tr>
                                                <td>{{ $item->nome }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->cargo }}</td>
                                                <td>{{ $item->fone }}</td>
                                                <td>
                                                    {{ $item->salario }}
                                                </td>

                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#modal-lg{{ $item->id }}"><i
                                                            class="fas fa-eye"></i></button>

                                                    <button class="btn btn-success" data-toggle="modal"
                                                        data-target="#edit{{ $item->id }}"><i
                                                            class="fas fa-edit"></i></button>

                                                @if (auth()->user()->perfil=='SEO' OR  auth()->user()->perfil=='Dir Geral')

                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modal-defaultedialuno{{ $item->id }}"
                                                        style="display: inline-block"><i
                                                            class="fas fa-trash"
                                                            title="Mover para Lixeira"></i></button>
                                                    @if (!$item->promocao)
                                                        <button class="btn btn-info" data-toggle="modal"
                                                            data-target="#modal-defaultpromocao{{ $item->id }}"
                                                            style="display: inline-block">Promover</button>
                                                    @else
                                                        {{ 'Promovido' }}
                                                    @endif
                                                 @endif
                                                </td>
                                            </tr>

                                            <!-- MODAL VER DETALHES DO ALUNO -->
                                            <div class="modal fade" id="modal-lg{{ $item->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Detalhes do funcionário</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="card">

                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-md-12">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="post">
                                                                                        <div class="user-block">
                                                                                            <img class="img-circle img-bordered-sm"
                                                                                                src="../storage/{{ $item->foto ?? '' }}"
                                                                                                target="_blank"
                                                                                                alt="user image"
                                                                                                style="width: 150px; height: 150px; border-color:rgb(0, 174, 255);
                                                                                                       border-radius: 5px">
                                                                                   <img class=" "
                                                                                   src="kanongue.png"
                                                                                   target="_blank"
                                                                                   alt="user image"
                                                                                   style="width: 100px; height: 100px; float: right">
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <hr>
                                                                                            <div class="col-md-6">
                                                                                                <p>
                                                                                                <h3
                                                                                                    class="profile-username text-info">
                                                                                                    {{ $item->nome ?? '' }}
                                                                                                </h3>
                                                                                                </p>
                                                                                                <p><i
                                                                                                        class="fas fa-user text-info">
                                                                                                        Genero: </i>
                                                                                                    {{ $item->sexo ?? '' }}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <br>
                                                                                                <p><i
                                                                                                        class="fas fa-envelope text-info">
                                                                                                        Email: </i>
                                                                                                    {{ $item->email ?? '' }}
                                                                                                </p>
                                                                                                <p><i
                                                                                                        class="fas fa-map-marker-alt mr-1 text-info">
                                                                                                        Morada: </i>
                                                                                                    {{ $item->morada ?? '' }}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <p><i
                                                                                                        class="fas fa-phone text-info">
                                                                                                        Telefone: </i>
                                                                                                    {{ $item->fone ?? '' }}
                                                                                                </p>
                                                                                                @if ($item->whatsapp)
                                                                                                    <p><i
                                                                                                            class="nav-icon far fa-circle text-info">
                                                                                                            Whatsapp: </i>
                                                                                                        {{ $item->whatsapp ?? '' }}
                                                                                                    </p>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <p><i
                                                                                                        class="nav-icon far fa-circle text-info">
                                                                                                        Cargo: </i>
                                                                                                    {{ $item->cargo ?? '' }}
                                                                                                </p>
                                                                                                <p><i
                                                                                                        class="nav-icon far fa-circle text-info ">
                                                                                                        Salário: </i>
                                                                                                    {{ $item->salario ?? '' }}Kz
                                                                                                </p>
                                                                                            </div><br><br>
                                                                                            <div class="col-md-12">
                                                                                                <br>
                                                                                                <a href="../storage/{{ $item->documentos ?? '' }}"
                                                                                                    target="_blank"
                                                                                                    class="btn btn-info">
                                                                                                    Ver documentação
                                                                                                    completa do
                                                                                                    Funcionário</a>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer justify-content-between"
                                                            style="border-color: transparent">
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal-dialog -->

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
                                                            <p class="text-default">Tem certeza que deseja mover este funcionário para a lixeira? </p>
                                                            <form action="{{ route('Deletefuncionario', $item->id) }}"
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
                                            <!--MODAL DE PROMOÇÃO DE FUNCIONÁRIO-->
                                            <div class="modal fade" id="modal-defaultpromocao{{ $item->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title text-info">Promover
                                                                funcionáio:{{ $item->nome }}</h6>

                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @error('fone')
                                                                <span class="text-danger">{{ $message }}</span><br>
                                                            @enderror
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span><br>
                                                            @enderror
                                                                                                          
                                                                 @error('data')
                                                                      <span class="text-danger">{{ $message }}</span><br>
                                                                 @enderror

                                                                 @error('foto')
                                                              <span class="text-danger">{{ $message }}</span><br>
                                                                 @enderror  

                                                                 @error('doc')
                                                              <span class="text-danger">{{ $message }}</span><br>
                                                                 @enderror  
                                                                 <form action="{{ route('Promover') }}" method="post">
                                                                @csrf

                                                                <input type="hidden" name="nome" id
                                                                    value="{{ $item->nome ?? '' }}">
                                                                <input type="hidden" name="email" id
                                                                    value="{{ $item->email ?? '' }}">
                                                                <input type="hidden" name="sexo" id
                                                                    value="{{ $item->sexo ?? '' }}">
                                                            
                                                                <input type="hidden" name="morada" id
                                                                    value="{{ $item->morada ?? '' }}">
                                                                <input type="hidden" name="data" id
                                                                    value="{{ $item->data ?? '' }}">
                                                                <input type="hidden" name="foto" id
                                                                    value="{{ $item->foto ?? '' }}">
                                                                <input type="hidden" name="doc" id
                                                                    value="{{ $item->documentos ?? '' }}">
                                                                <input type="hidden" name="promo"
                                                                    value="{{ $item->id }}">
                                                                    <input type="hidden" name="fone"
                                                                    value="{{$item->fone}}">
                                                                <div class="form-group ">
                                                                 
                                                                    <label for="exampleInputPassword1">Cargo*ggggfgf</label>
                                                                    <select name="perfil" id="" required
                                                                        class="form-control">
                                                                        <option value="">Selecior um Cargo</option>
                                                                        <option value="SEO"
                                                                            {{ $item->cargo == 'SEO' ? 'selected' : '' }}>SEO
                                                                        </option>
                                                                        <option value="Professor"
                                                                            {{ $item->cargo == 'Professor' ? 'selected' : '' }}>
                                                                            Professor</option>
                                                                        <option value="Dir Geral"
                                                                            {{ $item->cargo == 'Dir Geral' ? 'selected' : '' }}>
                                                                            Dir Geral</option>
                                                                        <option value="Dir Administrativo"
                                                                            {{ $item->cargo == 'Dir Administrativo' ? 'selected' : '' }}>
                                                                            Dir Administrativo</option>
                                                                        <option value="Secretário Geral"
                                                                            {{ $item->cargo == 'Secretário Geral' ? 'selected' : '' }}>
                                                                            Secretário Geral</option>
                                                                        <option value="Secretário Pedagógico"
                                                                            {{ $item->cargo == 'Secretário Pedagógico' ? 'selected' : '' }}>
                                                                            Secretário Pedagógico</option>
                                                                        <option value="Secretário Financeiro"
                                                                            {{ $item->cargo == 'Secretário Financeiro' ? 'selected' : '' }}>
                                                                            Secretário Financeiro</option>
                                                                        <option value="Financeiro"
                                                                            {{ $item->cargo == 'Financeiro' ? 'selected' : '' }}>
                                                                            Financeiro</option>
                                                                        <option value="Dr Pedagógico"
                                                                            {{ $item->cargo == 'Dr Pedagógico' ? 'selected' : '' }}>
                                                                            Dr Pedagógico</option>
                                                                        <option value="Segurança"
                                                                            {{ $item->cargo == 'Segurança' ? 'selected' : '' }}>
                                                                            Segurança</option>
                                                                        <option value="Dir Geral"
                                                                            {{ $item->cargo == 'Dir Geral' ? 'selected' : '' }}>
                                                                            Dir Geral</option>
                                                                        <option value="Higiene/Limpeza"
                                                                            {{ $item->cargo == 'Higiene/Limpeza' ? 'selected' : '' }}>
                                                                            Higiene/Limpeza</option>
                                                                        <option value="Vigilante"
                                                                            {{ $item->cargo == 'Vigilante' ? 'selected' : '' }}>
                                                                            Vigilante</option>
                                                                        @error('perfil')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Senha </label>
                                                                    <input type="password" maxlength="15" minlength="8"
                                                                        name="password" class="form-control"
                                                                        id="exampleInputEmail1" required
                                                                        placeholder=""
                                                                        value="{{ old('password') }}">
                                                                    @error('password')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Confirmar Senha
                                                                    </label>
                                                                    <input type="password" maxlength="15" minlength="8"
                                                                        name="confirm" class="form-control"
                                                                        id="exampleInputEmail1" required
                                                                        placeholder="Nome Completo"
                                                                        value="{{ old('confirm') }}">
                                                                    @error('confirm')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>


                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="submit" class="btn btn-info">Promover</button>
                                                            </form>
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Não</button>

                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>


                                            <!--ZONA DE EDICAO DE USUARIO--->
                                            <div class="modal fade" id="edit{{ $item->id }}">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h6 class="modal-title text-primary">Editando Funcionário:
                                                                {{ $item->nome }}</h6>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form id="quickForm" method="post"
                                                                action="{{ route('Editfuncionario', $item->id) }}"
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
                                                                            value="{{old('data', $item->data)}}"
                                                                            placeholder="Data de Nascimento">
                                                                        @error('data')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label
                                                                            for="exampleInputPassword1">Endereço*</label>
                                                                        <input type="map" name="morada" required
                                                                            class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            placeholder="Localidade" minlength="15"
                                                                            maxlength="35"
                                                                            value="{{ old('morada', $item->morada) }}">
                                                                        @error('morada')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Email*</label>
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
                                                                            placeholder="Telefone" minlength="9" maxlength="9">
                                                                        @error('fone')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                              
                                                                    <div class="form-group ">
                                                                        <label for="exampleInputPassword1">Cargo*</label>
                                                                        <select name="cargo" id="" required
                                                                            class="form-control">
                                                                            <option value="">Selecinar um Cargo
                                                                            </option>
                                                                            <option value="SEO"
                                                                                {{ $item->cargo == 'SEO' ? 'selected' : '' }}>
                                                                                SEO</option>
                                                                            <option value="Professor"
                                                                                {{ $item->cargo == 'Professor' ? 'selected' : '' }}>
                                                                                Professor</option>
                                                                            <option value="Dir Geral"
                                                                                {{ $item->cargo == 'Dir Geral' ? 'selected' : '' }}>
                                                                                Dir Geral</option>
                                                                            <option value="Dir Administrativo"
                                                                                {{ $item->cargo == 'Dir Administrativo' ? 'selected' : '' }}>
                                                                                Dir Administrativo</option>
                                                                            <option value="Secretário Geral"
                                                                                {{ $item->cargo == 'Secretário Geral' ? 'selected' : '' }}>
                                                                                Secretário Geral</option>
                                                                            <option value="Secretário Pedagógico"
                                                                                {{ $item->cargo == 'Secretário Pedagógico' ? 'selected' : '' }}>
                                                                                Secretário Pedagógico</option>
                                                                            <option value="Secretário Financeiro"
                                                                                {{ $item->cargo == 'Secretário Financeiro' ? 'selected' : '' }}>
                                                                                Secretário Financeiro</option>
                                                                            <option value="Financeiro"
                                                                                {{ $item->cargo == 'Financeiro' ? 'selected' : '' }}>
                                                                                Financeiro</option>
                                                                            <option value="Dr Pedagógico"
                                                                                {{ $item->cargo == 'Dr Pedagógico' ? 'selected' : '' }}>
                                                                                Dr Pedagógico</option>
                                                                            <option value="Segurança"
                                                                                {{ $item->cargo == 'Segurança' ? 'selected' : '' }}>
                                                                                Segurança</option>
                                                                            <option value="Dir Geral"
                                                                                {{ $item->cargo == 'Dir Geral' ? 'selected' : '' }}>
                                                                                Dir Geral</option>
                                                                            <option value="Higiene/Limpeza"
                                                                                {{ $item->cargo == 'Higiene/Limpeza' ? 'selected' : '' }}>
                                                                                Higiene/Limpeza</option>
                                                                            <option value="Vigilante"
                                                                                {{ $item->cargo == 'Vigilante' ? 'selected' : '' }}>
                                                                                Vigilante</option>
                                                                            @error('cargo')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label for="exampleInputPassword1">Salário*</label>
                                                                        <input type="number" name="salario"
                                                                            class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            value="{{ old('salario', $item->salario) }}"
                                                                            placeholder="Salário" required>
                                                                        @error('salario')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Foto Meio
                                                                            Corpo*</label>
                                                                        <input type="file" maxlength="255"
                                                                             name="foto"
                                                                            value="storage/{{$item->foto}}"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            placeholder="Nome Completo">
                                                                        @error('foto')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                        <p class="text-default">Extenções: jpg, png ,jpeg, Tamanho: 1024KB</p>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Documentação
                                                                            Completa*</label>
                                                                        <input type="file" maxlength="255"
                                                                             name="doc"
                                                                            value="storage/{{ $item->doc }}"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            placeholder="Nome Completo">
                                                                        @error('doc')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                        <p class="text-default">Extenções:pdf, Tamanho: 2024KB</p>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-success">Editar</button>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                          
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Fechar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        @empty
                                            <span class="text-danger">Nenhum funciorario foi cadastrado!</span>
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
