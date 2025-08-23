<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permiso;
use App\Models\Accion;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accions = Accion::all();
        foreach ($accions as $accion) {
            Permiso::create([
                'rol_id' => 1,
                'accion_id' => $accion->id,
            ]);
        }
    }
}
