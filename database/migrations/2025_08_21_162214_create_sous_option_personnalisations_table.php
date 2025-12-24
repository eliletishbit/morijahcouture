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
        Schema::create('sous_option_personnalisations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_personnalisation_id')->constrained()->onDelete('cascade');
            $table->string('nom_sous_option');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_option_personnalisations');
    }
};
