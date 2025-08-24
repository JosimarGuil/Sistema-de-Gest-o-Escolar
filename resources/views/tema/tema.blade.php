<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->

  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->

  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center" style="background-color: white">
      <img class="animation__shake" src="kanongue.png" alt="AdminLTELogo" style="
       width: 150px;
      height: 150px;">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/painel" class="brand-link">
        <img src="kanongue.png" alt="AdminLTE Logo" style="
      width: 120px;
      height: 80px;">
        <span class="brand-text font-weight-light">Canongue</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if (isset(auth()->user()->foto))
            <img src="storage/{{auth()->user()->foto}}" style="width: 40px; height: 40px;"
              class="img-circle elevation-2" alt="User Image">
            @else
            <img src="https://www.bing.com/th/id/OIP.LJq0q7abuN6zg3U3EiWj2QAAAA?w=182&h=211&c=8&rs=1&qlt=90&o=6&cb=thwsc4&pid=3.1&rm=2" class="img-circle elevation-2" alt="User Image">
            @endif

          </div>
          <div class="info">
            <a href="#" class="text-white">{{auth()->user()->name}}</a>
            <span class="d-block" style="color: #ccc">{{auth()->user()->perfil}}</span>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/painel" class="nav-link {{Route::is('painel') ? 'active' : '' }} flex items-center">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                    d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                    clip-rule="evenodd" />
                </svg>
                <p>
                  Painel inicial
                </p>
              </a>
            </li>
            @if ((auth()->user()->perfil=='SEO' OR
            auth()->user()->perfil=='Dir Geral'))
            <li class="nav-item">
              <a href="{{route('usuario')}}" class="nav-link {{Route::is('usuario') ? 'active' : '' }}">
                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                    d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                    clip-rule="evenodd" />
                </svg>

                <p>
                  Gerenciar Usuários

                </p>
              </a>
            </li>
            @endif
            @if ((auth()->user()->perfil=='SEO' OR
            auth()->user()->perfil=='Dir Administrativo' OR auth()->user()->perfil=='Dir Geral' OR
            auth()->user()->perfil=='Secretário Financeiro' OR
            auth()->user()->perfil=='Financeiro'))
            <li class="nav-item">
              <a href="{{route('funcionario')}}" class="nav-link {{Route::is('funcionario') ? 'active' : '' }}">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                    d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                    clip-rule="evenodd" />
                </svg>
                <p>
                  Gerenciar Funcionários
                </p>
              </a>
            </li>
            @endif


            <li class="nav-item">
              <a href="{{route('alunos')}}" class="nav-link {{Route::is('alunos') ? 'active' : '' }} ">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M12.4472 2.10557c-.2815-.14076-.6129-.14076-.8944 0L5.90482 4.92956l.37762.11119c.01131.00333.02257.00687.03376.0106L12 6.94594l5.6808-1.89361.3927-.13363-5.6263-2.81313ZM5 10V6.74803l.70053.20628L7 7.38747V10c0 .5523-.44772 1-1 1s-1-.4477-1-1Zm3-1c0-.42413.06601-.83285.18832-1.21643l3.49538 1.16514c.2053.06842.4272.06842.6325 0l3.4955-1.16514C15.934 8.16715 16 8.57587 16 9c0 2.2091-1.7909 4-4 4-2.20914 0-4-1.7909-4-4Z" />
                  <path
                    d="M14.2996 13.2767c.2332-.2289.5636-.3294.8847-.2692C17.379 13.4191 19 15.4884 19 17.6488v2.1525c0 1.2289-1.0315 2.1428-2.2 2.1428H7.2c-1.16849 0-2.2-.9139-2.2-2.1428v-2.1525c0-2.1409 1.59079-4.1893 3.75163-4.6288.32214-.0655.65589.0315.89274.2595l2.34883 2.2606 2.3064-2.2634Z" />
                </svg>

                <p>
                  Gerenciar Alunos

                </p>
              </a>
            </li>
            @if ( (auth()->user()->perfil=='SEO' OR auth()->user()->perfil=='Dir Administrativo' OR
            auth()->user()->perfil=='Dir Geral' OR
            auth()->user()->perfil=='Secretário Financeiro' OR
            auth()->user()->perfil=='Financeiro'))
            <li class="nav-item">
              <a href="{{route('pagamentos')}}" class="nav-link  {{Route::is('pagamentos') ? 'active' : '' }}">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 18h14M5 18v3h14v-3M5 18l1-9h12l1 9M16 6v3m-4-3v3m-2-6h8v3h-8V3Zm-1 9h.01v.01H9V12Zm3 0h.01v.01H12V12Zm3 0h.01v.01H15V12Zm-6 3h.01v.01H9V15Zm3 0h.01v.01H12V15Zm3 0h.01v.01H15V15Z" />
                </svg>
                <p>
                  Gerenciar Finança
                </p>
              </a>
            </li>
            @endif

            @if((auth()->user()->perfil=='SEO' OR
            auth()->user()->perfil=='Dir Administrativo' OR auth()->user()->perfil=='Dir Geral' OR
            auth()->user()->perfil=='Dr Pedagógico'))
            <li class="nav-item">
              <a href="{{route('config')}}" class="nav-link {{Route::is('config') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog text-secondary text-white"></i>
                <p>
                  Configurações
                </p>
              </a>
            </li>
            @endif

            <li class="nav-item">
              <a href="{{route('logout')}}" class="nav-link">
                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                    d="M10 5a2 2 0 0 0-2 2v3h2.4A7.48 7.48 0 0 0 8 15.5a7.48 7.48 0 0 0 2.4 5.5H5a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1V7a4 4 0 1 1 8 0v1.15a7.446 7.446 0 0 0-1.943.685A.999.999 0 0 1 12 8.5V7a2 2 0 0 0-2-2Z"
                    clip-rule="evenodd" />
                  <path fill-rule="evenodd"
                    d="M10 15.5a5.5 5.5 0 1 1 11 0 5.5 5.5 0 0 1-11 0Zm6.5-1.5a1 1 0 1 0-2 0v1.5a1 1 0 0 0 .293.707l1 1a1 1 0 0 0 1.414-1.414l-.707-.707V14Z"
                    clip-rule="evenodd" />
                </svg>

                <p>
                  Terminar Sessão

                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <section>
      @yield('content')
    </section>







    <footer class="main-footer">
      <strong>Copyright &copy; 2023 Software Desenvolvido pela <a
          href="https://www.facebook.com/profile.php?id=100092710121892">UNITEC</a>.</strong>
      <div class="float-right d-none d-sm-inline-block">
        <b>Versão</b> 1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>



  <!-- jQuery -->

  <!-- Bootstrap 4 -->

  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- BS-Stepper -->
  <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <!-- dropzonejs -->
  <script src="../../plugins/dropzone/min/dropzone.min.js"></script>
  <!-- AdminLTE App -->
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>

  <!-- AdminLTE for demo purposes 
