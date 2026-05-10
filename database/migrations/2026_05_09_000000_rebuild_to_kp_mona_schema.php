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
        // Drop old tables to avoid conflicts
        Schema::dropIfExists('komentar');
        Schema::dropIfExists('pengaduan_foto');
        Schema::dropIfExists('pengaduan_detail');
        Schema::dropIfExists('pengaduan_status');
        Schema::dropIfExists('pengaduan_header');
        Schema::dropIfExists('pengaduan_kategori');
        Schema::dropIfExists('tindak_lanjuts');
        Schema::dropIfExists('pengaduans');
        Schema::dropIfExists('users');
        Schema::dropIfExists('rt');
        Schema::dropIfExists('rukun_tetangga');
        Schema::dropIfExists('role');

        // Table: role
        Schema::create('role', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('name_role', 45)->unique();
        });

        // Table: rt
        Schema::create('rt', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('nama_rt', 45)->unique();
        });

        // Table: users
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('nama_warga', 45);
            $table->string('username', 45)->unique();
            $table->string('password', 100);
            $table->integer('role_id');
            $table->string('no_tlp', 16);
            $table->string('email', 60);
            $table->string('alamat', 100);
            $table->integer('rt_id');
            $table->string('nik', 16)->nullable();
            
            $table->foreign('role_id')->references('id')->on('role')->onDelete('no action')->onUpdate('no action');
            $table->foreign('rt_id')->references('id')->on('rt')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });

        // Table: pengaduan_kategori
        Schema::create('pengaduan_kategori', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('kategori', 45)->unique();
        });

        // Table: pengaduan_header
        Schema::create('pengaduan_header', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('subject', 45);
            $table->string('nomor_pengaduan', 45)->unique();
            $table->integer('pengaduan_kategori_id');
            
            $table->foreign('pengaduan_kategori_id')->references('id')->on('pengaduan_kategori')->onDelete('no action')->onUpdate('no action');
        });

        // Table: pengaduan_status
        Schema::create('pengaduan_status', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('status', 45)->unique();
        });

        // Table: pengaduan_detail
        Schema::create('pengaduan_detail', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->text('detail_pengaduan');
            $table->dateTime('tgl');
            $table->integer('pengaduan_header_id');
            $table->integer('pengaduan_status_id');
            $table->integer('users_id');
            
            $table->foreign('pengaduan_header_id')->references('id')->on('pengaduan_header')->onDelete('no action')->onUpdate('no action');
            $table->foreign('pengaduan_status_id')->references('id')->on('pengaduan_status')->onDelete('no action')->onUpdate('no action');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

        // Table: pengaduan_foto
        Schema::create('pengaduan_foto', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->string('nama_file', 255);
            $table->integer('pengaduan_detail_id');
            
            $table->foreign('pengaduan_detail_id')->references('id')->on('pengaduan_detail')->onDelete('no action')->onUpdate('no action');
        });

        // Table: komentar
        Schema::create('komentar', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->text('isi_komentar');
            $table->integer('users_id');
            $table->integer('pengaduan_detail_id');
            
            $table->foreign('users_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('pengaduan_detail_id')->references('id')->on('pengaduan_detail')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
        Schema::dropIfExists('pengaduan_foto');
        Schema::dropIfExists('pengaduan_detail');
        Schema::dropIfExists('pengaduan_status');
        Schema::dropIfExists('pengaduan_header');
        Schema::dropIfExists('pengaduan_kategori');
        Schema::dropIfExists('users');
        Schema::dropIfExists('rt');
        Schema::dropIfExists('role');
    }
};
