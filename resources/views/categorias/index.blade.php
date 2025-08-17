@extends('layout')
@section('title', 'Categorias')
@section('content')
    <h3 class="mt-4">Listado de Categorías</h3>
    <div class="text-end">
        <a href="{{ url('categorias/create') }}" class="btn btn-primary">Nueva</a>
    </div>
    @if(session('type'))
        <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
            <strong>Noticia:</strong>{{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table">
        <thead>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($datos as $dato)
                <tr>
                    <td>{{ $dato->nombre }}</td>
                    <td>{{ $dato->descripcion }}</td>
                    <td>
                        <a href="{{ route('categorias.edit', $dato->id) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('categorias.destroy', $dato->id) }}" method='POST'>
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger" onclick="return confirm('¿Quiere eliminar el registro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach()
        </tbody>
    </table>
@stop()