<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- para mudar o tittle dinâmicamente --}}
        <title>@yield('tittle')</title>

        {{-- Fontes do Google --}}
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        {{-- CSS Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        {{-- chamar o css --}}
        <link rel="stylesheet" href="/css/styles.css">
        {{-- chamar o js --}}
        <script src="/js/scripts.js"></script>
    </head>
    <body>
        {{-- muda o conteúdo da página dinâmicamente --}}
        @yield('content')
        
        <footer>
            <p>HDC Events &copy; 2023</p>
        </footer>
    </body>
</html>
