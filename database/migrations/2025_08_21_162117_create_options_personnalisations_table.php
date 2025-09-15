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
           $table->foreignId('produit_id')->nullable()->constrained('produits')->onDelete('cascade');
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
        Schema::dropIfExists('option_personnalisations');
    }
};
