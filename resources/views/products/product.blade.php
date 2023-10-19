{{-- puxa o layout --}}
@extends('layouts.main')
{{-- cria um título para essa página --}}
@section('tittle', 'Produto')

{{-- início conteúdo do site --}}
@section('content')

    @if ($id != null)
        <p>Exibindo produto id: {{ $id }}</p>
    @endif

@endsection
{{-- fim conteúdo do site --}}