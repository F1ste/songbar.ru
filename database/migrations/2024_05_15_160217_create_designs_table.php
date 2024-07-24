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
            $table->id();
            $table->integer('catalog_id');
            $table->char('font-family', 100);
            $table->char('color', 20);            
            $table->boolean('pagination');
            $table->char('pagination-color', 20);
            $table->char('search-color', 20);
            $table->char('search-border-color', 20);
            $table->char('search-font-color', 20);
            $table->char('search-font-size', 4);
            $table->char('searchres-color', 20);
            $table->char('searchres-border-color', 20);
            $table->char('searchres-font-color', 20);
            $table->char('searchres-font-size', 4);
            $table->char('headbutton-font-color', 20);
            $table->char('headbutton-font-size', 4);
            $table->char('headcontact-font-color', 20);
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
