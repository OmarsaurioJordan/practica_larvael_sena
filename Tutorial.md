## Tutorial

# Crear nuevo CRUD

- crear migración:
[php artisan make:migration create_categorias_table]
ej: tabla categorias, siempre en plural

- estructura migración:
en nombreProyecto/database/migrations está fecha_create_categorias_table.php
en Schema::create entre id() y timestamps() poner atributos, ej: $table->string('nombre', length:50);

- migrar:
[php artisan migrate]
