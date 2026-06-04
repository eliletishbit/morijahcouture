<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sous_categories', function (Blueprint $table) {
            $table->foreignId('categorie_option_personnalisation_id')
                  ->nullable()
                  ->after('categorie_id')
                  ->constrained('categorie_option_personnalisations')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('sous_categories', function (Blueprint $table) {
            $table->dropForeign(['categorie_option_personnalisation_id']);
            $table->dropColumn('categorie_option_personnalisation_id');
        });
    }
};