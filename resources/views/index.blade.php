@extends('layouts.app')


@section('content')

    @if (Route::currentRouteName() == 'inicio')
        @include('partials.inicio')
    @elseif (Route::currentRouteName() == 'nosotros')
        @include('partials.nosotros')
    @elseif (Route::currentRouteName() == 'catalogo2')
        @include('partials.catalogo2')
    @elseif (Route::currentRouteName() == 'ubicacion')
        @include('partials.ubicacion')
    @endif
    
@endsection
