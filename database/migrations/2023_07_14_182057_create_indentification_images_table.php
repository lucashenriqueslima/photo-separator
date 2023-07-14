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
        Schema::create('indentification_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indentification_id')->constrained();
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indentification_images', function (Blueprint $table) {
            $table->dropForeign(['indentification_id']);
        });

        Schema::dropIfExists('indentification_images');
    }
};
