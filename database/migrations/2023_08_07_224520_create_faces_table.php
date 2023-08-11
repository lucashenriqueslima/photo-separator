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
        Schema::create('faces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->constrained();
            $table->foreignId('indentification_id')->constrained()->nullable();
            $table->string('name');
            $table->integer('similarity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faces', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropForeign(['indentification_id']);
        });

        Schema::dropIfExists('faces');
    }
};
