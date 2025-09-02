<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


//imports controllers admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SousCategoryController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CaracteristiqueProduitController;
use App\Http\Controllers\Admin\LookbookController;
use App\Http\Controllers\Admin\ImageLookbookController;
use App\Http\Controllers\Admin\VideoLookbookController;
use App\Http\Controllers\Admin\PointInteractifController;
use App\Http\Controllers\Admin\OptionPersonnalisationController;
use App\Http\Controllers\Admin\ValeurOptionController;
use App\Http\Controllers\Admin\CatalogueEchantillonController;
use App\Http\Controllers\Admin\EchantillonController;
use App\Http\Controllers\Admin\CarteCadeauController;
use App\Http\Controllers\Admin\AvisProduitController;
use App\Http\Controllers\Admin\IdeeProduitController;
use App\Http\Controllers\Admin\CategorieIdeeProduitController;
use App\Http\Controllers\Admin\ModeLivraisonController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\MethodePaiementController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Admin\NotificationController;


//import controllers user
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\PaymentMethodController as UserPaymentMethodController;


// Page d'accueil Laravel classique
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


//Dashboard (à adapter selon ton nouveau stack, ici Blade)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentification (générée par Breeze ou Laravel UI)
require __DIR__ . '/auth.php';


///////////////SPECIFIQUES ROUTES: role middleware

// // PRIVATE USER DASHBOARD ROUTES : role =user
Route::middleware(['auth', 'verified', 'role:user'])->prefix('user')->name('user.')->group(function () {
    
    // Tableau de bord user (compte, récapitulatif)
    Route::get('dashboarduser', [UserDashboardController::class, 'index'])->name('dashboarduser');

    // Commandes de l'utilisateur
    Route::resource('orders', UserOrderController::class)->only(['index', 'show']);

    // Gestion des moyens de paiement
    Route::get('payment-methods', [UserPaymentMethodController::class, 'index'])->name('payment-methods.index');
    Route::post('payment-methods', [UserPaymentMethodController::class, 'store'])->name('payment-methods.store');
    Route::delete('payment-methods/{id}', [UserPaymentMethodController::class, 'destroy'])->name('payment-methods.destroy');

   
});




// //PRIVATE ADMIN DASHBOARD ROUTES : role = admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard d’administration
    Route::get('dashboardadmin', [AdminDashboardController::class, 'index'])->name('dashboardadmin');

    // Utilisateurs
    Route::resource('users', UserController::class);

    // Catégories et sous-catégories
    Route::resource('categories', CategoryController::class);
    Route::resource('sous-categories', SousCategoryController::class);

    // Collections
    Route::resource('collections', CollectionController::class);

    // Produits et caractéristiques
    Route::resource('products', ProductController::class);
    Route::resource('caracteristique-produits', CaracteristiqueProduitController::class);

    // Lookbooks et médias associés
    Route::resource('lookbooks', LookbookController::class);
    Route::resource('image-lookbooks', ImageLookbookController::class);
    Route::resource('video-lookbooks', VideoLookbookController::class);
    Route::resource('point-interactifs', PointInteractifController::class);

    // Options personnalisations et valeurs associées
    Route::resource('option-personnalisations', OptionPersonnalisationController::class);
    Route::resource('valeur-options', ValeurOptionController::class);

    // Catalogue et échantillons
    Route::resource('catalogue-echantillons', CatalogueEchantillonController::class);
    Route::resource('echantillons', EchantillonController::class);

    // Cartes cadeaux
    Route::resource('carte-cadeaus', CarteCadeauController::class);

    // Avis clients
    Route::resource('avis-produits', AvisProduitController::class)->only(['index', 'destroy']);

    // Idées produits et catégories associées
    Route::resource('idee-produits', IdeeProduitController::class);
    Route::resource('categorie-idee-produits', CategorieIdeeProduitController::class);

    // Modes de livraison
    Route::resource('mode-livraisons', ModeLivraisonController::class);

    // Commandes
    Route::resource('commandes', CommandeController::class);

    // Méthodes et paiements
    Route::resource('methode-paiements', MethodePaiementController::class);
    Route::resource('paiements', PaiementController::class);

    // Notifications
    Route::resource('notifications', NotificationController::class);
});




