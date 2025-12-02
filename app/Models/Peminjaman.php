<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Nama tabel custom
    protected $table = 'peminjamen';

    // Kolom yang boleh diisi
    protected $fillable = [
        'barang_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    /**
     * Relasi ke tabel barang
     * 1 peminjaman hanya untuk 1 barang
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    /**
     * Relasi ke tabel users
     * 1 peminjaman dilakukan oleh 1 user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
