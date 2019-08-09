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
	

	<div class="container">
@yield('content')
    </div>
</body>

  <!-- Footer -->

  

  
  <!-- Footer -->
	  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset ('js/popper.min.js')}}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset ('js/bootstrap.min.js')}}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset ('js/mdb.min.js')}}"></script>

  <script src="{{ asset ('js/addons/datatables.min.js')}}"></script>
  <script src="{{ asset ('js/addons/datatables-select.min.js')}}"></script>
  

</html>