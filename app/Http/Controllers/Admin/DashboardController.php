<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\User;
use App\Models\Produit;
use App\Models\Paiement;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        
        if (!$admin || $admin->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Accès réservé aux administrateurs.');
        }
            
        // ========== STATISTIQUES GLOBALES ==========
        $stats = [
            'total_commandes' => Commande::count(),
            'commandes_en_cours' => Commande::where('statut', 'en cours')->count(),
            'commandes_livrees' => Commande::where('statut', 'livrée')->count(),
            'commandes_annulees' => Commande::where('statut', 'annulée')->count(),
            'chiffre_affaires' => Commande::where('statut', 'livrée')->sum('total'),
            'total_users' => User::count(),
            'nouveaux_users_mois' => User::whereMonth('created_at', now()->month)->count(),
            'total_produits' => Produit::count(),
            'produits_personnalisables' => Produit::where('personnalisable', true)->count(),
            'produits_en_stock' => Produit::where('stock', '>', 0)->count(),
            'paiements_en_attente' => Paiement::where('statut', 'en attente')->count(),
            'paiements_valides' => Paiement::where('statut', 'payé')->count(),
            'notifications_non_lues' => Notification::whereNull('created_at')->count(),
        ];

        // ========== LISTES RÉCENTES (limitées) ==========
        $dernieresCommandes = Commande::with(['user', 'produits', 'modeLivraison'])
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $derniersUtilisateurs = User::orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $derniersProduits = Produit::with(['sousCategorie', 'collection'])
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $derniersPaiements = Paiement::with(['commande.user'])
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

      $produitsPopulaires = Produit::select(
            'produits.id',
            'produits.nom',
            'produits.prix_base',
            'produits.image_produit',
            DB::raw('SUM(commande_produit.quantite) as total_vendus')
        )
        ->join('commande_produit', 'produits.id', '=', 'commande_produit.produit_id')
        ->groupBy('produits.id', 'produits.nom', 'produits.prix_base', 'produits.image_produit')
        ->orderBy('total_vendus', 'desc')
        ->limit(5)
        ->get();

        $caParMois = Commande::where('statut', 'livrée')
            ->select(DB::raw('MONTH(created_at) as mois'), DB::raw('SUM(total) as total'))
            ->whereYear('created_at', now()->year)
            ->groupBy('mois')
            ->orderBy('mois')
            ->get()
            ->pluck('total', 'mois')
            ->toArray();

        $statutsCommandes = [
            'en_cours' => $stats['commandes_en_cours'],
            'livrees' => $stats['commandes_livrees'],
            'annulees' => $stats['commandes_annulees'],
        ];

        return view('pages.backend.dashboardadmin', compact(
            'admin',
            'stats',
            'dernieresCommandes',
            'derniersUtilisateurs',
            'derniersProduits',
            'derniersPaiements',
            'produitsPopulaires',
            'caParMois',
            'statutsCommandes'
        ));

   
    }
}