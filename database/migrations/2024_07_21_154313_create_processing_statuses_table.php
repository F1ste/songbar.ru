<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessingStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO временный фикс для ошибки при php artisan migrate
        if (!Schema::hasTable('processing_statuses')) {
            Schema::create('processing_statuses', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('catalog_id');
                $table->integer('total_rows');
                $table->integer('processed_rows')->default(0);
                $table->string('status', 125)->default('in_progress');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processing_statuses');
    }
}