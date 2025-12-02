<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Role
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $petugas = Role::create(['name' => 'Petugas']);
        $user = Role::create(['name' => 'User']);

        // Give Permission Admin
        $admin->givePermissionTo([
            // Barang
            'view-barang',
            'create-barang',
            'edit-barang',
            'delete-barang',

            // Kategori
            'view-kategori',
            'create-kategori',
            'edit-kategori',
            'delete-kategori',

            // User
            'view-user',
            'create-user',
            'edit-user',
            'delete-user',

            // Peminjaman
            'view-peminjaman',
            'create-peminjaman',
            'edit-peminjaman',
            'delete-peminjaman',
        ]);

        // Give Permission Product Manager
        $petugas->givePermissionTo([
            // Barang
            'view-barang',
            'create-barang',
            'edit-barang',
            'delete-barang',

            // Kategori
            'view-kategori',
            'create-kategori',
            'edit-kategori',
            'delete-kategori',

            // Peminjaman
            'view-peminjaman',
            'create-peminjaman',
            'edit-peminjaman',
            'delete-peminjaman',
        ]);

        // Give Permission Users
        $user->givePermissionTo([
            // barang
            'view-barang'
            ,
            // Peminjaman
            'view-peminjaman',
            'create-peminjaman',
            'edit-peminjaman',
            'delete-peminjaman',
        ]);
    }
}