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
        Schema::create('item', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreign('parent_id')->references('id')->on('items')->nullable();
            $table->foreign('owner_id')->references('id')->on('users')->nullable();
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->string('value')->nullable();
            $table->json('design');
            $table->boolean('active')->defaults(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item');
    }
};
