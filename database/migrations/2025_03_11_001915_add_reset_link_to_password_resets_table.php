<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->string('reset_link')->nullable()->after('token'); // Tambah reset_link
        });
    }

    public function down()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropColumn('reset_link');
        });
    }
};