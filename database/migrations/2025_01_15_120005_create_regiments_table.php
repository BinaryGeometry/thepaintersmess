<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regiments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            //            $table->foreignId('parent_id')->constrained('regiments')->nullable();
            $table->foreignId('game_id')->constrained('item')->nullable();
            $table->foreignId('faction_id')->constrained('item')->nullable();
            $table->foreignId('detachment_id')->constrained('item')->nullable();
            $table->foreignId('unit_id')->constrained('item')->nullable();
            $table->json('meta')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regiments');
    }
};

/*
   INFO  Running migrations.

  2025_01_13_154835_create_item_table ............................ 1.00ms FAIL

   Illuminate\Database\QueryException

  SQLSTATE[HY000]: General error: 1 unknown column "parent_id" in foreign key definition (Connection: sqlite, SQL: create table "item" ("id" integer primary key autoincrement not null, "name" varchar, "slug" varchar, "description" varchar, "value" varchar, "design" text not null, "active" tinyint(1) not null, "created_at" datetime, "updated_at" datetime, foreign key("parent_id") references "items"("id"), foreign key("owner_id") references "users"("id")))

This was the first issue,
 */
