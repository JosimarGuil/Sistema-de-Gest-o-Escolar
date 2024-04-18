@extends('tema.tema')

@section('title', 'Controle de Pagamentos')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            Gerenciamento de Contas
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Painel</a></li>
                            <li class="breadcrumb-item active">Gerenciamento de Contas</li>
                        </ol>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalEntradas }} <sup style="font-size: 25px; "><small
                                            class="text-warning">Kz</small></sup></h3>

                                <p>Entradas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalSaidas }}<sup style="font-size: 25px; "> <small
                                            class="text-warning">Kz</small></sup></h3>

                                <p>Saídas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3 class="text-white">{{ $totalMes }} <sup style="font-size: 25px; "><small
                                            class="text-warning">Kz</small></sup></h3>

                                <p class="text-white">Total durante ao Mês</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3 class="text-white">{{ $total - $sub }} <sup style="font-size: 25px; "><small
                                            class="text-warning">Kz</small></sup></h3>

                                <p class="text-white">Total</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                </div>
                <!-- /.row -->

            </div>
        </section>

        <!-- Mensagens de retorno -->
        <section class="content-header">
            <div class="container-fluid">
                @if (session('sms1'))
                    <div class="" style=" margin-bottom: 10px;">
                        <div class="card">
                            <div class="bg-primary" style="width:100%; margin: auto;
 padding: 10px; ">
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
                    <div class=" " style=" margin-bottom: 10px; ">
                        <div class="card">
                            <div class="bg-danger" style="width:100%; margin: auto;
