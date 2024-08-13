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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nisn');
            $table->string('nik');
            $table->string('nama_siswa');
            $table->string('jenis_kelamin');
            $table->string('pas_foto')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();

            //Kontak
            $table->string('email')->nullable();
            $table->string('hp')->nullable();

            // Alamat lengkap
            $table->string('alamat')->nullable();

            $table->string('provinsi')->nullable();

            $table->string('kota_kabupaten')->nullable();

            $table->string('kecamatan')->nullable();

            $table->string('kelurahan')->nullable();

            //data orang tua
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('nohp_ayah')->nullable();
            $table->string('nohp_ibu')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            //Riwayat pendidikan 
            $table->string('nama_sekolah')->nullable();
            $table->string('prestasi')->nullable();
            $table->string('jenis_pendaftaran')->nullable();
            $table->string('pilih_jurusan')->nullable();

            //data berkas
            $table->string('ijaza')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('akta_lahir')->nullable();

            $table->string('status_pendaftaran');
            $table->datetime('tgl_pendaftaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
