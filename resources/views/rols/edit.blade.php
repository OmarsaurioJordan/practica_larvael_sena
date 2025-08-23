@extends('layout')
@section('title', 'Editar Rol')
@section('content')
	<h3 class='mt-4 mb-3'>Editar Rol</h3>
	<form id='form' action="{{ route('rols.update', $datos->id) }}" method='POST'>
		@csrf
		@method('PUT')
		<div class='row'>
			<div class='col-md-4'>
				<input type='text' name='nombre' class='form-control' placeholder='escriba nombre de rol' value="{{ old('nombre', $datos->nombre) }}">
				@error('nombre')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<div class="form-group">
			<label><strong>Acciones:</strong></label><br>
			@foreach($accions as $accion)
				<div class="form-check">
					<input type="checkbox" name="accions[]" value="{{ $accion->id }}" id="act{{ $accion->id }}" class="form-check-input" <?php echo (in_array($accion->id, $datos->permisos->pluck('accion_id')->toArray()) ? 'checked' : ''); ?>>
					<label for="act{{ $accion->id }}" class="form-check-label">
						{{ $accion->nombre }}
					</label>
				</div>
			@endforeach
		</div>
		<br>
		<button class='btn btn-success'>Actualizar</button>
		<a href="{{ url('rols') }}" class='btn btn-secondary'>Cancelar</a>
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
				}
			}
		});
	</script>
@stop()
