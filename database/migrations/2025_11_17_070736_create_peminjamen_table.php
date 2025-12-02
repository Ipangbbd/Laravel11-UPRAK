<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();

            // Relasi Ke Barang
            $table->foreignId('barang_id')
                ->constrained('barangs')
                ->onDelete('cascade');

            // Relasi Ke User (peminjam)
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Tanggal Peminjaman & Pengembalian
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable(); // boleh null jika belum dikembalikan

            // Status
            $table->enum('status', ['dipinjam', 'dikembalikan', 'hilang', 'rusak'])
                ->default('dipinjam');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