<script src="../../dist/js/demo.js"></script>  

-->

  <!-- Page specific script -->
  <script>
    //mostar lista de siculos
   function siculos(e){
    document.getElementById('turmas').style.display='none';
    document.getElementById('siculo').style.display='block';
    document.getElementById('curso').style.display='none';
    document.getElementById('classes').style.display='none';
    document.getElementById('salas').style.display='none';
    document.getElementById('bcu').style.background="none"
    document.getElementById('bcu').style.color='#343a40';
    document.getElementById('bcla').style.background="none"
    document.getElementById('bcla').style.color='#343a40';
    document.getElementById('bsala').style.background="none"
    document.getElementById('bsala').style.color='#343a40';
    e.style.background="#007bff";
      e.style.color="#fff";
    document.getElementById('bturmas').style.background="none"
    document.getElementById('bturmas').style.color='#343a40';
    
   }


function cursos(e){
  document.getElementById('turmas').style.display='none';
       document.getElementById('siculo').style.display='none';
       document.getElementById('curso').style.display='block';
       document.getElementById('classes').style.display='none';
       document.getElementById('salas').style.display='none';
      e.style.background="#007bff";
      e.style.color="#fff";
      document.getElementById('bci').style.background="none"
    document.getElementById('bci').style.color='#343a40';
    document.getElementById('bcla').style.background="none"
    document.getElementById('bcla').style.color='#343a40';
    document.getElementById('bsala').style.background="none"
    document.getElementById('bsala').style.color='#343a40';
    document.getElementById('bturmas').style.background="none"
    document.getElementById('bturmas').style.color='#343a40';
      
      }


   function classes(e){
      document.getElementById('siculo').style.display='none';
      document.getElementById('curso').style.display='none';
      document.getElementById('classes').style.display='block';
      document.getElementById('salas').style.display='none';
      e.style.background="#007bff";
      e.style.color="#fff";
      document.getElementById('bci').style.background="none"
    document.getElementById('bci').style.color='#343a40';
    document.getElementById('bcu').style.background="none"
    document.getElementById('bcu').style.color='#343a40';
    document.getElementById('bsala').style.background="none"
    document.getElementById('bsala').style.color='#343a40';
    document.getElementById('bturmas').style.background="none"
    document.getElementById('bturmas').style.color='#343a40';
    document.getElementById('turmas').style.display='none';
  }

  function salas(e){
      document.getElementById('siculo').style.display='none';
      document.getElementById('curso').style.display='none';
      document.getElementById('classes').style.display='none';
      document.getElementById('salas').style.display='block';
      e.style.background="#007bff";
      e.style.color="#fff";
      document.getElementById('bci').style.background="none"
    document.getElementById('bci').style.color='#343a40';
    document.getElementById('bcu').style.background="none"
    document.getElementById('bcu').style.color='#343a40';
    document.getElementById('bcla').style.background="none"
    document.getElementById('bcla').style.color='#343a40';
    document.getElementById('bturmas').style.background="none"
    document.getElementById('bturmas').style.color='#343a40';
    document.getElementById('turmas').style.display='none';
  }

  function turmas(e){
      document.getElementById('siculo').style.display='none';
      document.getElementById('curso').style.display='none';
      document.getElementById('classes').style.display='none';
      document.getElementById('salas').style.display='none';
      document.getElementById('turmas').style.display='block';
      e.style.background="#007bff";
      e.style.color="#fff";
     
    document.getElementById('bci').style.color='#343a40';
    document.getElementById('bcu').style.background="none"
    document.getElementById('bcu').style.color='#343a40';
    document.getElementById('bcla').style.background="none"
    document.getElementById('bcla').style.color='#343a40';
    document.getElementById('bsala').style.background="none"
    document.getElementById('bsala').style.color='#343a40';
   
  }


  function AddAlunos(){
    document.getElementById('bver').style.display="block";
    document.getElementById('badd').style.display="none";
    document.getElementById('addalunos').style.display="block";
    document.getElementById('listalunos').style.display="none";
  }

  function Verlunos(){
    document.getElementById('badd').style.display="block";
    document.getElementById('bver').style.display="none";
    document.getElementById('addalunos').style.display="none";
    document.getElementById('listalunos').style.display="block";
  }



  function verTposPagamentos(e){
      document.getElementById('tipo').style.display='block';
      document.getElementById('entradas').style.display='none';
      document.getElementById('saidas').style.display='none';

      e.style.background="#007bff";
      e.style.color="#fff";
     
    document.getElementById('bnentrada').style.background="none"
    document.getElementById('bnentrada').style.color='#343a40';
    document.getElementById('bsaida').style.background="none"
    document.getElementById('bsaida').style.color='#343a40';
  }

  function verEntradas(e){
      document.getElementById('tipo').style.display='none';
      document.getElementById('entradas').style.display='block';
      document.getElementById('saidas').style.display='none';

      e.style.background="#007bff";
      e.style.color="#fff";
        
    document.getElementById('btipo').style.background="none"
    document.getElementById('btipo').style.color='#343a40';
    document.getElementById('bsaida').style.background="none"
    document.getElementById('bsaida').style.color='#343a40';
  }

  function verSaidas(e){
      document.getElementById('tipo').style.display='none';
      document.getElementById('entradas').style.display='none';
      document.getElementById('saidas').style.display='block';

      e.style.background="#007bff";
      e.style.color="#fff";
     
      document.getElementById('bnentrada').style.background="none"
    document.getElementById('bnentrada').style.color='#343a40';
    document.getElementById('btipo').style.background="none"
    document.getElementById('btipo').style.color='#343a40';
  }
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })
  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }

  </script>

</body>

</html>