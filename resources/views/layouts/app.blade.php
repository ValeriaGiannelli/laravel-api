<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
        {{-- qui ci andrà la nav bar --}}
        @include('admin/partials/header')
    <div class="contant-fluid d-flex my_view">

        {{-- solo se è autentificato mostra la barra laterale --}}
        @auth
            {{-- qui la side bar --}}
            @include('admin.partials.sidebar')

        @endauth

        {{-- qui il contenuto che cambierà a seconda della sezione visualizzata --}}
        <div class="content">
            @yield('content')
        </div>

    </div>

    </div>
</body>

</html>
