<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('datadiri', function (Blueprint $table) {
            $table->enum('status_data', ['belum_valid', 'valid'])->default('belum_valid')->after('nomor_hp');
        });
    }

    public function down()
    {
        Schema::table('datadiri', function (Blueprint $table) {
            $table->dropColumn('status_data');
        });
    }
};