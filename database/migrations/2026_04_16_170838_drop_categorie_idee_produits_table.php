<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('categorie_idee_produits');
    }

    public function down(): void
    {
        // Recréer la table si on veut revenir en arrière
        Schema::create('categorie_idee_produits', function ($table) {
            $table->id();
            $table->string('nom');
            $table->timestamps();
        });
    }
};