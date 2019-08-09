<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
 <meta name="viewport"
 content="width=device-width, initial-scale=1, user-scalable=yes">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/style1.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/mdb.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/mdb.lite.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/addons/datatables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('css/addons/datatables-select.min.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ asset ('css/nav.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset ('css/bootstrap-select.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset ('css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset ('css/quill.snow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset ('css/quill.bubble.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset ('css/all.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset ('css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset ('css/jquery-ui.structure.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset ('css/jquery-ui.theme.css')}}">

  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="{{asset('img/blanco.png')}}" width="150"  class="d-inline-block align-top" alt=""></a>
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('inicio')}}"><i class="fas fa-home"></i> Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href=""><i class="fas fa-calendar-alt"></i> Agendados  
        
          
          </a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link disabled" href="#"><i class="far fa-chart-bar"></i> Reportes</a>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-cog"></i> Configuración
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Gestión de usuarios</a>
          <a class="dropdown-item" href="{{route('info')}}">Información de solicitud</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      
     
      <li class="nav-item">
         <a class="nav-link mr-auto" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Salir</a>
      </li>
    
    </ul>
  </div>

</nav>

	<div class="container">
@yield('content3')
    </div>
</body>

  <!-- Footer -->
<footer class="page-footer  pt-4" style="margin-top: 200px;">
  
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2018 Todos los derechos reservados
      <a href="http://quanticoservicios.net"> Quanticoservicios.com</a>
    </div>
    <!-- Copyright -->
  
  <!-- Footer -->
	  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset ('js/popper.min.js')}}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset ('js/bootstrap.min.js')}}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset ('js/mdb.min.js')}}"></script>

  <script src="{{ asset ('js/addons/datatables.min.js')}}"></script>
  <script src="{{ asset ('js/addons/datatables-select.min.js')}}"></script>


<script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
  
</footer>
</html>