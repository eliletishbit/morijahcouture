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
        Schema::create('caracteristique_produits', function (Blueprint $table) {
           $table->id();
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('restrict'); // ou simplement sans onDelete
            $table->string('type');
            $table->string('valeur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caracteristique_produits');
    }
};
