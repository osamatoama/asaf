<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExtraPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'title' => 'report_access',
            ],
        ];

        $role = Role::first();

        foreach ($permissions as $permission) {
            $permissionModel = Permission::firstOrCreate($permission, []);
            $role->permissions()->attach($permissionModel->id);
        }
    }
}
