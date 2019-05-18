<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-api" content="{{ config('app.api') }}">

    <title>Camino - Senda Renting</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link  href="{{ asset('css/app.css') }}" rel="stylesheet"  media="screen" />
    <link  href="{{ asset('css/print.css') }}" rel="stylesheet"  media="print" />
   
</head>
    <body>
        <div id="app">
            <div class="w-100 d-none d-print-block p-4" >
                <div class="d-flex justify-content-between align-items-center">
                    <img src="./img/print_logo.png" class="img-fluid">
                    <img src="./img/print_datos.png" class="img-fluid">
                </div>
            </div>

            @yield('content')

            <div class="w-100 d-none d-print-block p-3" >
                <hr>
                <div class="d-flex justify-content-between align-items-center small text-muted">
                    <time>{{ \Carbon\Carbon::now() }}</time>
                    <em>Senda Renting v2.0 - Desarrollo Pablo Lizardo</em>
                </div>
            </div>
            
        </div>
    <script src="{{ asset('js/app.js') }}"></script> 
    <script>
    $(function () {
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
        });
</script>
    </body>
</html>
