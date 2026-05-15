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
        Schema::dropIfExists('komentar');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->integer('id')->primary()->autoIncrement();
            $table->text('isi_komentar');
            $table->integer('users_id');
            $table->integer('pengaduan_detail_id');
            
            $table->foreign('users_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('pengaduan_detail_id')->references('id')->on('pengaduan_detail')->onDelete('no action')->onUpdate('no action');
        });
    }
};
