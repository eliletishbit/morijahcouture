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
        Schema::create('produit_option_valeur', function (Blueprint $table) {
           $table->id();
            $table->foreignId('produit_id')->constrained()->onDelete('cascade');
            $table->foreignId('option_personnalisation_id')->constrained()->onDelete('cascade');
            $table->foreignId('valeur_option_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->unique(['produit_id', 'option_personnalisation_id', 'valeur_option_id'], 'produit_option_valeur_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_option_valeur');
    }
};
