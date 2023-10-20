{{-- puxa o layout --}}
@extends('layouts.main')
{{-- cria um título para essa página --}}
@section('tittle', 'HDC Events')

{{-- início conteúdo do site --}}
@section('content')
    
    @foreach ($events as $event)
        <p>{{ $event->title }} -- {{ $event->description }}</p>
    @endforeach

@endsection
{{-- fim conteúdo do site --}}

