# Tutorial Larabel

## Crear un proyecto

- crear proyecto (tener instalado composer):
ubicar la línea de comandos en la carpeta donde se creará el proyecto y ejecutar `composer create-project laravel/laravel nombreProyecto`

- archivo `.env` para configurar la DB, usar connection `mysql`

- ejecutar servidor `php artisan serv` además de XAMPP activo para la DB

- en `nombreProyecto/resources/views` crear `index.blade.php` tendrá la página principal una vez el usuario esté logeado

- crear `layout.blade.php` que es el blade que hace de esquema básico para ser heredado por otras views

- `welcome.blade.php` es la página de inicio por defecto de larabel

- `nombreProyecto/routes/web.php` tiene el archivo de rutas
ahí revisamos que la ruta `'/'` raíz apunte al `index`

- https://jqueryvalidation.org/ en Download buscamos `SourceCode.zip`, lo descomprimimos y dentro en `dist` está `jquery.validate.min.js` lo copiamos en `nombreProyecto/public/js` y luego copiamos `messages_es.min` en `nombreProyecto/public/js/localization`

## Crear nuevo CRUD

### Migración

- crear migración:
`php artisan make:migration create_categorias_table`
ej: tabla categorias, siempre en plural

- estructura migración:
en `nombreProyecto/database/migrations` está `fecha_create_categorias_table.php`

- ahí, en `Schema::create` entre `id()` y `timestamps()` poner atributos, ej: `$table->string('nombre', length:50);`

- migrar:
`php artisan migrate`

### Modelo

- crear modelo:
`php artisan make:model Categoria`
ej: tabla categoria, siempre en singular e inicial mayúscula

- estructura modelo:
en `nombreProyecto/app/Models` está `Categoria.php`, se agregará:
`public $fillable = ['nombre', 'descripcion'];` lo que indica los atributos que serán manipulables por CRUD

### Controlador

- crear controlador:
`php artisan make:controller CategoriaController`
ej: tabla Categoria seguida de Controller pagadito

- estructura controlador:
en `nombreProyecto/app/Http/Controllers` está `CategoriaController.php`
colocar en las importaciónes:
```
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categoria;
```

colocamos los códigos según qué acciónes hará el controlador
```
public function index() {
    $datos = Categoria::all();
    return view('categorias.index', compact('datos'));
}
public function create() {
    return view('categorias.new');
}
public function store(Request $request) {
    $validator = Validator::make($request->all(), [
        'nombre' => 'required|max:50',
        'descripcion' => 'required|max:200'
    ]);
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    else {
        Categoria::create($request->all());
        return redirect('categorias')->with('type', 'success')->with('message', 'Categoría creada exitosamente');
    }
}
```

### Vistas

- crear vistas:
en `nombreProyecto/resources/views/categorias` notar que hay una carpeta llamada como la tabla, categorias

- ahí dentro van `index.blade.php` para mostrar la tabla e ir a crear un registro, editar un registro y eliminar un registro:
```
<a href="{{ url('categorias/create') }}">Nuevo</a>
@if(session('type'))
    <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
        <strong>Noticia:</strong>{{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@foreach($datos as $dato)
    <p>{{ $dato->nombre }}</p>
@endforeach()
```

- `new.blade.php` para crear un nuevo registro:
```
<form id='form' action="{{ url('categorias') }}" method='POST'>
    @csrf
    <div>
        <input type='text' name='nombre' placeholder='...' value="{{ old('nombre') }}">
        @error('nombre')
            <div>{{ $message }}</div>
        @enderror
    </div>
    ... lo mismo para descripcion
    <button>Crear</button>
    <a href="{{ url('categorias') }}">Cancelar</a>
</form>
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
            ... lo mismo para descripcion
        }
    });
</script>
```

- `edit.blade.php` para editar un registro:
```
```

### Direcciónes

- `nombreProyecto/routes/web.php` tiene el archivo de rutas

- agregamos: `use App\Http\Controllers\CategoriaController` para poder acceder al controlador de Categoria

- agregar `Route::resource('categorias', CategoriaController::class);` para poder acceder al controlador de Categoria y redirigir las vistas










quedé en EDIT|categorías pag 15