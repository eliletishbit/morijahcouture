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
            $table->string('valeur');
            $table->string('image')->nullable();
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
