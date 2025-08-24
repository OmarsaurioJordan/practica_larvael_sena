<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Accion;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accions = Accion::all();
        $premisos = "";
        foreach ($accions as $accion) {
            $premisos .= $accion->nombre . ",";
        }
        Usuario::create([
            'nombre' => 'Admin',
            'telefono' => '666',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'rol_id' => '1',
            'permisos' => rtrim($permisos, ',')
        ]);
    }
}
