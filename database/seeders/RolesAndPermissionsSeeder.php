<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    

        // create permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);
        
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'read permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'create languages']);
        Permission::create(['name' => 'read languages']);
        Permission::create(['name' => 'update languages']);
        Permission::create(['name' => 'delete languages']);

        Permission::create(['name' => 'create plugins']);
        Permission::create(['name' => 'read plugins']);
        Permission::create(['name' => 'update plugins']);
        Permission::create(['name' => 'delete plugins']);
        
        Permission::create(['name' => 'read analytics']);

        Permission::create(['name' => 'read reports']);

        Permission::create(['name' => 'update settings']);

        
        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('read users');

        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['read users', 'update users']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
