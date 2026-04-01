<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $owner = Role::firstOrCreate(['name' => 'owner']);
        $employee = Role::firstOrCreate(['name' => 'employee']);

        // get all permissions
        $permissions = Permission::all();

        // admin gets everything
        $admin->syncPermissions($permissions);

        // limited permissions
        $owner->syncPermissions([
            'can-create',
            'can-view',
        ]);

        $employee->syncPermissions([
            'can-view',
        ]);
    }
}
