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
            $table->char('font_family', 100)->nullable();
            $table->char('bg_color', 20)->nullable();            
            $table->boolean('is_pagination')->nullable()->default(true);
            $table->char('pagination_color', 20)->nullable();
            $table->char('pagination_color_active', 20)->nullable();
            $table->char('pagination_font_size', 4)->nullable();
            $table->char('bg_search_color', 20)->nullable();
            $table->char('search_border_color', 20)->nullable();
            $table->char('search_font_color', 20)->nullable();
            $table->char('search_font_size', 4)->nullable();
            $table->char('search_results_color', 20)->nullable();
            $table->char('search_results_border_color', 20)->nullable();
            $table->char('search_results_font_color', 20)->nullable();
            $table->char('search_results_font_size', 4)->nullable();
            $table->char('header_btn_font_color', 20)->nullable();
            $table->char('header_btn_bg_color', 20)->nullable();
            $table->char('header_btn_border_color', 20)->nullable();
            $table->char('header_btn_font_size', 4)->nullable();
            $table->char('header_contact_font_color', 20)->nullable();
            $table->char('header_contact_font_size', 4)->nullable();
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
