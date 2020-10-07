<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Euax</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- Scripts -->
        @stack('scripts')
    </head>
    <body class="antialiased">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            @yield('breadcrumb')
        </ol>
    </nav>
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:pt-0">
            <div class="container p-6">
               @yield('content')
            </div>
        </div>
    </body>

</html>
