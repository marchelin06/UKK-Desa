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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->text('tujuan')->nullable();
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->string('lokasi');
            $table->string('penyelenggara')->default('Desa');
            $table->string('penanggung_jawab')->nullable();
            $table->string('kategori')->default('Umum'); // Umum, Sosial, Infrastruktur, Pendidikan, Kesehatan, Keagamaan, Olahraga
            $table->text('peserta')->nullable(); // JSON array or text
            $table->integer('jumlah_peserta')->nullable();
            $table->string('status')->default('direncanakan'); // direncanakan, berlangsung, selesai, dibatalkan
            $table->string('foto')->nullable(); // Path foto kegiatan
            $table->text('hasil')->nullable(); // Hasil/output kegiatan
            $table->string('anggaran')->nullable(); // Anggaran kegiatan
            $table->timestamps();
            $table->softDeletes(); // Untuk soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
