@extends('layout')

@section('content')
    <h1>Editar Sabor</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sabor.update', $sabor->idSabor) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nombreSabor">Nombre del Sabor:</label>
        <input type="text" id="nombreSabor" name="nombreSabor" value="{{ $sabor->nombreSabor }}">
        <button type="submit">Actualizar</button>
    </form>
@endsection
