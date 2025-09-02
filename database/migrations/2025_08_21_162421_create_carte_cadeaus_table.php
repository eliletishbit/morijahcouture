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
        Schema::create('carte_cadeaus', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 10, 2);
            $table->enum('mode_envoi', ['email', 'impression']);
            $table->string('from');
            $table->string('to');
            $table->text('message')->nullable();
            $table->string('email_destination')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carte_cadeaus');
    }
};