padding: 10px; ">
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
                    <div class=" " style=" margin-bottom: 10px; border-radius: 5px ">
                        <div class="card">
                            <div class="bg-success" style="width:100%; margin: auto;
           padding: 10px; ">
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
                        <div class="bg-warning" style="width:100%; margin: auto; padding: 10px;">
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

        <section class="content" style="margin-top: 20px">
            <div class="container-fluid">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Painel de Configuração
                        </h3>
                    </div>
                    <div class="card-body  justify-content-around">
                        @if (auth()->user()->perfil == 'SEO' or
                                auth()->user()->perfil == 'Dir Administrativo' or
                                auth()->user()->perfil == 'Dir Geral')
                            <button type="button" class="btn btn-success toastrDefaultSuccess " data-toggle="modal"
                                data-target="#modal-defaultciclus1">
                                Adicionar Tipos de pagamento
                            </button>
                        @endif
                        @if (auth()->user()->perfil == 'Secretário Financeiro' or auth()->user()->perfil == 'Financeiro')
                            <button type="button" class="btn btn-info  toastrDefaultInfo" data-toggle="modal"
                                data-target="#modal-entradas">
                                Adicionar Entrada
                            </button>

                            <button type="button" class="btn btn-primary  toastrDefaultInfo" data-toggle="modal"
                                data-target="#modal-addsaida1">
                                Adicionar Saídas
                            </button>
                        @endif



                        <div class="text-muted mt-3">

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
                            Tipos de Busca</h3><br>
                        <hr>


                        <button id="btipo" type="button" class="btn btn-default toastrDefaultError"
                            onclick="verTposPagamentos(this)" style="color: white;background-color:#007bff ">
                            Ver toda Tipos de Pagamentos
                        </button>

                        <button id="bnentrada" type="button" class="btn btn-default toastrDefaultError"
                            onclick="verEntradas(this)">
                            Ver todas entradas
                        </button>
                        <button id="bsaida" type="button" class="btn btn-default toastrDefaultError"
                            onclick="verSaidas(this)">
                            Ver todas saídas
                        </button>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!--TABELA DOS TIPOS-->
                        <div id="tipo" style="display: block">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Classe</th>
                                        <th>Preço</th>
                                        <th>----</th>
                                        <th>----</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tipos as $tipo)
                                        <tr>
                                            <td>{{ $tipo->tipo }}</td>
                                            <td>{{ isset($tipo->clace->curso_id) ? $tipo->clace->nome . '-' . $tipo->clace->curso->nome : $tipo->clace->nome }}
                                            </td>
                                            <td>{{ $tipo->preco }}</td>
                                            <td>----</td>
                                            <td>----</td>
                                            <td>
                                                @if (auth()->user()->perfil == 'SEO' or
                                                        auth()->user()->perfil == 'Dir Administrativo' or
                                                        auth()->user()->perfil == 'Dir Geral')
                                                    <button class="btn btn-success" data-toggle="modal"
                                                        data-target="#modal-defaultedittipo{{ $tipo->id }}"><i
                                                            class="fas fa-edit"></i></button>
                                                @endif

                                            </td>

                                        </tr>
                                        <div class="modal fade" id="modal-defaultdeletetipo{{ $tipo->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">AVISO!</h4>

                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span class="text-danger">Tem certeza que deseja Excluir este
                                                            tipo de pagamento
                                                            <strong> </strong> ?</span>
                                                        <form action="{{ route('deleteTipoPagamentos', $tipo->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="submit" class="btn btn-danger">Sim</button>
                                                        </form>
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Não</button>

                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <div class="modal fade" id="modal-defaultedittipo{{ $tipo->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Editar Tipo de Pagamento</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="quickForm"
                                                            action="{{ route('editTipoPagamentos', $tipo->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Tipo de
                                                                        pagamento</label>
                                                                    <input type="text" name="tipo"
                                                                        class="form-control" required
                                                                        value="{{ old('tipo', $tipo->tipo) }}">
                                                                    @error('tipo')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Preço</label>
                                                                    <input type="number" name="preco"
                                                                        class="form-control" required
                                                                        value="{{ old('preco', $tipo->preco) }}">
                                                                    @error('preco')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Classe</label>
                                                                    <select name="clace_id" id=""
                                                                        class="form-control" required>
                                                                        <option value="">Selecionar classe</option>
                                                                        @forelse ($classes as $siculo)
                                                                            @if (isset($siculo->curso_id))
                                                                                <option value="{{ $siculo->id }}"
                                                                                    {{ $siculo->nome == $tipo->clace->nome ? 'selected' : '' }}>
                                                                                    {{ $siculo->nome . '-' . $siculo->curso->nome }}
                                                                                </option>
                                                                            @else
                                                                                <option value="{{ $siculo->id }}"
                                                                                    {{ $siculo->nome == $tipo->clace->nome ? 'selected' : '' }}>
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

                                                            </div>
                                                            <!-- /.card-body -->
                                                            <div class="card-footer">

                                                            </div>

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="submit" class="btn btn-success">Editar</button>
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
                                        <span class="text-danger">Nehum foi encontrado</span>
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

                        <!--TABELA DAS ENTRADAS DE PAGAMENTO-->
                        <div id="entradas" style="display: none">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="3">Aluno / Outro</th>
                                        <th colspan="1">Tipo</th>
                                        <th>Meses/Qnt</th>
                                        <th>Data/H</th>
                                        <th>Valor</th>
                                        <th>Ações</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @forelse ($pamentosEntradas as $item)
                                        <tr>
                                            @if($item->aluno_id != null)
                                            <th>Turma/C</th>
                                            <td>{{ $item->aluno->turma->nome }} - {{ $item->aluno->clace->nome }}</td>
                                            <td>{{ $item->aluno->nome }}</td>
                                            @else
                                              <td colspan="3">{{$item->outro}}</td>
                                            @endif
                                            
                                            <td>{{( $item->tipo_pagamento->tipo)?? 'Outra entrada'}}</td>
                                            <td>
                                                @if (isset($item->tipo_pagamento_id) and ($item->tipo_pagamento->tipo == 'Propina' or $item->tipo_pagamento->tipo == 'propina'))
                                                    <p>
                                                        @forelse ($item->meses as $mes)
                                                            {{ $mes->nome }}
                                                        @empty
                                                        @endforelse
                                                    </p>
                                                @else
                                                    <p>
                                                        <b>Quantidade: </b>
                                                        {{ $item->qnt ?? 0 }}
                                                    </p>
                                                @endif

                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                            <td>{{ $item->total }}</td>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-xlver{{ $item->id }}"><i
                                                        class="fas fa-eye"></i></button>
                                                @if (auth()->user()->perfil == 'Secretário Financeiro' or auth()->user()->perfil == 'Financeiro')
                                                    <button class="btn btn-success" data-toggle="modal"
                                                        data-target="#modal-defaulteditEntrada{{ $item->id }}"><i
                                                            class="fas fa-edit"></i></button>
                                                @endif
                                                @if (auth()->user()->perfil == 'SEO' or
                                                        auth()->user()->perfil == 'Dir Administrativo' or
                                                        auth()->user()->perfil == 'Dir Geral')
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modal-defaultedialuno{{ $item->id }}"
                                                        style="display: inline-block"><i
                                                            class="fas fa-trash"></i></button>
                                                @endif
                                            </td>
                                            </td>
                                        </tr>

                                        <!-- MODAL VER DETALHES DO ALUNO -->
                                        <div class="modal fade" id="modal-xlver{{ $item->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title text-primary">Faturação de entrada de
                                                            Pagamento:
                                                            {{ $item->nome }}</h6>
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
                                                                                    <a href="../storage/">
                                                                                        <img class=" "
                                                                                            target="_blank"
                                                                                            src="Kanongue.png"
                                                                                            alt="user image"
                                                                                            style="width: 150px; height: 150px; ">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <p>
                                                                                        <h3
                                                                                            class="profile-username text-info ">
                                                                                            {{ $item->aluno->nome??'Outro tipo de pagamento'}}
                                                                                        </h3>
                                                                                        </p>
                                                                                        <p>

                                                                                            <b>Tipo de Pagamento: </b>
                                                                                            {{ $item->tipo_pagamento->tipo ?? $item->outro}}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <br>
                                                                                        <p>
                                                                                            <b>Classe: </b>
                                                                                            {{ $item->aluno->clace->nome ??'----' }}
                                                                                        </p>

                                                                                        @if(isset($item->tipo_pagamento_id) and ($item->tipo_pagamento->tipo == 'Propina'
                                                                                         or $item->tipo_pagamento->tipo == 'propina' ))
                                                                                            <p> <b>Meses: </b>
                                                                                                @forelse ($item->meses as $mes)
                                                                                                    {{ $mes->nome }}
                                                                                                @empty
                                                                                                @endforelse
                                                                                            </p>
                                                                                        @else
                                                                                            <p>
                                                                                                <b>Quantidade: </b>
                                                                                                {{ $item->qnt ?? 0 }}
                                                                                            </p>
                                                                                        @endif


                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <p>
                                                                                            <b>Turma: </b>
                                                                                            {{ $item->aluno->turma->nome ??'----'}}
                                                                                        </p>

                                                                                        <p>
                                                                                            <b>Data de Pagamento: </b>
                                                                                            {{ $item->created_at }}
                                                                                        </p>


                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <p>
                                                                                            <b>Total Pago: </b>
                                                                                            {{ $item->total }} Kz
                                                                                        </p>

                                                                                    </div>

                                                                                    <br>
                                                                                    <div class="row no-print">

                                                                                        <div class="col-12">
                                                                                            <br><br>
                                                                                            <hr>
                                                                                            <a href="download:/pagamentos"
                                                                                                rel="noopener"
                                                                                                class="btn btn-default"><i
                                                                                                    class="fas fa-print"></i>
                                                                                                Print</a>

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
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-default">Tem certeza que deseja mover este pagamento
                                            para a lixeira? </p>
                                        <form action="{{ route('DeleteEntradas', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="card-footer">
                                                <button type="submit"
                                                    class="btn btn-warning
                                            text-white">Sim</button>
                                        </form>
                                        <button type="button"
                                            class="btn btn-danger
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

                    <!--EDITANDO AS ENTRADAS-->
                    <div class="modal fade" id="modal-defaulteditEntrada{{ $item->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar entrada de pagamentos</h4>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form id="quickForm" action="{{ route('editPagamento', $item->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Aluno</label>
                                                <select class="form-control select2" style="width: 100%;" required
                                                    name="aluno_id">
                                                    <option selected="selected">Selecione um Aluno</option>
                                                    @forelse($alunos as $aluno)
                                                        @if (isset($item->aluno_id) and $item->aluno->nome == $aluno->nome)
                                                            @if ($aluno->clace->curso_id > 0)
                                                                <option value="{{ $aluno->id }}"
                                                                    {{ $item->aluno->id == $aluno->id ? 'selected' : '' }}>
                                                                    {{ $aluno->nome . ' ' .$aluno->turma->nome.'-'.$aluno->clace->nome . '-' . $aluno->clace->curso->nome }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $aluno->id }}"
                                                                    {{ $item->aluno->id == $aluno->id ? 'selected' : '' }}>
                                                                    {{ $aluno->nome.'-'.$aluno->turma->nome.'-'. $aluno->clace->nome }}
                                                                </option>
                                                            @endif
                                                        @endif
                                                    @empty
                                                        <span class="text-danger">Nenhum aluno foi encontrado</span>
                                                    @endforelse
                                                    @error('aluno_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tipos de Pagamento</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="tipo_pagamento_id" required>
                                                    <option selected="selected">Selecione um Tipo</option>
                                                    @forelse($tipos as $tipo)
                                                    
                                                        @if ($tipo->clace->curso_id > 0)
                                                            <option value="{{ $tipo->id }}"
                                                                {{ $item->tipo_pagamento_id == $tipo->id ? 'selected' : '' }}>
                                                                {{ $tipo->tipo . ' ' . $tipo->clace->nome . '-' . $tipo->clace->curso->nome }}
                                                            </option>
                                                        @else
                                                            <option value="{{$tipo->id}}"
                                                                {{$item->tipo_pagamento_id == $tipo->id ? 'selected' : '' }}>
                                                                {{$tipo->tipo . '-' . $tipo->clace->nome }}</option>
                                                        @endif

                                                    @empty
                                                        <span class="text-danger">Nenhum tipo foi encontrado</span>
                                                    @endforelse

                                                    @error('tipo_pagamento_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Meses</label>
                                                <div class="select2-purple">
                                                    <select class="select2" multiple="multiple"
                                                        data-placeholder="Select a State"
                                                        data-dropdown-css-class="select2-purple" style="width: 100%;"
                                                        name="meses[]">
                                                        <option>Selecione os Meses</option>
                                                        @forelse($meses as $mes)
                                                            @forelse ($item->meses as $me)
                                                                <option value="{{ $mes->id }}"
                                                                    {{ $mes->nome == $me->nome ? 'selected' : '' }}>
                                                                    {{ $mes->nome ?? '' }}
                                                                </option>

                                                            @empty
                                                            @endforelse

                                                            </option>

                                                        @empty
                                                            <span class="text-danger">Nenhum tipo mês foi
                                                                encontrado</span>
                                                        @endforelse

                                                        @error('meses')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </select>
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <label>Outro Tipo</label>
                                                <div class="select2-purple">
                                                    <input type="text" name="outro" class="form-control"
                                                     maxlength="200" value="{{old('outro',$item->outro ??'')}}">
                                                    @error('outro')
                                                        <span class="text-danger">{{$message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <div class="form-group">
                                                <label>Quantidade</label>
                                                <div class="select2-purple">
                
                                                    <input type="number" name="qnt" class="form-control"
                                                    value="{{old('outro')}}">
                                                    @error('qnt')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <div class="form-group">
                                                <label>Preço</label>
                                                <div class="select2-purple">
                                                    <input type="number" name="preco" class="form-control"
                                                    value="{{old('outro',$item->preco)}}">
                                                    @error('preco')
                                                        <span class="text-danger">{{$message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                
                                            <!-- /.card-body -->
                                            <div class="card-footer">

                                            </div>

                                        </div>
                                        <div class="modal-footer justify-content-between">

                                            <button type="submit" class="btn btn-success">Editar</button>
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Fechar</button>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    @empty
                        <span class="text-danger">Nenhum aluno foi cadastrado!</span>
                        @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Aluno</th>
                                <th colspan="1">Tipo</th>
                                <th>Meses/Qnt</th>
                                <th>Data/H</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>


  <!--TABELA DAS SÍDAS DE PAGAMENTOS-->
  <div id="saidas" style="display: none">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th colspan="3"></th>
                <th>Meses/Qnt</th>
                <th>Data/H</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>

        </thead>
        <tbody>
            @forelse ($pamentosSaidas as $item)
                <tr>
                    <th>Funcionário/Tipo</th>
                    <td colspan="2">
                        @if (isset($item->funcionario->id))
                            {{ $item->funcionario->nome }}
                        @else
                            {{ $item->tipo }}
                        @endif
                    </td>
                    <td>
                        @if ($item->tipo == 'Salário' or $item->tipo == 'Salario' or
                        $item->tipo == 'salário' or $item->tipo == 'salario')
                            <p>
                                @forelse ($item->meses as $mes)
                                    {{ $mes->nome }}
                                @empty
                                @endforelse
                            </p>
                        @else
                            <p>
                                <b>Quantidade: </b>
                                {{ $item->qnt ?? '' }}
                            </p>
                        @endif
                    </td>
                    <td>{{ date('m-d-Y', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->total }}</td>
                    <td>
                        <button class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-xlver{{ $item->id }}"><i class="fas fa-eye"></i></button>
                        @if (auth()->user()->perfil == 'Secretário Financeiro' or auth()->user()->perfil == 'Financeiro')
                            <button class="btn btn-success" data-toggle="modal"
                                data-target="#modal-defaulteditEntrada{{ $item->id }}"><i
                                    class="fas fa-edit"></i></button>
                        @endif
                        @if (auth()->user()->perfil == 'SEO' or
                                auth()->user()->perfil == 'Dir Administrativo' or
                                auth()->user()->perfil == 'Dir Geral')
                            <button class="btn btn-warning" data-toggle="modal"
                                data-target="#modal-defaultedialuno{{ $item->id }}"
                                style="display: inline-block"><i class="fas fa-trash"></i></button>
                        @endif
                    </td>
                </tr>

                <!-- MODAL VER DETALHES DO ALUNO -->
                <div class="modal fade" id="modal-xlver{{ $item->id }}">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title text-primary">Faturação de entrada de
                                    Pagamento:
                                    {{ $item->nome }}</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                            <a href="../storage/">
                                                                <img class=" " target="_blank"
                                                                    src="Kanongue.png" alt="user image"
                                                                    style="width: 150px; height: 150px; ">
                                                            </a>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p>
                                                                <h3 class="profile-username text-info ">
                                                                    
                                                                </h3>
                                                                </p>
                                                                <p>

                                                                    <b>Tipo de Pagamento: </b>
                                                                  
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <br>
                                                                <p>
                                                                    <b>Classe: </b>
                                                                  
                                                                </p>

                                                                @if ($item->tipo == 'Propina' or $item->tipo == 'propina')
                                                                    <p> <b>Meses: </b>
                                                                        @forelse ($item->meses as $mes)
                                                                            {{ $mes->nome }}
                                                                        @empty
                                                                        @endforelse
                                                                    </p>
                                                                @else
                                                                    <p>
                                                                        <b>Quantidade: </b>
                                                                        {{ $item->qnt ?? '' }}
                                                                    </p>
                                                                @endif


                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>
                                                                    <b>Turma: </b>
                                                                   
                                                                </p>

                                                                <p>
                                                                    <b>Data de Pagamento: </b>
                                                                    {{ $item->created_at }}
                                                                </p>


                                                            </div>
                                                            <div class="col-md-6">
                                                                <p>
                                                                    <b>Total Pago: </b>
                                                                    {{ $item->total }} Kz
                                                                </p>

                                                            </div>

                                                            <br>
                                                            <div class="row no-print">

                                                                <div class="col-12">
                                                                    <br><br>
                                                                    <hr>
                                                                    <a href="download:/pagamentos" rel="noopener"
                                                                        class="btn btn-default"><i
                                                                            class="fas fa-print"></i>
                                                                        Print</a>

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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-default">Tem certeza que deseja mover este pagamento
                    para a lixeira? </p>
                <form action="{{ route('DeleteEntradas', $item->id) }}" method="post">
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

     <!--EDITANDO AS ENTRADAS-->
<div class="modal fade" id="modal-defaulteditEntrada{{ $item->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar entrada de pagamentos</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="quickForm" action="{{ route('editPagamento', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Aluno</label>
                            <select class="form-control select2" style="width: 100%;" required name="aluno_id">
                                <option selected="selected">Selecione um Aluno</option>
                             
                               
                        </div>
                        <div class="form-group">
                            <label>Tipos de Pagamento</label>
                            <select class="form-control select2" style="width: 100%;" name="tipo_pagamento_id"
                                required>
                                <option selected="selected">Selecione um Tipo</option>
                             
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Meses</label>
                            <div class="select2-purple">
                                <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;" name="meses[]">
                                    <option>Selecione os Meses</option>
                                   
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Quantidade</label>
                            <div class="select2-purple">

                                <input type="number" name="qnt" class="form-control" value="">
                                @error('qnt')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="submit" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
  @empty
    <span class="text-danger">Nenhum aluno foi cadastrado!</span>
    @endforelse

    </tbody>
    <tfoot>
        <tr>
            <th colspan="3"></th>
            <th>Meses/Qnt</th>
            <th>Data/H</th>
            <th>Valor</th>
            <th>Ações</th>
         </tr>
       </tfoot>
      </table>
</div>









                </div>
                <!-- /.card-body -->
            </div>

    </div>

    <!--MODAL DAS ENTRADAS CONTAS-->

    <div class="modal fade" id="modal-entradas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Pagamentos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quickForm" action="{{ route('addPagamento') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Aluno</label>
                                <select class="form-control select2" style="width: 100%;" required name="aluno_id">
                                    <option selected="selected">Selecione um Aluno</option>
                                    @forelse($alunos as $aluno)
                                        @if ($aluno->clace->curso_id > 0)
                                            <option value="{{ $aluno->id }}">
                                                {{ $aluno->nome . ' ' . $aluno->clace->nome . '-' . $aluno->clace->curso->nome }}
                                            </option>
                                        @else
                                            <option value="{{ $aluno->id }}">
                                                {{ $aluno->nome . '-' . $aluno->clace->nome }}</option>
                                        @endif

                                    @empty
                                        <span class="text-danger">Nenhum aluno foi encontrado</span>
                                    @endforelse
                                    @error('aluno_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tipos de Pagamento</label>
                                <select class="form-control select2" style="width: 100%;" name="tipo_pagamento_id"
                                    required>
                                    <option selected="selected">Selecione um Tipo</option>
                                    @forelse($tipos as $tipo)
                                        @if ($tipo->clace->curso_id > 0)
                                            <option value="{{ $tipo->id }}">
                                                {{ $tipo->tipo . ' ' . $tipo->clace->nome . '-' . $tipo->clace->curso->nome }}
                                            </option>
                                        @else
                                            <option value="{{ $tipo->id }}">
                                                {{ $tipo->tipo . '-' . $tipo->clace->nome }}</option>
                                        @endif

                                    @empty
                                        <span class="text-danger">Nenhum tipo foi encontrado</span>
                                    @endforelse

                                    @error('tipo_pagamento_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Meses</label>
                                <div class="select2-purple">
                                    <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                        data-dropdown-css-class="select2-purple" style="width: 100%;" name="meses[]">
                                        <option>Selecione os Meses</option>
                                        @forelse($meses as $mes)
                                            <option value="{{ $mes->id }}">{{ $mes->nome ?? '' }}
                                            </option>
                                        @empty
                                            <span class="text-danger">Nenhum tipo mês foi encontrado</span>
                                        @endforelse

                                        @error('meses')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </select>
                                </div>

                            </div>
                            
                            <div class="form-group">
                                <label>Outro Tipo</label>
                                <div class="select2-purple">
                                    <input type="text" name="outro" class="form-control" maxlength="200">
                                    @error('outro')
                                        <span class="text-danger">{{$message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Quantidade</label>
                                <div class="select2-purple">

                                    <input type="number" name="qnt" class="form-control">
                                    @error('qnt')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Preço</label>
                                <div class="select2-purple">
                                    <input type="number" name="preco" class="form-control">
                                    @error('preco')
                                        <span class="text-danger">{{$message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>




    <div class="modal fade" id="modal-defaultciclus1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Tipo de pagamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="quickForm" action="{{ route('addTipoPagamento') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de pagamento</label>
                                <input type="text" name="tipo" class="form-control" required>
                                @error('tipo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Preço</label>
                                <input type="number" name="preco" class="form-control" required>
                                @error('preco')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Classe</label>
                                <select name="clace_id" id="" class="form-control" required>
                                    <option value="">Selecionar classe</option>
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

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>

                </div>
                <div class="modal-footer justify-content-between">

                    <button type="submit" class="btn btn-primary">Adicionar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>






    <!---MODAL DAS SAIDAS--->
    <div class="modal fade" id="modal-addsaida1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Saídas</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="quickForm" action="{{ route('addSaida') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Funcionário</label>
                                <select class="form-control select2" style="width: 100%;" required name="funcionario_id">
                                    <option selected="selected">Selecione um Funcionarios</option>
                                    @forelse($funcionarios as $func)
                                        <option value="{{ $func->id }}">
                                            {{ $func->nome }}
                                        </option>
                                    @empty
                                        <span class="text-danger">Nenhum funcionario foi encontrado</span>
                                    @endforelse
                                    @error('funcionario_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Meses</label>
                                <div class="select2-purple">
                                    <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                        data-dropdown-css-class="select2-purple" style="width: 100%;" name="meses[]">
                                        <option>Selecione os Meses</option>
                                        @forelse($meses as $mes)
                                            <option value="{{ $mes->id }}">{{ $mes->nome ?? '' }}
                                            </option>
                                        @empty
                                            <span class="text-danger">Nenhum tipo mês foi encontrado</span>
                                        @endforelse

                                    </select>
                                    @error('meses')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tipos de Saídas</label>

                                <input type="text" class="form-control" required name="tipo">

                                @error('tipo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label>Quantidade</label>

                                <input type="number" class="form-control" name="qnt">

                                @error('qnt')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label>Preço</label>

                                <input type="number" class="form-control" name="preco">

                                @error('preco')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group">
                                <label>Descrição</label>
                                <div class="select2-purple">

                                    <textarea name="descri" id="" cols="5" rows="3" class="form-control"></textarea>
                                    @error('descri')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">

                            <button type="submit" class="btn btn-primary">Adicionar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </form>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>






  
    
  </div>
   
      </div>

    </div>







    </section>

    </div>

@endsection
