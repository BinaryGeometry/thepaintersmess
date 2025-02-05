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
        Schema::table('recipes', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->integer('step')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('paint_id')->nullable()->constraints('paints');
            $table->string('surface')->nullable();
            $table->string('icon')->nullable();
            $table->foreignId('regiment_id')->nullable()->constraints('regiments');
            $table->string('note')->nullable();
            $table->foreignId('recipe_id')->nullable()->constraints('recipes');
            $table->string('thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
