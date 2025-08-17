@extends('layout')
@section('title', 'Nueva Categoría')
@section('content')
	<h3 class='mt-4 mb-3'>Nueva Categoría</h3>
	<form id='form' action="{{ url('categorias') }}" method='POST'>
		@csrf
		<div class='row'>
			<div class='col-md-4'>
				<input type='text' name='nombre' class='form-control' placeholder='escriba nombre de categoría' value="{{ old('nombre') }}">
				@error('nombre')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
        <div class='row'>
			<div class='col-md-4'>
				<input type='text' name='descripcion' class='form-control' placeholder='escriba descripción de categoría' value="{{ old('descripcion') }}">
				@error('descripcion')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<button class='btn btn-success'>Crear</button>
		<a href="{{ url('categorias') }}" class='btn btn-secondary'>Cancelar</a>
	</form>
@stop()
@section('js')
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="{{ url('js/jquery.validate.min.js') }}"></script>
	<script src="{{ url('js/localization/messages_es.min.js') }}"></script>
	<script>
		$("#form").validate({
			rules: {
				nombre: {
					required: true,
					maxlength: 50
				},
                descripcion: {
                    required: true,
                    maxlength: 200
                }
			}
		});
	</script>
@stop()
