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
        Schema::create('setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->string('jenis'); // sabaq, sabqi, manzil
            $table->integer('juz');
            $table->string('surat');
            $table->integer('ayat_mulai');
            $table->integer('ayat_selesai');
            $table->integer('jumlah_baris');
            $table->text('catatan')->nullable();
            $table->string('kehadiran')->default('hadir');
            $table->integer('nilai_kelancaran')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setorans');
    }
};
