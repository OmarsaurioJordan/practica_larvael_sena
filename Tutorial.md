# Tutorial

## Crear un proyecto

- [ composer create-project laravel/laravel nombreProyecto ]

- archivo .env para configurar la DB, usar connection mysql

- ejecutar servidor [ php artisan serv ] además de XAMPP para la DB

## Crear nuevo CRUD

- crear migración:
[ php artisan make:migration create_categorias_table ]
ej: tabla categorias, siempre en plural

- estructura migración:
en [ nombreProyecto/database/migrations ] está [ fecha_create_categorias_table.php ]
en [ Schema::create ] entre id() y timestamps() poner atributos, ej: $table->string('nombre', length:50);

- migrar:
[ php artisan migrate ]

- crear modelo:
[ php artisan make:model Categoria ]
ej: tabla categoria, siempre en singular e inicial mayúscula

- estructura modelo:
en [ nombreProyecto/app/Models ] está [ Categoria.php ]
se agregará: public $fillable = ['nombre', 'descripcion'];

- crear controlador:
[  php artisan make:controller CategoriaController ]
ej: tabla Categoria seuida de Controller pagadito

- estructura controlador:
en [ nombreProyecto/app/Http/Controllers ] está [ CategoriaController.php ]

## Direcciónes

[ nombreProyecto/routes/web.php ] tiene el archivo de rutas

- agregamos: use App\Http\Controllers\CategoriaController
para poder acceder al controlador de Categoria

- agregar: Route::resource('categorias', CategoriaController::class);
para poder acceder al controlador de Categoria

pag 7