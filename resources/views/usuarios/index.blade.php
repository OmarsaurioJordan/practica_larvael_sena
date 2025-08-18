@extends('layout')
@section('title', 'Usuarios')
@section('content')
    <h3 class="mt-4">Listado de Usuarios</h3>
    <div class="text-end">
        <a href="{{ url('usuarios/create') }}" class="btn btn-primary">Nuevo</a>
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
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Correo</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($datos as $dato)
                <tr>
                    <td>{{ $dato->nombre }}</td>
                    <td>{{ $dato->telefono }}</td>
                    <td>{{ $dato->rol }}</td>
                    <td>{{ $dato->email }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $dato->id) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('usuarios.destroy', $dato->id) }}" method='POST'>
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