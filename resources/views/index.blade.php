@extends('layouts.app')


@section('content')
    @if (Route::currentRouteName() == 'inicio')
        @include('partials.inicio')
    @elseif (Route::currentRouteName() == 'nosotros')
        @include('partials.nosotros')
    @elseif (Route::currentRouteName() == 'catalogo')
        @include('partials.catalogo')
    @elseif (Route::currentRouteName() == 'ubicacion')
        @include('partials.ubicacion')
    @endif
    
@endsection
