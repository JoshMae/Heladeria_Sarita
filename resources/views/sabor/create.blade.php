@extends('layout')

@section('content')
    <h1>Crear Nuevo Sabor</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sabor.store') }}" method="POST">
        @csrf
        <label for="nombreSabor">Nombre del Sabor:</label>
        <input type="text" id="nombreSabor" name="nombreSabor" value="{{ old('nombreSabor') }}">
        <button type="submit">Guardar</button>
    </form>
@endsection
