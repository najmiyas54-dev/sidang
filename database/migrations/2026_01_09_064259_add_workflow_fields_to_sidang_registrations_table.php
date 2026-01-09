<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sidang_registrations', function (Blueprint $table) {
            $table->enum('admin_status', ['pending', 'approved', 'rejected'])->default('pending')->after('status');
            $table->enum('pembimbing_status', ['pending', 'approved', 'rejected'])->default('pending')->after('admin_status');
            $table->text('admin_notes')->nullable()->after('pembimbing_status');
            $table->text('pembimbing_notes')->nullable()->after('admin_notes');
            $table->timestamp('admin_reviewed_at')->nullable()->after('pembimbing_notes');
            $table->timestamp('pembimbing_reviewed_at')->nullable()->after('admin_reviewed_at');
        });
    }

    public function down(): void
    {
        Schema::table('sidang_registrations', function (Blueprint $table) {
            $table->dropColumn(['admin_status', 'pembimbing_status', 'admin_notes', 'pembimbing_notes', 'admin_reviewed_at', 'pembimbing_reviewed_at']);
        });
    }
};