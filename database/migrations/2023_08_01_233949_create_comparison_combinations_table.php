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
        Schema::create('comparison_combinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indentification_id')->constrained();
            $table->foreignId('image_id')->constrained();
            $table->integer('similarity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comparison_combinations');
    }
};
