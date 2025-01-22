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
        // Schema::create('admin', function (Blueprint $table) {
        //     $table->string('id')->primary();
        //     $table->string('username');
        //     $table->string('email')->unique();
        //     $table->string('google_id')->unique();
        //     $table->string('profile_picture');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
