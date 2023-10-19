{{-- puxa o layout --}}
@extends('layouts.main')
{{-- cria um título para essa página --}}
@section('tittle', 'Produtos')

{{-- início conteúdo do site --}}
@section('content')
    <h1>Página de Produtos</h1>
    
    @if ($busca != '')
        <p>O usuário está buscando por: {{ $busca }}</p>
    @endif
    
    <a href="/">Voltar para home</a>
@endsection
{{-- fim conteúdo do site --}}