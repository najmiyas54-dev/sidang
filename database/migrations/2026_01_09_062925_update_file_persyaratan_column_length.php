<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sidang_registrations', function (Blueprint $table) {
            $table->text('file_persyaratan')->change();
        });
    }

    public function down(): void
    {
        Schema::table('sidang_registrations', function (Blueprint $table) {
            $table->string('file_persyaratan')->change();
        });
    }
};