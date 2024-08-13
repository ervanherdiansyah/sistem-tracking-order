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
        Schema::create('pendaftaran_smile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama_lengkap')->nullable();
            $table->string('kelas')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('alamat_asal_sekolah')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_kk')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nama_ibu_kandung')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nama_pendamping')->nullable();
            $table->string('no_pendamping')->nullable();
            // $table->string('fakultas')->nullable();
            $table->string('jurusan1')->nullable();
            $table->string('jurusan2')->nullable();
            $table->string('kta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_smile');
    }
};
