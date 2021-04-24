<!DOCTYPE html>

<html lang="{{ config('app.locale') }}" >
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0" />
    <title>Prueba El lab</title>  
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">     --}}
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base-url" content="{{ url('/') }}" />

    @yield('metas')
    <style type="text/css">
       [v-cloak] {
          display: none !important;
      } 

    </style>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/estilos.css?v=4') }}" />  
    <link type="text/css" rel="stylesheet" href="{{ asset('css/my_styles.css?v=4') }}" /> 
    {{-- <link type="text/css" rel="stylesheet" href="css/estilos.css?v=4" />  
    <link type="text/css" rel="stylesheet" href="css/my_styles.css?v=4" />  --}}

    @stack('css')
  </head>

  <body id="body">
    
    <div id="app"> 
        @yield('content') 
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    {{-- <script src="js/app.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script> --}}
    @stack('js')
  </body>

</html>

