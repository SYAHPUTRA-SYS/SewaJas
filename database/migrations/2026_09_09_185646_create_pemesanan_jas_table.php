<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesanan_jas', function (Blueprint $table) {
            $table->id();

            // Foreign Key ke pelanggans
            $table->foreignId('pelanggan_id')
                  ->constrained('pelanggans')
                  ->onDelete('cascade');

             // Foreign Key ke jas
            $table->foreignId('jas_id')
                  ->constrained('jas')
                  ->onDelete('cascade');

            // Tanggal
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->date('tanggal_sidang');

             // Detail pemesanan
            $table->integer('jumlah')->default(1);
            $table->integer('total_harga');
            $table->integer('denda')->default(0);

             // Status
            $table->enum('status', ['booking', 'diambil', 'kembali', 'batal'])
                  ->default('booking');

             // Pembayaran
            $table->enum('pembayaran', ['belum_bayar', 'dp', 'lunas'])
                  ->default('belum_bayar');

            // Catatan
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_jas');
    }
};
