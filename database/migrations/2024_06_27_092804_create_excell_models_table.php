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
        Schema::create('excell_models', function (Blueprint $table) {
            $table->id();
            $table->string('song_number');
            $table->string('song_name');
            $table->string('song_singer');
            $table->string('is_back');
            $table->string('song_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excell_models');
    }
};
