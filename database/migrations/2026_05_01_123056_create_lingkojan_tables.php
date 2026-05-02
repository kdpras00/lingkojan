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
        // RT Management
        Schema::create('rukun_tetangga', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->unique(); // e.g., 001, 002
            $table->string('nama_ketua')->nullable();
            $table->timestamps();
        });

        // Complaints
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nomor_pengaduan')->unique(); // e.g., P-01
            $table->string('kategori');
            $table->string('subjek');
            $table->string('foto')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt');
            $table->string('rw');
            $table->enum('status', ['New', 'On Progress', 'Done', 'Cancel'])->default('New');
            $table->timestamps();
        });

        // Follow-ups (Timeline)
        Schema::create('tindak_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->text('detail');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjuts');
        Schema::dropIfExists('pengaduans');
        Schema::dropIfExists('rukun_tetangga');
    }
};
