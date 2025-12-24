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
        Schema::table('commandes', function (Blueprint $table) {
            //
            $table->string('numero_commande')->unique()->after('id'); // Numéro unique
            $table->text('adresse_livraison')->after('mode_livraison_id');
            $table->text('adresse_facturation')->nullable()->after('adresse_livraison');
            $table->string('methode_paiement')->after('statut'); // carte, paypal, virement
            $table->string('statut_paiement')->default('en attente')->after('methode_paiement'); // en attente, payé, échoué
            $table->text('notes')->nullable()->after('statut_paiement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            //
            $table->dropColumn([
                'numero_commande',
                'adresse_livraison', 
                'adresse_facturation',
                'methode_paiement',
                'statut_paiement',
                'notes'
            ]);
        });
    }
};
