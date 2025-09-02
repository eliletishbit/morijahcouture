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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('image_produit');
            $table->string('nom');
            $table->text('description');
            $table->decimal('prix_base', 10, 2);
            $table->foreignId('collection_id')->nullable()->constrained('collections')->onDelete('set null');
            $table->foreignId('sous_categorie_id')->constrained('sous_categories')->onDelete('cascade');
            $table->boolean('personnalisable')->default(false);
            $table->string('type_produit');//“veste”, “chaussure”, “accessoire”
            $table->string('gamme_taille')->default('sur-mesure')->nullable();// “sur-mesure”, “standard”, “enfant”, etc."S", "M", "L", "XL"
            $table->foreignId('materiau_id')->nullable()->constrained('materiaux')->onDelete('set null'); //tizzu metal plaztiue etc
            $table->integer('delai_fabrication')->nullable();
            $table->integer('delai_livraison')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
