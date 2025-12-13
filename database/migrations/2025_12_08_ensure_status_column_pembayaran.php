<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pembayaran')) {
            return;
        }

        // Ensure the status column exists
        if (!Schema::hasColumn('pembayaran', 'status')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                $table->string('status')->default('Menunggu Verifikasi')->nullable();
            });
        }

        // Ensure all NULL values have a default
        DB::table('pembayaran')->whereNull('status')->update(['status' => 'Menunggu Verifikasi']);
    }

    public function down(): void
    {
        if (Schema::hasTable('pembayaran') && Schema::hasColumn('pembayaran', 'status')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
