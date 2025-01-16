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
        Schema::create('paints', function (Blueprint $table) {
            $table->id();

            $table->timestamps();

            $table->foreignId('user_id')->nullable();
            $table->string('brand')->nullable(); // e.g. Citadel, Army Painter, Vallejo
            $table->string('range')->nullable(); // e.g Layer, Color Primer, Model Air
            $table->string('paint_name')->nullable(); // e.g Admiistratum Grey, Ash Grey,  Brown Grey
            $table->string('paint_ref')->nullable(); // e.g NULL, NULL, RAL7050
            $table->string('color_name')->nullable(); // Grey, Blue, Brown Grey
            $table->string('color_hex')->nullable(); // Grey, Blue, Brown Grey
            $table->string('paint_type')->nullable(); // Grey, Blue, Brown Grey
            $table->string('thumbnail')->nullable(); // Grey, Blue, Brown Grey
            $table->boolean('available')->nullable()->default(true); // Grey, Blue, Brown Grey

            //            Citadel Layer "Administatum Grey" grey #808080 paint Layer Image
            //            Citadel Air "Troll Slayer Orange"
            //            Army Painter Speed Paint
            //            Army Painter Warpaints Dragon Red
            //            Army Painter Guild Ball Mason Blue
            //            Army Painter Colour PrimerAsh Grey
            //            Vallejo Model Color "Dark Blue Grey"
            //            Vallejo Model Air

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paints');
    }
};
