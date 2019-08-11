<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
 <meta name="viewport"
 content="width=device-width, initial-scale=1, user-scalable=yes">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/mdb.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/mdb.lite.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/addons/datatables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/addons/datatables-select.min.css')}}">
   <link rel="shortcut icon" href="{{asset('public/img/favicon.ico')}}" />
  <link rel="stylesheet" type="text/css" href="{{ asset ('css/nav.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset ('css/bootstrap-select.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset ('css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset ('css/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset ('css/quill.bubble.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset ('css/all.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset ('css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset ('css/jquery-ui.structure.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset ('css/jquery-ui.theme.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset ('css/ingreso.css')}}">

  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
<!--	<link rel="stylesheet" href="vanillabox/theme/bitter/vanillabox.css"> -->
	
	

<script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/jquery-ui.min.js')}}"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	
	<script src="{{asset('js/all.min.js')}}"></script>


     <script src="{{asset('js/jquery.lightbox_me.js')}}"></script>
     <script src="{{asset('js/popper.min.js')}}"></script>
     <script src="{{asset('js/bootstrap.min.js')}}"></script>
     <script src="{{asset('js/bootstrap-select.js')}}"></script>
     <style type="text/css">
       .navbar {
        background-color: rgba(239, 146, 0, 0.5) !important;

    }
  
     </style>
</head>
<body>
  <!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark " style="background-color: rgba(67, 145, 240, 0.5) !important;">
  <a class="navbar-brand" href="#">Reintegros en línea</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('validated',[$voucher,$caso,$service,$hash,$afiliadoId,$voucherid])}}">
          <i class="fas fa-home"></i> Inicio
        </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="{{route('formRequest',[$voucher,$caso,$service,$hash,$afiliadoId,$voucherid])}}">
          <i class="fas fa-file-signature"></i> Formulario de solicitud</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('requestEstatus',[$voucher,$caso,$service,$hash,$afiliadoId,$voucherid])}}">
          <i class="fas fa-question-circle"></i> Estatus de solicitud</a>
      </li>
       <li class="nav-item">
        <form method="POST" action="{{route('logout',[$voucher,$caso,$service,$hash,$afiliadoId,$voucherid])}}">
         

          {{@csrf_field()}}
          <input class="btn btn-danger" type="hidden" value="Delete" />
          <button class="btn btn-info btn-sm" type="submit"><span style="color: #fff;"><i class="fas fa-sign-out-alt"></i> Salir</span></button>
        
          </form>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->
	

	
@yield('content2')
   
</body>

  <!-- Footer -->

  <footer>

  
  <!-- Footer -->
	  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset ('js/popper.min.js')}}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset ('js/bootstrap.min.js')}}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset ('js/mdb.min.js')}}"></script>

  <script src="{{ asset('js/dropzone.js') }}"></script>

  <script src="{{ asset ('js/addons/datatables.min.js')}}"></script>
  <script src="{{ asset ('js/addons/datatables-select.min.js')}}"></script>


  </footer>
  

</html>