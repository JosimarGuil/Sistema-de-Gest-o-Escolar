
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      


      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          
      </li>
   
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/painel" class="brand-link">
      <img src="kanongue.png" alt="AdminLTE Logo"  style="
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
          <img src="storage/{{auth()->user()->foto}}" 
          style="width: 40px; height: 40px;"  
          class="img-circle elevation-2" alt="User Image">
          @else
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">    
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
          <li class="nav-item menu-open">
            <a href="/painel" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt text-warning"></i>
              <p>
                Painel ADMIN
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
          @if ((auth()->user()->perfil=='SEO' OR 
          auth()->user()->perfil=='Dir Geral'))
              <li class="nav-item">
                <a href="{{route('usuario')}}" class="nav-link">
                  <i class="nav-icon fas fa-users text-success"></i>
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
            <a href="{{route('funcionario')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Gerenciar Funcionários
              </p>
            </a>
          </li>   
          @endif
        

          <li class="nav-item">
            <a href="{{route('alunos')}}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Gerenciar Alunos
           
              </p>
            </a>
          </li>
          @if ( (auth()->user()->perfil=='SEO' OR  auth()->user()->perfil=='Dir Administrativo' OR auth()->user()->perfil=='Dir Geral' OR 
          auth()->user()->perfil=='Secretário Financeiro' OR 
          auth()->user()->perfil=='Financeiro'))
               <li class="nav-item">
                <a href="{{route('pagamentos')}}" class="nav-link">
                  <i class="nav-icon fas fa-th text-warning"></i>
                  <p>
                    Gerenciar Contas
                  </p>
                </a>
              </li>
          @endif
         
          @if((auth()->user()->perfil=='SEO' OR 
          auth()->user()->perfil=='Dir Administrativo' OR auth()->user()->perfil=='Dir Geral' OR 
          auth()->user()->perfil=='Dr Pedagógico'))
               <li class="nav-item">
                <a href="{{route('config')}}" class="nav-link">
                  <i class="nav-icon fas fa-cog text-secondary"></i>
                  <p>
                    Configurações
                  </p>
                </a>
              </li>
          @endif
         
          <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
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
    <strong>Copyright &copy; 2023   Software Desenvolvido pela <a href="https://www.facebook.com/profile.php?id=100092710121892">UNITEC</a>.</strong>
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
    alert('Tem certesa que deseja ver todos cíclus');
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
       alert('Tem certesa que deseja ver todos cursos');
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
      
      alert('Tem certesa que deseja ver todas classes');
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
      
      alert('Tem certesa que deseja ver todas salas');
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
      
      alert('Tem certesa que deseja ver todas turmas');
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
    alert('Tem certsa que deseja Cadastrar alunos');
    document.getElementById('bver').style.display="block";
    document.getElementById('badd').style.display="none";
    document.getElementById('addalunos').style.display="block";
    document.getElementById('listalunos').style.display="none";
  }

  function Verlunos(){
    alert('Tem certsa que deseja Ver todos alunos');
    document.getElementById('badd').style.display="block";
    document.getElementById('bver').style.display="none";
    document.getElementById('addalunos').style.display="none";
    document.getElementById('listalunos').style.display="block";
  }



  function verTposPagamentos(e){
    alert('Tem certesa que deseja ver todas tipos de pagamentos');
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
    alert('Tem certesa que deseja ver todas Entradas');
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
    alert('Tem certesa que deseja ver todas saidas');
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