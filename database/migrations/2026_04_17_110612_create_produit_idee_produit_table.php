<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    //migration table pivot produit_ideeproduit
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produit_idee_produit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');
            $table->foreignId('idee_produit_id')->constrained('idee_produits')->onDelete('cascade');
            $table->integer('ordre')->nullable(); // Pour ordonner l'affichage des idées
            $table->timestamps();
            
            // Éviter les doublons (un produit ne peut être lié deux fois à la même idée)
            $table->unique(['produit_id', 'idee_produit_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_idee_produit');
    }
};
