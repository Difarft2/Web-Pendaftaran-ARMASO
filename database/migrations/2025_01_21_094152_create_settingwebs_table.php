<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settingwebs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_website')->nullable();
            $table->string('deskripsi_website')->nullable();
            $table->string('no_peserta_website')->nullable();
            $table->string('logo_website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settingwebs');
    }
};