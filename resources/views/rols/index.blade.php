@extends('layout')
@section('title', 'Roles')
@section('content')
    <h3 class="mt-4">Listado de Roles</h3>
    <div class="text-end">
        <a href="{{ url('rols/create') }}" class="btn btn-primary">Nuevo</a>
    </div>
    @if(session('type'))
        <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
            <strong>Noticia: </strong>{{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table">
        <thead>
            <th>Nombre</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($datos as $dato)
                <tr>
                    <td>{{ $dato->nombre }}</td>
                    <td>
                        <a href="{{ route('rols.edit', $dato->id) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('rols.destroy', $dato->id) }}" method='POST'>
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