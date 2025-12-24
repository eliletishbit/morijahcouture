<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    //
     protected $fillable = [
        'user_id', 
        'numero_commande',
        'mode_livraison_id', 
        'adresse_livraison',
        'adresse_facturation', 
        'total', 
        'statut',        
        'methode_paiement',
        'statut_paiement',
        'notes'
    ];

      /**
     * Génère un numéro de commande unique
     */
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modeLivraison()
    {
        return $this->belongsTo(ModeLivraison::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
                    ->withPivot('quantite', 'prix_unitaire', 'prix_total')
                    ->withTimestamps();
    }

    /**
     * Ajouter un produit à la commande
     */
    public function ajouterProduit($produitId, $quantite, $prixUnitaire)
    {
        $prixTotal = $quantite * $prixUnitaire;

        $this->produits()->attach($produitId, [
            'quantite' => $quantite,
            'prix_unitaire' => $prixUnitaire,
            'prix_total' => $prixTotal
        ]);

        // Mettre à jour le total de la commande
        $this->increment('total', $prixTotal);
    }

    /**
     * Calculer le total à partir des produits
     */
    public function calculerTotal()
    {
        return $this->produits->sum(function ($produit) {
            return $produit->pivot->prix_total;
        });
    }

    public static function genererNumeroCommande()
    {
        $numero = 'CMD-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        
        while (self::where('numero_commande', $numero)->exists()) {
            $numero = 'CMD-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        }
        
        return $numero;
    }

    /**
     * Boot du modèle
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($commande) {
            if (empty($commande->numero_commande)) {
                $commande->numero_commande = self::genererNumeroCommande();
            }
        });
    }



}
