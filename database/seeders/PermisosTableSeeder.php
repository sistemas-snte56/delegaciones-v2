<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisos = [
            #tabla roles
            'rol.show',
            'rol.create',
            'rol.edit',
            'rol.destroy',

            #tabla regiones
            'region.show',
            'region.create',
            'region.edit',
            'region.destroy',
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
