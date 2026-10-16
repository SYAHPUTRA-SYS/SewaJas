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
        Schema::create('jas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jas')->unique();
            $table->enum('jenis', ['toga', 'jas_almamater', 'kebaya']);
            $table->string('ukuran', 5); // S, M, L, XL, XXL
            $table->integer('stok')->default(0);
            $table->integer('harga_sewa_per_hari');
            $table->integer('denda_terlambat')->default(50000);
            $table->text('keterangan')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jas');
    }
};
