<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionRoleTableSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::first();

        if (blank($role)) {
            $this->call(RoleTableSeeder::class);
        }

        $permissions = Permission::pluck('id');

        if (blank($permissions)) {
            $this->call(PermissionTableSeeder::class);
        }


        Schema::disableForeignKeyConstraints();
        PermissionRole::truncate();
        Schema::enableForeignKeyConstraints();


        $role->permissions()->sync($permissions);
    }
}
