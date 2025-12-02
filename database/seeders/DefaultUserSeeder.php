<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'super@gmail.com',
            'password' => Hash::make('Super12345')
        ]);
        // Assign Role Menjadi Super Admin
        $superAdmin->assignRole('Super Admin');

        // Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin12345')
        ]);
        // Assign Role Menjadi Admin
        $admin->assignRole('Admin');

        // Petugas
        $petugas = User::create([
            'name' => 'Mamang Dredet',
            'email' => 'pm@gmail.com',
            'password' => Hash::make('User12345')
        ]);
        // Assign Role Menjadi Petugas
        $petugas->assignRole('Petugas');

        // User
        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('User12345')
        ]);
        // Assign Role Menjadii User
        $user->assignRole('User');
    }
}
