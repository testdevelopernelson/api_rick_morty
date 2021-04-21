<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyección de la simulación</title>
        <style>
        .projection-table{
             width: 100%;
             display: table;
             border-collapse: separate !important;
             border-spacing: 0;     
                padding: 8px;
         }

         .projection-table thead{
             border: none;
             width: 100%;
         }

         .projection-table thead tr th{
            text-align: center;
            line-height: 25px;
            border: 1px solid #989898;
            background-color: #d7d7d7;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 1.1rem;
         }
        .projection-table tbody tr:LAST-CHILD td:FIRST-CHILD {
            border-bottom-left-radius: 10px;

        }
        .projection-table tbody tr:LAST-CHILD td:LAST-CHILD {
            border-bottom-right-radius: 10px;
        }

         .projection-table thead tr td{
             text-align: center;
             line-height: 25px;
            border: 1px solid #989898;
            background-color: #d7d7d7;
            font-size: 1.1rem;
         }
        .projection-table tbody tr td{
            text-align: center;
            line-height: 25px;
            border: 1px solid #989898;
            font-size: 1rem;
            padding: 9px 0px;
         }
    </style>
    </head>
    <body>
        <a href="{{ url('/') }}" target="_blank" class="logo" >
            <img class="logo_img" src="{{ asset('uploads/' . $content_general->contents[1]->image_1) }}" alt="JFK">
        </a>
        <div class="contenido">
            <table class="projection-table">
                {!! $projection_html !!}
            </table>
        </div>
    </body>
</html>