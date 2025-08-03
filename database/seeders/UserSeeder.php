<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $users = [
            [
                'name'           => 'admin',
                'email'          => 'admin@admin.com',
                'password'       => '12345678',
                'role'           => 'admin',
                'terms_accepted' => true,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name'           => 'trade',
                'email'          => 'trade@trade.com',
                'password'       => '12345678',
                'role'           => 'trade',
                'terms_accepted' => true,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name'           => 'pro',
                'email'          => 'pro@pro.com',
                'password'       => '12345678',
                'role'           => 'pro',
                'terms_accepted' => true,
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name'           => $user['name'],
                'email'          => $user['email'],
                'password'       => Hash::make($user['password']),
                'role'           => $user['role'],
                'terms_accepted' => $user['terms_accepted'],
                'email_verified_at' => $user['email_verified_at'],
            ]);
        }
    }
}
