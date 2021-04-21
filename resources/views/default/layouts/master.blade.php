<!DOCTYPE html>

<html lang="{{ config('app.locale') }}" >
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0" />
    <title>Prueba El lab</title>

     
     <!-- favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base-url" content="{{ url('/') }}" />

    @yield('metas')
    <style type="text/css">
       [v-cloak] {
          display: none !important;
      } 

    </style>
    <script>
        window.paceOptions = {
            restartOnRequestAfter: false
        }
    </script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}" />  
    <link type="text/css" rel="stylesheet" href="{{ asset('css/estilos.css?v=4') }}" />  
    <link type="text/css" rel="stylesheet" href="{{ asset('css/my_styles.css?v=4') }}" />   
    <link type="text/css" rel="stylesheet" href="{{ asset('css/shop_style.css') }}" />   
    <link type="text/css" rel="stylesheet" href="{{ asset('css/sweet_alert.css') }}" />  
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}" />  
    <link type="text/css" rel="stylesheet" href="{{ asset('css/jquery.bxslider.min.css') }}" />  

    @stack('css')

    {{-- <script src="https://www.google.com/recaptcha/api.js?render={{ config('settings.recaptcha_key_site') }}"></script> --}}
    @include('_partials.analytics')
  </head>

  <body id="body">
    <div class="loader" style="display: none"></div>
    
    <div id="app">   
        @include('_partials.header')
            @yield('content')
        @include('_partials.footer')  
    </div>
    
    <script>
        var baseRoot = "{{ url('/')}}";
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('mng/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <script src="{{ asset('js/my_scripts.js') }}"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/jquery.bxslider.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.vinculos.slick').slick({
            dots: false,
            infinite: true,
            autoplay: true,
            arrows: true,
            speed: 300,
            slidesToShow: 1,
            centerMode: false,
            variableWidth: true
        });
        $('.bxslider').bxSlider({
            auto: true,
            pause: 6500,
            autoHover: false,
            pager: false,
            controls: true,
            nextText: 'SIGUIENTE',
            prevText: 'ANTERIOR',
            adaptiveHeight: false,
            touchEnabled: false
        });
         $('.autoplay').slick({            
            dots: false,
            infinite: true,
            autoplay: true,
            arrows: true,
            speed: 300,
            pauseOnHover: false,
            slidesToShow: 5,
            centerMode: false,
            slidesToScroll: 1,
            autoplaySpeed: 5000,
            variableWidth: false,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>
    @stack('js')
  </body>

</html>

