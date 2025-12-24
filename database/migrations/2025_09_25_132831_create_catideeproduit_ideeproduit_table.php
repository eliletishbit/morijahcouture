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
        Schema::create('catideeproduit_ideeproduit', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie_idee_produit_id');
            $table->unsignedBigInteger('idee_produit_id');

            $table->foreign('categorie_idee_produit_id')->references('id')->on('categorie_idee_produits')->onDelete('cascade');
            $table->foreign('idee_produit_id')->references('id')->on('idee_produits')->onDelete('cascade');

            $table->primary(['categorie_idee_produit_id', 'idee_produit_id']);
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catideeproduit_ideeproduit');
    }
};
