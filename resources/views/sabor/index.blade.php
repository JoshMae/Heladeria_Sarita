@extends('layout')

@section('content')
    <h1>Lista de Sabores</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <a href="{{ route('sabor.create') }}">Crear Sabor</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Sabor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sabores as $sabor)
                <tr>
                    <td>{{ $sabor->idSabor }}</td>
                    <td>{{ $sabor->nombreSabor }}</td>
                    <td>
                        <a href="{{ route('sabor.edit', $sabor->idSabor) }}">Editar</a>
                        <form action="{{ route('sabor.destroy', $sabor->idSabor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
