<?php

namespace Database\Seeders;

use App\Models\Spatie\Permission;
use Illuminate\Database\Seeder;

class CompaniesModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionName = 'companies';
        $showName = "Companías";

        Permission::create(['name' => "{$permissionName}.view", 'show_name' => "Ver {$showName}", 'guard_name' => 'api']);
        Permission::create(['name' => "{$permissionName}.create", 'show_name' => "Crear {$showName}", 'guard_name' => 'api']);
        Permission::create(['name' => "{$permissionName}.edit", 'show_name' => "Editar {$showName}", 'guard_name' => 'api']);
        Permission::create(['name' => "{$permissionName}.delete", 'show_name' => "Eliminar {$showName}", 'guard_name' => 'api']);
    }
}
