<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'     => 'Admin',
            'email'    => 'z3797ytf9p4h0uxs@email.partners',
            'phone'    => '+966500000000',
            'password' => bcrypt('12345678'),
        ]);

        $user->sallaConfigurations()->createMany([
            [
                'key'   => 'remoteIdentifier',
                'value' => '361367496'
            ],
            [
                'key'   => 'name',
                'value' => 'Ahmed Saber - Demo Store'
            ],
            [
                'key'   => 'avatar',
                'value' => 'https://cdn.salla.sa/BapEV/rqFcCm3L4z7nhruSE9WPsSucmoZN4hHyLKXBjLjb.png'
            ],
            [
                'key'   => 'store_location',
                'value' => '21.3825905096851,39.77319103068542'
            ],
            [
                'key'   => 'plan',
                'value' => 'pro'
            ],
            [
                'key'   => 'status',
                'value' => 'active'
            ],
            [
                'key'   => 'domain',
                'value' => 'https://salla.sa/dev-z3797ytf9p4h0uxs'
            ],
            [
                'key'   => 'tax_number',
                'value' => '555845422584758'
            ],
            [
                'key'   => 'created_at',
                'value' => '2022-07-31 16:08:48'
            ],
            [
                'key'   => 'token_type',
                'value' => 'oauth'
            ],
            [
                'key'   => 'access_token',
                'value' => 'ory_at_8mqq7gZTLIbS5Iy5HICIE1UxoiOCqkFNhxVKhEdLqNM.1QXO-POJw1cwfFoqNhATok31t4sF944-klXfHCsyz7E'
            ],
            [
                'key'   => 'refresh_token',
                'value' => 'ory_rt_2VB0TGb9SzrY0MeNQ35bBGr4cmb4Qp9QaK-KaF6HggE.H8SNLJONaJ8OTCRJHkBBZNzDqS6cTnodRlF3obfqN98'
            ],
            [
                'key'   => 'token_expired_at',
                'value' => '2023-09-18 10:24:57'
            ],
        ]);
    }
}
