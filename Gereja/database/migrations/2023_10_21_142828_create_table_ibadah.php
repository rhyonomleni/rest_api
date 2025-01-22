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
        Schema::create('ibadah', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nama_ibadah');
            $table->string('jenis_ibadah');
            $table->date('tanggal');
            $table->string('tempat');
            $table->string('rekaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_ibadah');
    }
};
