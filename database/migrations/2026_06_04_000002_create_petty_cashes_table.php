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
        Schema::create('petty_cashes', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_petty_cash')->unique();
            $table->date('bulan'); // bulan dan tahun
            $table->decimal('jumlah_awal', 15, 2);
            $table->decimal('total_pengeluaran', 15, 2)->default(0);
            $table->decimal('jumlah_akhir', 15, 2);
            $table->enum('status', ['draft', 'approved', 'closed'])->default('draft');
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('tanggal_approved')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petty_cashes');
    }
};
