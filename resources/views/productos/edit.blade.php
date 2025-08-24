@extends('layout')
@section('title', 'Editar Producto')
@section('content')
	<h3 class='mt-4 mb-3'>Editar Producto</h3>
	<form id='form' action="{{ route('productos.update', $datos->id) }}" method='POST'>
		@csrf
		@method('PUT')
		<div class='row'>
			<div class='col-md-4'>
				<input type='text' name='nombre' class='form-control' placeholder='escriba nombre de producto' value="{{ old('nombre', $datos->nombre) }}">
				@error('nombre')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<div class='row'>
			<div class='col-md-4'>
				<input type='text' name='descripcion' class='form-control' placeholder='escriba alguna descrición si lo desea' value="{{ old('descripcion', $datos->descripcion) }}">
				@error('descripcion')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<div class='row'>
			<div class='col-md-4'>
				<input type='url' name='foto' class='form-control' placeholder='pegue link a una imágen si lo desea' value="{{ old('foto', $datos->foto) }}">
				@error('foto')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<div class='row'>
			<div class='col-md-4'>
				<input type='number' name='precio' class='form-control' placeholder='digite el precio' value="{{ old('precio', $datos->precio) }}">
				@error('precio')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<div class='row'>
			<div class='col-md-4'>
				<input type='number' name='cantidad' class='form-control' placeholder='digite la cantidad' value="{{ old('cantidad', $datos->cantidad) }}">
				@error('cantidad')
					<div class='error compacto col-lg-5'>{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4">
				<label><strong>Categoría:</strong></label>
				<select name="categoria_id" class="form-control">
					<option value="">-- Seleccione categoría --</option>
					@foreach($categorias as $categoria)
						<option value="{{ $categoria->id }}" <?php echo (old('categoria_id', $datos->categoria_id) == $categoria->id ? 'selected' : ''); ?>>
							{{ $categoria->nombre }}
						</option>
					@endforeach
				</select>
				@error('categoria_id')
					<div class="error compacto col-lg-5">{{ $message }}</div>
				@enderror
			</div>
		</div>
		<br>
		<button class='btn btn-success'>Actualizar</button>
		<a href="{{ url('productos') }}" class='btn btn-secondary'>Cancelar</a>
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
                    maxlength: 200
                },
				foto: {
                    maxlength: 200
                },
				precio: {
					required: true,
					number: true,
					min: 0,
					max: 999999.99,
					step: 0.01
				},
				cantidad: {
					required: true,
					digits: true,
					min: 0,
					max: 1000000
				},
				categoria_id: {
					required: true
				}
			}
		});
	</script>
@stop()
