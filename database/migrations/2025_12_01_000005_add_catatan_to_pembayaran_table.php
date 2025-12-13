<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pembayaran') && !Schema::hasColumn('pembayaran', 'catatan')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                // Add catatan column - use after('id') as fallback if 'status' doesn't exist
                if (Schema::hasColumn('pembayaran', 'status')) {
                    $table->text('catatan')->nullable()->after('status');
                } else {
                    $table->text('catatan')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pembayaran') && Schema::hasColumn('pembayaran', 'catatan')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                $table->dropColumn('catatan');
            });
        }
    }
};
