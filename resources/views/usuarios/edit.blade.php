@extends('layout')
@section('title', 'Editar Usuario')
@section('content')
	<h3 class='mt-4 mb-3'>Editar Usuario</h3>
	<form id='form' action="{{ route('usuarios.update', $datos->id) }}" method='POST'>
		@csrf
		@method('PUT')
		<div class='row'>
			<div class='col-md-4'>
				<input type='text' name='nombre' class='form-control' placeholder='escriba nombre de usuario' value="{{ old('nombre', $datos->nombre) }}">
				@error('nombre')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
        <div class='row'>
			<div class='col-md-4'>
				<input type='text' name='telefono' class='form-control' placeholder='escriba el teléfono' value="{{ old('telefono', $datos->telefono) }}">
				@error('telefono')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<div class='row'>
			<div class='col-md-4'>
				<label><strong>Rol:</strong></label><br>
				<input type='radio' id='Admin' name='rol' value='1'>
				<label for='Admin'>Admin</label><br>
				<input type='radio' id='Vende' name='rol' value='2'>
				<label for='Vende'>Vende</label><br>
				<input type='radio' id='Compra' name='rol' value='3'>
				<label for='Compra'>Compra</label>
				@error('email')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<div class='row'>
			<div class='col-md-4'>
				<input type='email' name='email' class='form-control' placeholder='escriba el correo' value="{{ old('email', $datos->email) }}">
				@error('email')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<div class='row'>
			<div class='col-md-4'>
				<input type='password' name='password' class='form-control' placeholder='escriba la contraseña' value="">
				@error('password')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<button class='btn btn-success'>Actualizar</button>
		<a href="{{ url('usuarios') }}" class='btn btn-secondary'>Cancelar</a>
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
                telefono: {
                    required: true,
                    maxlength: 50
                },
				rol: {
					required: true
				},
				email: {
                    required: true,
                    maxlength: 100
                },
				password: {
                    required: true,
                    maxlength: 200
                }
			}
		});
	</script>
@stop()
