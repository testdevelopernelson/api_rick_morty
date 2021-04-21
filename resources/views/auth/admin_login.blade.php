<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
      <title>{{ config('app.name') }} | Iniciar sesión</title>

      <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
      <link rel="stylesheet" href="{{url('/mng/bootstrap/css/bootstrap.min.css')}}"  type="text/css">
      <link rel="stylesheet" href="{{url('/mng/css/plugins.css')}}">
      <link rel="stylesheet" href="{{url('/mng/css/login.css')}}">
      <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicons/apple-touch-icon.png') }}">
      <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicons/favicon-32x32.png') }}">
      <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicons/favicon-16x16.png') }}">
      <link rel="manifest" href="{{ asset('img/favicons/manifest.json') }}">
      <link rel="mask-icon" href="{{ asset('img/favicons/safari-pinned-tab.svg') }}" color="#0a51a1">
      <link rel="shortcut icon" href="{{ asset('img/favicons/favicon.ico') }}">
      <meta name="apple-mobile-web-app-title" content="Compratodo">
      <meta name="application-name" content="Compratodo">
      <meta name="msapplication-TileColor" content="#0a51a1">
      <meta name="msapplication-config" content="{{ asset('img/favicons/browserconfig.xml') }}">
      <meta name="theme-color" content="#0a51a1">
    </head>

  <body class="body">
    <div class="form-container outer">          
        <div class="form-form">
            <div class="form-form-wrap">

                  
                <div class="form-container">
                    <div class="form-content">
                        @if(session()->has('data_invalid'))
                          <p class="login-box-msg">{{ session()->get('data_invalid') }}</p>
                          <p class="">{{ session()->get('attempts') }}</p>
                        @endif
                        <h1 class="">Iniciar sesión</h1>
                        <p class="">Inicie sesión en su cuenta para continuar.</p>
                      @if(!$activedTimeout)   
                        <form class="text-left" method="POST" action="{{ route('admin.login.submit') }}">
                        {{ csrf_field() }}
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">CORREO ELECTRÓNICO</label>
                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    
                                    <input id="username" name="email" type="text" class="form-control" placeholder="correo@ejemplo.com">
                                    @if ($errors->has('email'))
                                        <p class="login-box-msg">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">CONTRASEÑA</label>
                                        <a class="forgot-pass-link cursor">¿Olvidó su contraseña?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Ingresar</button>
                                    </div>
                                </div>

                                <p class="signup-link">¿Quieres registrarte? <a href="">Clic aquí</a></p>

                                 <p class="signup-link">Volver a <a href="{{ url('/') }}">{{config('app.name')}} </a></p>

                            </div>
                        </form>
                       @else
                         <p class="login-box-msg" style="color:#901414;">{{ $timeLeft }}</p>
                         <p class="signup-link"><a href="">Recargar</a></p>
                         
                        @endif
                    </div>                    
                </div>
            </div>
        </div>
    </div>
<!-- /.login-box -->
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/mng/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{url('/mng/bootstrap/js/bootstrap.min.js')}}"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/mng/js/login.js')}}"></script>
  </body>

</html>

