<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit pages']);
        Permission::create(['name' => 'delete pages']);
        Permission::create(['name' => 'publish pages']);
        Permission::create(['name' => 'unpublish pages']);

        // create roles and assign created permissions

        // this can be done as separate statements
        Role::create(['name' => 'writer'])
            ->givePermissionTo('edit pages');

        // or may be done by chaining
        Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish pages', 'unpublish pages']);

        Role::create(['name' => 'administrator'])
            ->givePermissionTo(Permission::all());
    }
}
