<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accion;

class AccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Accion::create([
            'nombre' => 'ver_usuarios',
            'url' => 'usuarios',
            'modulo' => 'Usuarios'
        ]);
        Accion::create([
            'nombre' => 'crear_usuarios',
            'url' => 'usuarios/create',
            'modulo' => 'Usuarios'
        ]);
        Accion::create([
            'nombre' => 'editar_usuarios',
            'url' => 'usuarios/edit',
            'modulo' => 'Usuarios'
        ]);
        Accion::create([
            'nombre' => 'eliminar_usuarios',
            'url' => 'usuarios/id',
            'modulo' => 'Usuarios'
        ]);
        Accion::create([
            'nombre' => 'ver_detalle_usuarios',
            'url' => 'usuarios/id',
            'modulo' => 'Usuarios'
        ]);

        Accion::create([
            'nombre' => 'ver_roles',
            'url' => 'rols',
            'modulo' => 'Rols'
        ]);
        Accion::create([
            'nombre' => 'crear_roles',
            'url' => 'rols/create',
            'modulo' => 'Rols'
        ]);
        Accion::create([
            'nombre' => 'editar_roles',
            'url' => 'rols/edit',
            'modulo' => 'Rols'
        ]);
        Accion::create([
            'nombre' => 'eliminar_roles',
            'url' => 'rols/id',
            'modulo' => 'Rols'
        ]);
        Accion::create([
            'nombre' => 'ver_detalle_roles',
            'url' => 'rols/id',
            'modulo' => 'Rols'
        ]);

        Accion::create([
            'nombre' => 'ver_categorias',
            'url' => 'categorias',
            'modulo' => 'Categorias'
        ]);
        Accion::create([
            'nombre' => 'crear_categorias',
            'url' => 'categorias/create',
            'modulo' => 'Categorias'
        ]);
        Accion::create([
            'nombre' => 'editar_categorias',
            'url' => 'categorias/edit',
            'modulo' => 'Categorias'
        ]);
        Accion::create([
            'nombre' => 'eliminar_categorias',
            'url' => 'categorias/id',
            'modulo' => 'Categorias'
        ]);
        Accion::create([
            'nombre' => 'ver_detalle_categorias',
            'url' => 'categorias/id',
            'modulo' => 'Categorias'
        ]);
    }
}
