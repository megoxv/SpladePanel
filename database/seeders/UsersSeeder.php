<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => "Admin",
            'username' => "admin",
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);

        $user->syncRoles('super-admin');
    }
}
