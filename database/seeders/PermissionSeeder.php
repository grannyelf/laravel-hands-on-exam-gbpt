<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    protected array $defaultPermissions = [
        'can-create',
        'can-view',
        'can-update',
        'can-delete',
        'can-view-any',

        'can-create-task',
        'can-update-task',
        'can-delete-task',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->defaultPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);

        }
    }
}
