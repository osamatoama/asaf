<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();

        if (blank($user)) {
            $this->call(UserTableSeeder::class);
        }

        $superAdminRole = Role::where('slug', 'admin')->first();

        if (blank($superAdminRole)) {
            $this->call(RoleTableSeeder::class);
        }

        $user->roles()->sync($superAdminRole->id);
    }
}
