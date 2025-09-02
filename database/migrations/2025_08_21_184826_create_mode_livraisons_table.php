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
        Schema::create('mode_livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('nom');            // Ex : gratuit, express, standard
            $table->integer('delai_estime')->nullable(); // en jours
            $table->decimal('cout', 8, 2)->default(0);   // coût de la livraison
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mode_livraisons');
    }
};
