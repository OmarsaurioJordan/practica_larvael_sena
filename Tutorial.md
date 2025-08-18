# Tutorial Larabel

## Crear un proyecto

- crear proyecto (tener instalado composer):
ubicar la línea de comandos en la carpeta donde se creará el proyecto y ejecutar `composer create-project laravel/laravel nombreProyecto`

- archivo `.env` para configurar la DB, usar connection `mysql`

- ejecutar servidor `php artisan serv` además de XAMPP activo para la DB

- en `nombreProyecto/resources/views` crear `index.blade.php` tendrá la página principal una vez el usuario esté logeado

- crear `layout.blade.php` que es el blade que hace de esquema básico para ser heredado por otras views, ahí dentro se suelen poner links de navegación del sitio así:
```
<a href="{{ url('/') }}">Inicio</a>
@if (Auth::user())
    // dentro del if lo que solo se ve si se hizo login
    <a href="{{ url('categorias') }}">Categorías</a>
@endif
```

- `welcome.blade.php` es la página de inicio por defecto de larabel

- `nombreProyecto/routes/web.php` tiene el archivo de rutas
ahí revisamos que la ruta `'/'` raíz apunte al `index`

- https://jqueryvalidation.org/ en Download buscamos `SourceCode.zip`, lo descomprimimos y dentro en `dist` está `jquery.validate.min.js` lo copiamos en `nombreProyecto/public/js` y luego copiamos `messages_es.min` en `nombreProyecto/public/js/localization`

- Nota: el archivo server.php a veces es borrado por los antivirus.

## Crear nuevo CRUD

Resumen:

- agregar pestaña de selección (botón) en la vista: layout

- crear la migración

- crear el modelo

- crear el controlador

- crear carpeta de vistas con: index, new, edit

- agregar rutas al archivo de direcciónes web.

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
public function edit(string $id) {
    $datos = Categoria::find($id);
    return view('categorias.edit', compact('datos'));
}
public function update(Request $request, Categoria $categoria) {
    $validator = Validator::make($request->all(), [
        'nombre' => 'required|max:50',
        'descripcion' => 'required|max:200'
    ]);
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
    else {
        $categoria->update($request->all());
        return redirect('categorias')->with('type', 'warning')->with('message', 'Categoría actualizada exitosamente');
    }
}
public function destroy(string $id) {
    Categoria::destroy($id);
    return redirect('categorias')->with('type', 'danger')->with('message', 'El registro se eliminó');
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
    <a href="{{ route('categorias.edit', $dato->id) }}">Editar</a>
    <form action="{{ route('categorias.destroy', $dato->id) }}" method='POST'>
        @csrf
        @method("DELETE")
        <button onclick="return confirm('¿Eliminar?')">Eliminar</button>
    </form>
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
<form id='form' action="{{ route('categorias.update', $datos->id) }}" method='POST'>
    @csrf
    @method('PUT')
    <div>
        <input type='text' name='nombre' placeholder='...' value="{{ old('nombre', $datos->nombre) }}">
        @error('nombre')
            <div>{{ $message }}</div>
        @enderror
    </div>
    ... lo mismo para descripcion
    <button>Actualizar</button>
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

### Direcciónes

- `nombreProyecto/routes/web.php` tiene el archivo de rutas

- agregamos: `use App\Http\Controllers\CategoriaController` para poder acceder al controlador de Categoria

- agregar `Route::resource('categorias', CategoriaController::class);` para poder acceder al controlador de Categoria y redirigir las vistas

### Caso para CRUD de Usuarios y Login

- el modelo debe tener unas cosas extra:
```
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;
class Usuario extends Authenticatable {
    use HasFactory, Notifiable;
    public $fillable = ['nombre', ... ];
}
```

- la migración debe contener: `$table->string('email', length:100)->unique();` y `$table->rememberToken();` va de penúltima antes de `timestamps` tener en cuenta que se requiere `email` y `password` para hacer login en Laravel, así en inglés

- en el controlador hay que usar las importaciónes:
```
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;
use Auth;
use Hash;
```

- en el controlador pondremos password con hash, esto en la función store y update:
```
$datos = $request->all();
$datos['password'] = hash::make($datos['password']);
Usuario::create($datos);
```

- agregamos `<a href="{{ url('logout') }}">Salir</a>` a la vista `layout.blade.php` para poder salir de la sesión

- en la carpeta `views` crear el `login.blade.index` con su formulario que pide email y password, no utiliza la herencia de `layout` enviará su contenido así: `<form action="Check" method="POST">`

- en direcciónes `web.php` creamos una ruta `Route::post('Check', [UsiarioController::class, 'check']);` es de tipo post, se alcanza mediante la string `Check` y dispara la función `check` del controlador `UsuarioController`

- en el controlador debemos poner:
```
public function check(Request $request) {
    if (Auth::attempt($request->only('email', 'password'))) {
        return redirect()->intended('home');
    }
    return redirect('login')->with('type', 'danger')->with('message', 'Usuario o contraseña incorrectos');
}
```

- en direcciónes web debemos poner la nueva ruta llamada `home`:
```
Route::get('home', function () {
    return view('index');
});
```

- para redireccionar rutas cuando hay o no login (prohibir rutas) se usan los Middleware, que están en `nombreProyecto/bootstrap\app.php` se pueden crear nuevos pero Laravel trae unos por defecto

- vamos a las direcciónes web, debe quedar algo así:
```
// rutas no protegidas por login
Route::get('/', function () {
    if (Auth::check()) {
        return view('index');
    }
    else {
        return view('login');
    }
});
Route::get('login', function () { return view('login'); })->name('login');
Route::post('Check', [UsuarioController::class, 'check']);
Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
});
Route::middleware(['auth'])->group(function () {
    // rutas protegidas por login
    Route::get('home', function () { return view('index'); });
    Route::resource('categorias', CategoriaController::class);
    Route::resource('usuarios', UsuarioController::class);
});
```

- debemos indicarle en `nombreProyecto/config/auth.php` que el modelo usado para autenticación es `Usuario` y no `User` (por defecto), buscar `AUTH_MODEL`
