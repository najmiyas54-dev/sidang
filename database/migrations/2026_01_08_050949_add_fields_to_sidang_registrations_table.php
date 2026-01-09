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
        Schema::table('sidang_registrations', function (Blueprint $table) {
            $table->string('tempat_kp')->nullable();
            $table->string('durasi')->nullable();
            $table->string('bidang_penelitian')->nullable();
            $table->string('dosen_pembimbing_2')->nullable();
            $table->string('progress')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sidang_registrations', function (Blueprint $table) {
            $table->dropColumn(['tempat_kp', 'durasi', 'bidang_penelitian', 'dosen_pembimbing_2', 'progress']);
        });
    }
};
