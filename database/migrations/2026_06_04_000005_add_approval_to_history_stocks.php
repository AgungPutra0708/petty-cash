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
        Schema::table('history_stocks', function (Blueprint $table) {
            $table->enum('status', ['draft', 'pending_approval', 'approved', 'rejected'])->default('draft')->after('keterangan');
            $table->unsignedBigInteger('approved_by')->nullable()->after('status');
            $table->timestamp('tanggal_approved')->nullable()->after('approved_by');
            $table->text('catatan_approval')->nullable()->after('tanggal_approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_stocks', function (Blueprint $table) {
            $table->dropColumn(['status', 'approved_by', 'tanggal_approved', 'catatan_approval']);
        });
    }
};
