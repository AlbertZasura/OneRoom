<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->fill([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '123456789',
            'identification_number' => "12345678",
            'role' => 0,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->save();

        $user = new User();
        $user->fill([
            'name' => 'Teacher',
            'email' => 'teacher@example.com',
            'phone' => '1234567890',
            'identification_number' => "12345678",
            'role' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->save();
        $user = new User();
        $user->fill([
            'name' => 'Siswa',
            'email' => 'siswa@example.com',
            'phone' => '12345678901',
            'identification_number' => "12345678",
            'status' => 1,
            'role' => 2,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->save();
    }
}
