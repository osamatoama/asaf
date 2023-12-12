<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        $permissions = [
            [
                'title' => 'permission_create',
            ],
            [
                'title' => 'permission_edit',
            ],
            [
                'title' => 'permission_show',
            ],
            [
                'title' => 'permission_delete',
            ],
            [
                'title' => 'permission_access',
            ],
            [
                'title' => 'role_create',
            ],
            [
                'title' => 'role_edit',
            ],
            [
                'title' => 'role_show',
            ],
            [
                'title' => 'role_delete',
            ],
            [
                'title' => 'role_access',
            ],
            [
                'title' => 'user_create',
            ],
            [
                'title' => 'user_edit',
            ],
            [
                'title' => 'user_show',
            ],
            [
                'title' => 'user_delete',
            ],
            [
                'title' => 'user_access',
            ],
            [
                'title' => 'audit_log_show',
            ],
            [
                'title' => 'audit_log_access',
            ],
            [
                'title' => 'product_create',
            ],
            [
                'title' => 'product_edit',
            ],
            [
                'title' => 'product_show',
            ],
            [
                'title' => 'product_delete',
            ],
            [
                'title' => 'product_access',
            ],
            [
                'title' => 'quiz_edit',
            ],
            [
                'title' => 'quiz_show',
            ],
            [
                'title' => 'quiz_access',
            ],
            [
                'title' => 'gender_show',
            ],
            [
                'title' => 'gender_access',
            ],
            [
                'title' => 'client_show',
            ],
            [
                'title' => 'client_access',
            ],
            [
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
