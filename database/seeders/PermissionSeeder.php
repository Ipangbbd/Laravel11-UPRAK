<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission List
        $permissions = [
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

            // Role
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
