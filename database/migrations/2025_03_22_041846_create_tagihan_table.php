<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihanTable extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel tagihan.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('datadiri_id');
            $table->string('nomor_tagihan')->unique();
            $table->decimal('total_tagihan', 15, 2);
            $table->enum('status_tagihan', ['belum_upload', 'di_periksa', 'valid'])->default('belum_upload');  // Status Tagihan
            $table->string('bukti_pembayaran')->nullable();
            $table->string('nomor_bukti_pembayaran')->nullable();
            $table->string('nama');
            $table->timestamps();

            // Menambahkan relasi ke tabel data_diri
            $table->foreign('datadiri_id')->references('id')->on('datadiri')->onDelete('cascade');
        });
    }

    /**
     * Rollback migrasi untuk menghapus tabel tagihan.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tagihan');
    }
}