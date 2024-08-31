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
        Schema::create('designs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('catalog_id')->nullable();
            $table->char('font-family', 100)->nullable();
            $table->char('color', 20)->nullable();            
            $table->boolean('pagination')->nullable();
            $table->char('pagination-color', 20)->nullable();
            $table->char('search-color', 20)->nullable();
            $table->char('search-border-color', 20)->nullable();
            $table->char('search-font-color', 20)->nullable();
            $table->char('search-font-size', 4)->nullable();
            $table->char('searchres-color', 20)->nullable();
            $table->char('searchres-border-color', 20)->nullable();
            $table->char('searchres-font-color', 20)->nullable();
            $table->char('searchres-font-size', 4)->nullable();
            $table->char('headbutton-font-color', 20)->nullable();
            $table->char('headbutton-font-size', 4)->nullable();
            $table->char('headcontact-font-color', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
