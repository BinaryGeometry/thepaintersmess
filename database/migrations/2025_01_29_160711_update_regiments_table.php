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
        //
        Schema::disableForeignKeyConstraints();
        Schema::table('regiments', function (Blueprint $table) {
            $table->dropForeign(['game_id']);
            $table->foreignId('game_id')->nullable()->constraints('regiments')->change();
            $table->dropForeign(['faction_id']);
            $table->foreignId('faction_id')->nullable()->constraints('regiments')->change();
            $table->dropForeign(['detachment_id']);
            $table->foreignId('detachment_id')->nullable()->constraints('regiments')->change();
            $table->dropForeign(['unit_id']);
            $table->foreignId('unit_id')->nullable()->constraints('regiments')->change();

            $table->dropForeign(['extra_id']);
            $table->foreignId('extra_id')->nullable()->constraints('item')->change();
            $table->dropForeign(['item_id']);
            $table->foreignId('item_id')->nullable()->constraints('item')->change();

        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
