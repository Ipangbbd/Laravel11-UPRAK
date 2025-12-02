<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Jika nama tabel bukan `barangs`
    // protected $table = 'barang';

    protected $fillable = [
        'nama',
        'kategori_id',
        'jumlah',
        'kondisi',
        'lokasi',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'kategori_id' => 'integer',
    ];

    /**
     * Barang belongs to Kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Barang memiliki banyak riwayat peminjaman
     */
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
