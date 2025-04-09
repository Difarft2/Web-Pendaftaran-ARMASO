<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('settingwebs', function (Blueprint $table) {
            $table->text('pesankontakadmin')->nullable()->after('logo_website'); // Sesuaikan posisi kolom
        });
    }

    public function down()
    {
        Schema::table('settingwebs', function (Blueprint $table) {
            $table->dropColumn('pesankontakadmin');
        });
    }
};
