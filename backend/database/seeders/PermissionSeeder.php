<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $roleAdmArea = Role::create(['name' => 'ADMINISTRADOR AREA']); 
        $roleEmpleado = Role::create(['name' => 'EMPLEADO']);
        
        //Permisos para el rol ADMINISTRADOR AREA
        $permiso = Permission::create(['name' => 'ASIGNAR EXPEDIENTES']);  
        $permiso->assignRole($roleAdmArea);
        $permiso = Permission::create(['name' => 'LISTAR EXPEDIENTES DE SU AREA']); 
        $permiso->assignRole($roleAdmArea);
        $permiso = Permission::create(['name' => 'LISTAR EXPEDIENTES (TODAS)']); 
        $permiso->assignRole($roleAdmArea);
        $permiso = Permission::create(['name' => 'REALIZAR PASES']); 
        $permiso->assignRole($roleAdmArea);   

        //Permisos para el rol EMPLEADO
        $permiso = Permission::create(['name' => 'VER EXPEDIENTE ASIGNADO']);  
        $permiso->assignRole($roleEmpleado);
        $permiso = Permission::create(['name' => 'REASIGNAR PASE']); 
        $permiso->assignRole($roleEmpleado);  

    }
}
