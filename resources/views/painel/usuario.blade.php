@extends('tema.tema')

@section('title', 'Gestão de Usuários do Canongue')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestão de Usuários</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Painel</a></li>
                            <li class="breadcrumb-item active">Usuários</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
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
                            <div class="bg-warning" style="width:100%; margin: auto;
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
                        <div class="bg-danger" style="width:100%; margin: auto;
padding: 10px; border-radius: 15px">
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
                            Painel de Gestão de usuários
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="col-12">

                            <button type="button" class="btn btn-primary toastrDefaultWarning " data-toggle="modal"
                                data-target="#modal-defaultciclus1" onclick="Verlunos()" style="display: none"
                                id="bver">
                                Listar todos usuários cadastrados no sistema
                            </button>

                        </div>

                       <span>Zona restrita aos administradores do Canongue</span>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!--TABELA DE LISTAGEM DOS USUÁRIOS-->

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
                                            
                                            <th>Nome Completo</th>
                                            <th>Telefone</th>
                                            <th>Cargo</th>   
                                            <th>Sexo</th>     
                                            <th>Nascimento</th>
                                            <th>Status</th>
                                            <th>ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($user as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{$item->fone}}</td>
                                                <td>{{ $item->perfil }}</td>
                                                <td>{{$item->sexo}}</td>
                                                <td>{{$item->data}}</td>
                                                <td>
                                                    @if($item->status==true)
                                                        {{'Activo'}}
                                                        @else
                                                        {{'Inativo'}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                            <button class="btn btn-primary" data-toggle="modal"
                                                            data-target="#modal-lgDetalhes{{ $item->id }}"><i
                                                            class="fas fa-eye"></i> </button>
                                                           
                                                           
                                                            
                                                            <button class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal-xleditar{{ $item->id }}"><i
                                                                class="fas fa-edit"></i></button>
                                                 @if(auth()->user()->perfil=='SEO')
                                                                          
                                                    <button class="btn btn-warning" data-toggle="modal"
                                                    data-target="#modal-defaultedialuno{{ $item->id }}"><i
                                                    class="fas fa-trash"></i></button>

                                                    @if($item->status==true)
                                                    <form action="{{route('desbilitar',$item->id)}}" method="post" style="display: inline-block">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="0">
                                                        <button class="btn btn-secondary" data-toggle="modal"
                                                        type="submit"
                                                        data-target="#edit{{ $item->id }}">Desativar</button>

                                                    </form>
                                                    @else
                                                    <form action="{{route('desbilitar',$item->id)}}" method="post" style="display: inline-block">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="1">
                                                        <button class="btn btn-info" data-toggle="modal"
                                                        type="submit"
                                                        data-target="#edit{{ $item->id }}">Ativar</button>

                                                    </form>
                                                @endif
                                                @endif 
                                                </td>

                                                <div class="modal fade" id="modal-xleditar{{ $item->id }}">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title text-primary">Editando Usuário:
                                                                    {{ $item->name }}</h6>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="quickForm" method="post"
                                                                action="{{ route('Editusuario', $item->id) }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nome
                                                                            Completo*</label>
                                                                        <input type="text" maxlength="50"
                                                                            minlength="5" name="nome"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            required placeholder="Nome Completo"
                                                                            value="{{ old('nome', $item->name) }}">
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
                                                                        <br> <span>Selecione o sexo do usuário</span>
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
                                                                        <label for="exampleInputEmail1">Email</label>
                                                                        <input type="email" maxlength="50"
                                                                            minlength="5" name="email"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            value="{{ old('email', $item->email) }}"
                                                                            placeholder="E-mail" required>
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
                                                                            value="{{ old('fone',$item->fone) }}"
                                                                            placeholder="Telefone" minlength="9"
                                                                            maxlength="9">
                                                                        @error('fone')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group ">
                                                                        <label for="exampleInputPassword1">Cargo*</label>
                                                                        <select name="perfil" id="" required class="form-control">
                                                                            <option value="">Selecior um Cargo</option>
                                                                            <option value="SEO"
                                                                            {{$item->perfil=='SEO'?'selected':''}}>SEO</option>
                                                                            <option value="Professor"
                                                                            {{$item->perfil=='Professor'?'selected':''}}>Professor</option>
                                                                            <option value="Dir Geral"
                                                                            {{$item->perfil=='Dir Geral'?'selected':''}}>Dir Geral</option>
                                                                            <option value="Dir Administrativo" 
                                                                            {{$item->perfil=='Dir Administrativo'?'selected':''}}>Dir Administrativo</option> 
                                                                            <option value="Secretário Geral"
                                                                            {{$item->perfil=='Secretário Geral'?'selected':''}}>Secretário Geral</option>
                                                                            <option value="Secretário Pedagógico"
                                                                            {{$item->perfil=='Secretário Pedagógico'?'selected':''}}>Secretário Pedagógico</option>
                                                                            <option value="Secretário Financeiro"
                                                                            {{$item->perfil=='Secretário Financeiro'?'selected':''}}>Secretário Financeiro</option>
                                                                            <option value="Financeiro"
                                                                            {{$item->perfil=='Financeiro'?'selected':''}}>Financeiro</option>
                                                                            <option value="Dr Pedagógico"
                                                                            {{$item->perfil=='Dr Pedagógico'?'selected':''}}>Dr Pedagógico</option>
                                                                            <option value="Segurança"
                                                                            {{$item->perfil=='Segurança'?'selected':''}}>Segurança</option>
                                                                            <option value="Dir Geral"
                                                                            {{$item->perfil=='Dir Geral'?'selected':''}}>Dir Geral</option>
                                                                            <option value="Higiene/Limpeza"
                                                                            {{$item->perfil=='Higiene/Limpeza'?'selected':''}}>Higiene/Limpeza</option>
                                                                            <option value="Vigilante"
                                                                            {{$item->perfil=='Vigilante'?'selected':''}}>Vigilante</option>
                                                                            @error('perfil')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Foto Meio
                                                                            Corpo*</label>
                                                                        <input type="file" maxlength="255"
                                                                             name="foto"
                                                                            value="{{$item->foto}}"
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
                                                                            value="{{ $item->documentos }}"
                                                                            class="form-control" id="exampleInputEmail1"
                                                                            placeholder="Nome Completo">
                                                                        @error('doc')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                        <p class="text-default">Extenções: pdf, Tamanho: 2024KB</p>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-success">Editar</button>
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
                                            </tr>
                                            <!-- MODAL VER DETALHES DO ALUNO -->

                                            <div class="modal fade" id="modal-lgDetalhes{{ $item->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Detalhes do Usuário</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Main content -->

                                                            <div class="card">
         
                                                                <div class="card-body">
                                                                  <div class="row">
                                                                    <div class="col-12 col-md-12">
                                                                      <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="post">
                                                                              <div class="user-block">
                                                                                <img class="img-circle img-bordered-sm" src="../storage/{{$item->foto??''}}"
                                                                                 target="_blank" alt="user image" style="width: 150px; height: 150px; border-color:rgb(0, 174, 255);
                                                                                 border-radius: 5px">   
                                                                                   <img class=" "
                                                                                   src="kanongue.png"
                                                                                   target="_blank"
                                                                                   alt="user image"
                                                                                   style="width: 100px; height: 100px; float: right">
                                                                              </div>
                                                                              <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <p>     
                                                                                        <h3 class="profile-username text-info">{{$item->name??''}}</h3>  
                                                                                    </p>
                                                                                    <p><i class="fas fa-user text-info"> Genero: </i> {{$item->sexo??''}}</p>   
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <br>
                                                                                    <p><i class="fas fa-envelope text-info"> Email: </i> {{$item->email??''}}</p>
                                                                                    <p><i class="fas fa-map-marker-alt mr-1 text-info"> Morada: </i> {{$item->morada??''}}</p>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p><i class="fas fa-phone text-info"> Telefone: </i> {{$item->fone??''}}</p>
                                                                                    @if($item->whatsapp)
                                                                                    <p><i class="nav-icon far fa-circle text-info"> Whatsapp: </i> {{$item->whatsapp??''}}</p>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <p><i class="nav-icon far fa-circle text-info"> Cargo: </i> {{$item->perfil??''}}</p>
                                                                                    <p><i class="nav-icon far fa-circle text-info "> Status: </i> {{$item->status==1?'Ativo': 'Inativo'}}</p>   
                                                                                </div><br><br>
                                                                                <div class="col-md-12">
                                                                                    <br>
                                                                                    <a href="../storage/{{$item->documentos??''}}" 
                                                                                        target="_blank"
                                                                                        class="btn btn-info">  Ver documentação completa do Funcionário</a>
                                                                                  
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
                                                <!--MODAL DE DELETAÇÃO DE USUÁRIOS-->
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
                                                            <p class="text-default">Tem certeza que deseja mover este usuário para a lixeira? </p>
                                                            <form action="{{ route('Deleteusuario', $item->id) }}"
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

                                            <!--ZONA DE EDICAO DE USUARIO--->
                                            
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
