<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Paiement;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupération stricte de l'utilisateur connecté pour l'éditeur de code
        /** @var User $user */
        $user = User::find(Auth::id());
        

        // Sécurité si l'utilisateur n'est pas ou plus connecté
        if (!$user) {
            return redirect()->route('login');
        }

        // 1. Commandes récentes de l'utilisateur (max 10, avec produits et mode_livraison)
        $commandesRecentes = $user->commandes()
            ->with(['produits', 'modeLivraison'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // 2. Notifications de l'utilisateur (non lues d'abord, limitées à 5)
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // 3. Personnalisations récentes (via la table mesures ou session)
        // Option A : depuis la table mesures (si tu stockes la personnalisation)
        $mesuresRecentes = $user->mesures()
            ->with('produit')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Option B : depuis les commandes (récupère les personnalisations stockées dans commande_produit ou commande)
        $personnalisationsRecentes = $user->commandes()
            ->whereNotNull('personnalisation_data')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get(['id', 'numero_commande', 'personnalisation_data', 'created_at']);

       // 4. Paiements récents (via commandes)
        $paiementsRecents = Paiement::whereHas('commande', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->orderBy('created_at', 'desc')->limit(5)->get();

        // 5. Méthodes de paiement utilisées (optionnel)
        $methodesPaiement = collect(); // ou via une requête plus complexe


        // Statistiques pour le dashboard
        $stats = [
            'total_commandes' => $user->commandes()->count(),
            'commandes_en_cours' => $user->commandes()->where('statut', 'en cours')->count(),
            'commandes_livrees' => $user->commandes()->where('statut', 'livrée')->count(),
            'commandes_annulees' => $user->commandes()->where('statut', 'annulée')->count(),
            'total_depenses' => $user->commandes()->sum('total'),
            'notifications_non_lues' => $user->notifications()->whereNull('created_at')->count(),// Correction ici : unreadNotifications() avec parenthèses pour rester cohérent
        ];

        return view('pages.backend.dashboarduser', compact(
            'user',
            'commandesRecentes',
            'notifications',
            'mesuresRecentes',
            'personnalisationsRecentes',
            'paiementsRecents',
            'methodesPaiement',
            'stats'
        ));
    }
}
