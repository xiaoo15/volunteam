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
        Schema::table('users', function (Blueprint $table) {
            // Kita tambahin kolom avatar, boleh kosong (nullable), ditaruh setelah kolom email
            $table->string('avatar')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kalau rollback, kolomnya dihapus
            $table->dropColumn('avatar');
        });
    }
};
