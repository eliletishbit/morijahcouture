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
        Schema::create('valeur_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_personnalisation_id')->constrained('option_personnalisations')->onDelete('cascade');
            $table->foreignId('sous_option_personnalisation_id')->nullable()->constrained('sous_option_personnalisations')->onDelete('cascade');
            $table->string('valeur');
            $table->string('image')->nullable(); // image spécifique à la valeur
            $table->decimal('prix', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valeur_options');
    }
};
