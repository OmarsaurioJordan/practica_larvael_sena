@extends('layout')
@section('title', 'Productos')
@section('content')
    <h3 class="mt-4">Listado de Productos</h3>
    <div class="text-end">
        <a href="{{ url('productos/create') }}" class="btn btn-primary">Nuevo</a>
    </div>
    @if(session('type'))
        <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
            <strong>Noticia: </strong>{{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table">
        <thead>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($datos as $dato)
                <tr>
                    <td><img src="{{ $dato->foto }}" alt="Foto" width="100" height="100"></td>
                    <td>{{ $dato->nombre }}</td>
                    <td>{{ substr($dato->descripcion, 0, min(20, strlen($dato->descripcion))) }}</td>
                    <td>$ {{ $dato->precio }}</td>
                    <td>{{ $dato->cantidad }}</td>
                    <td>{{ $dato->categoria->nombre }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $dato->id) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('productos.destroy', $dato->id) }}" method='POST'>
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