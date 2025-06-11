<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('karaoke_name')->nullable();
        $table->string('juridical_name')->nullable();
        $table->string('inn')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['karaoke_name', 'juridical_name', 'inn']);
    });
}
};
