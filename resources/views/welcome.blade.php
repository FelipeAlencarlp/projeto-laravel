<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel|Projeto</title>

        {{-- chamar o css --}}
        <link rel="stylesheet" href="/css/styles.css">
        {{-- chamar o js --}}
        <script src="/js/scripts.js"></script>
    </head>
    <body>
        <header>
            <h1>Aqui tem um título</h1>
            <img src="/img/banner.jpg" alt="Banner">
        </header>
        <main>
            <section>
                {{-- {{ }} é para chamar uma variável php dentro do blade --}}
                <p>{{ $nome }}</p>

                @if($nome == 'Pedro')
                    <p>Nome é Pedro</p>
                @elseif($nome == 'Felipe')
                    <p>O nome é {{ $nome }} e ele tem {{ $idade }} anos, e trabalha como {{ $profissao }}</p>
                @else
                    <p>O nome não é Pedro</p>
                @endif

                {{-- posso definir uma estrutura for dentro do blade --}}
                @for($i = 0; $i < count($arr); $i++)
                    <p>{{ $arr[$i] }} - {{ $i }}</p>
                    @if($i == 2)
                        <p>O i é 2</p>
                    @endif
                @endfor

                {{-- posso definir uma estrutura foreach --}}
                @foreach($nomes as $nome)
                    {{-- o $loop é do próprio blade, serve para acessar o indice de cada array --}}
                    <p>{{ $loop->index }}</p>
                    <p>{{ $nome }}</p>
                @endforeach

                {{-- posso definir um php dentro do blade --}}
                @php
                    $name = 'João';
                    echo $name;
                @endphp


            </section>
        </main>
    </body>
</html>
