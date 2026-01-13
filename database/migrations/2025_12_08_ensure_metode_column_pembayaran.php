<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pembayaran')) {
            return;
        }

        // Ensure the metode_id column exists
        if (!Schema::hasColumn('pembayaran', 'metode_id')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                $table->unsignedBigInteger('metode_id')->nullable();
                $table->foreign('metode_id')
                    ->references('id')
                    ->on('metode_pembayarans')
                    ->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pembayaran')) {
            Schema::table('pembayaran', function (Blueprint $table) {
                $table->dropForeignIfExists(['metode_id']);
                if (Schema::hasColumn('pembayaran', 'metode_id')) {
                    $table->dropColumn('metode_id');
                }
            });
        }
    }
};
