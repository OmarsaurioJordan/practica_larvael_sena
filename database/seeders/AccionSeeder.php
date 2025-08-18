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
    }
}
