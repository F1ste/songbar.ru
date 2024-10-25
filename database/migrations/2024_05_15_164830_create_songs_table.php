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
        Schema::create('songs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('cnumber')->nullable();
            $table->string('title');
            $table->string('singer');
            $table->boolean('back')->default(false);
            $table->char('type')->nullable();
            $table->integer('view_per_day')->default(0);
            $table->integer('view_per_week')->default(0);
            $table->integer('view_per_month')->default(0);
            $table->integer('view_per_all')->default(0);
            $table->timestamps();

            $table->index(['title', 'singer']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
