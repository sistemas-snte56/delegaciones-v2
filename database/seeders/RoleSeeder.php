<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Admin => all
         * Manager => ver listado de usuarios y ver usuarios
         * Developer => dashboard
         */
        $admin = Role::create(['name'=>'Admin']); // Administrador
        $manager = Role::create(['name'=>'Manager']); // Coordinador Regional
        $manager = Role::create(['name'=>'Coordinator']); // Coordinador Regional
        $developer = Role::create(['name'=>'Developer']);

        #Creación de permisos para users
        Permission::create(['name'=>'dashboard'])->syncRoles([$admin,$manager,$developer]);
        Permission::create(['name'=>'user.index'])->syncRoles([$admin,$manager]);
        Permission::create(['name'=>'user.show'])->syncRoles([$admin,$manager]);
        Permission::create(['name'=>'user.create'])->assignRole([$admin]);
        Permission::create(['name'=>'user.store'])->assignRole([$admin]);
        Permission::create(['name'=>'user.edit'])->assignRole([$admin]);
        Permission::create(['name'=>'user.update'])->assignRole([$admin]);
        Permission::create(['name'=>'user.destroy'])->assignRole([$admin]);

        #Creación de permisos para regiones
        Permission::create(['name'=>'region.index'])->syncRoles([$admin,$manager]);
        Permission::create(['name'=>'region.show'])->assignRole([$admin]);
        Permission::create(['name'=>'region.create'])->assignRole([$admin]);
        Permission::create(['name'=>'region.store'])->assignRole([$admin]);
        Permission::create(['name'=>'region.edit'])->assignRole([$admin]);
        Permission::create(['name'=>'region.update'])->assignRole([$admin]);
        Permission::create(['name'=>'region.destroy'])->assignRole([$admin]);
    }
}
