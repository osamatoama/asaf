<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        $now = now();
        $permissions = [
            [
                'title'      => 'permission_create',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'permission_edit',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'permission_show',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'permission_delete',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'permission_access',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'role_create',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'role_edit',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'role_show',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'role_delete',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'role_access',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'user_create',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'user_edit',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'user_show',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'user_delete',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'user_access',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'audit_log_show',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'audit_log_access',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'product_create',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'product_edit',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'product_show',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'product_delete',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'product_access',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'quiz_edit',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'quiz_show',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'quiz_access',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'gender_show',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'gender_access',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'client_show',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'client_access',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title'      => 'profile_password_edit',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        Permission::insert($permissions);
    }
}
