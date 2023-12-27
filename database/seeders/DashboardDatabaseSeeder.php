<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DashboardDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,
        ]);

        $admin = User::whereNull('parent_id')->first();

        if (filled($admin)) {
            $admin->update([
                'name'     => 'Quiz Administration',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('12345678'),
                'verified' => true,
                'active'   => true,
            ]);
        }
    }
}
