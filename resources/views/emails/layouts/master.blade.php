<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet" type="text/css">
  </head>
    <body style="font-family: 'roboto', Arial, Helvetica, sans-serif;">
      
        <div style="max-width: 100%; margin-left: auto; margin-right: auto;">
            <div style="text-align: center;">
                {{ $header ?? '' }}
            </div>
            <div style="position: relative;height: 96vh;">
              <div class="header_br1">
                  <div style="text-align: center;background-color: #0a51a1; ">
                    <a href="{{ url('/') }}">
                      <img src="{{ asset('uploads/'.config('settings.shop_logo_footer')) }}" width="128">
                    </a>
                  </div>
              </div>
              
             
                {{ $slot }}
                {{ $subcopy ?? '' }}
              <footer id="footer" style="position: absolute;background: #0a51a1;bottom: 0; width: 100%;">
              <p style="position: relative;width: 100%;text-align: center;color: #fff;">
              Compratodo centro comercial digital <br>2021 Copyright © Todos los Derechos Reservado</p>              
            </footer>
            </div>
           
            
        </div>
    </body>
</html>