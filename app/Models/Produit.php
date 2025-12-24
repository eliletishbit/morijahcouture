<?php

namespace App\Models;

use App\Models\ImagePersonnalisee;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //
  protected $fillable = [
    'image_produit',
    'nom',
    'description',
    'prix_base',
    'collection_id',
    'sous_categorie_id',
    'personnalisable',
    'type_produit',
    'gamme_taille',
    'materiau_id',
    'delai_fabrication',
    'delai_livraison',
    'stock'
];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class);
    }

    public function caracteristiques()
    {
        return $this->hasMany(CaracteristiqueProduit::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')
                    ->withPivot('quantite', 'prix_unitaire', 'prix_total')
                    ->withTimestamps();
    }

     public function materiau()
    {
        return $this->belongsTo(Materiau::class);
    }

  

 // Relation produits composant la tenue (pièces)
    public function pieces()
    {
        return $this->belongsToMany(
            Produit::class,    // relation à lui-même
            'piece_produit',   // table pivot
            'produit_id',      // FK pour la tenue (produit parent)
            'piece_id'         // FK pour la pièce (produit enfant)
        );
    }

    // Inverse (produits dans lesquels la pièce est utilisée)
    public function tenues()
    {
        return $this->belongsToMany(
            Produit::class,
            'piece_produit',
            'piece_id',
            'produit_id'
        );
    }

    public function optionsPersonnalisation()
    {
        return $this->belongsToMany(OptionPersonnalisation::class, 'produit_option_valeur')
                    ->using(ProduitOptionValeur::class) // Modèle pivot optionnel mais conseillé
                    ->withPivot('valeur_option_id')      // Colonnes supplémentaires à récupérer dans pivot
                    ->withTimestamps();                   // timestamp sur pivot
    }

     public function optionsValeurs()
    {
        return $this->belongsToMany(OptionPersonnalisation::class, 'produit_option_valeur')
                    ->using(ProduitOptionValeur::class) // Modèle pivot optionnel mais conseillé
                    ->withPivot('valeur_option_id')      // Colonnes supplémentaires à récupérer dans pivot
                    ->withTimestamps();                   // timestamp sur pivot
    }



        public function imagesPersonnalisees()
        {
            return $this->belongsToMany(
                ImagePersonnalisee::class,
                'produit_image_personnalisees',
                'produit_id',              // clé étrangère du modèle Produit dans la table pivot
                'image_personnalisee_id'   // clé étrangère du modèle ImagePersonnalisee dans la table pivot
            )
            ->using(ProduitImagePersonnalisee::class) // modèle pivot personnalisé
            ->withPivot(['option_personnalisation_id', 'valeur_option_id', 'image'])
            ->withTimestamps();
        }








}
