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
        Schema::create('option_personnalisations', function (Blueprint $table) {
             $table->id();

            // Relation option vers produit (nullable si option générique)
            $table->foreignId('produit_id')->nullable()->constrained('produits')->onDelete('cascade');

            // Relation vers catégorie option personnalisation
          $table->unsignedBigInteger('categorie_option_personnalisation_id');
            $table->foreign('categorie_option_personnalisation_id', 'fk_categorie_option_id')
                ->references('id')
                ->on('categorie_option_personnalisations')
                ->onDelete('cascade');


            $table->string('nom_option');
            $table->string('type_option'); // texte, image, sélection, etc

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropForeign('fk_categorie_option_id');
    $table->dropColumn('categorie_option_personnalisation_id');
        Schema::dropIfExists('option_personnalisations');
    }
};
