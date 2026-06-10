<?php

use App\Http\Controllers\Admin\AvisProduitController;
use App\Http\Controllers\Admin\CaracteristiqueProduitController;
use App\Http\Controllers\Admin\CarteCadeauController;
use App\Http\Controllers\Admin\CatalogueEchantillonController;
use App\Http\Controllers\Admin\CategorieIdeeProduitController;
use App\Http\Controllers\Admin\CategorieOptionPersonnalisationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EchantillonController;
use App\Http\Controllers\Admin\IdeeProduitController;
use App\Http\Controllers\Admin\ImageLookbookController;
use App\Http\Controllers\Admin\LookbookController;
use App\Http\Controllers\Admin\MethodePaiementController;
use App\Http\Controllers\Admin\ModeLivraisonController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OptionPersonnalisationController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Admin\PointInteractifController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SousCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ValeurOptionController;
use App\Http\Controllers\Admin\VideoLookbookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SousOptionPersonnalisationController;
use App\Http\Controllers\User\AvisProduitController as UserAvisProduitController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\PaymentMethodController as UserPaymentMethodController;
use App\Http\Controllers\User\UserCollectionController;
use App\Http\Controllers\User\UserLookbookController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserprofileController;
use App\Http\Controllers\WelcomeController;
use App\Livewire\ProductCustomizationEditor;
use Illuminate\Support\Facades\Route;

//////////////////////////////////////////////////////////////////////////////////////////////////////
//PAGES PRINCIPAUX SANS BESOIN D AUTHENTIFICATION
Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
//catalogue des categories
Route::get('/shop', [WelcomeController::class, 'shop'])->name('shop.grid');
//affichage vue single product
Route::get('products/{product}', [UserProductController::class, 'show'])->name('products.show');
Route::get('/produits/{product}/personnalisation', ProductCustomizationEditor::class)->name('produits.personnalisation');
//routes pour la gestion panier commandes checkout
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{produit}', [CartController::class, 'ajouter'])->name('cart.ajouter');
Route::post('/panier/maj', [CartController::class, 'mettreAJour'])->name('cart.update');
Route::post('/panier/supprimer', [CartController::class, 'supprimer'])->name('cart.remove');
Route::post('/panier/vider', [CartController::class, 'vider'])->name('cart.clear');
//collections et sous-categories
Route::get('sous-categories/{id}/collections', [UserCollectionController::class, 'index'])->name('collections.index');
Route::get('collections/{id}', [UserCollectionController::class, 'show'])->name('collections.show');


///////////////////////////////////////////////////////////////////////////////////////////////////////
//PAGES ACCESSIBLES QU AU UTILISATEURS/ACHETEURS (role user) AUTHENTIFIES
Route::middleware(['auth','role:user'])->group(function () {
    Route::get('/checkout', [UserOrderController::class, 'checkout'])->name('checkout');
    Route::post('/commander', [UserOrderController::class, 'store'])->name('commandes.store');
    Route::get('/commandes', [UserOrderController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/{commande}', [UserOrderController::class, 'show'])->name('commandes.show');


    // ========== MESURES ==========
    // Formulaire des mesures
    Route::get('/produit/{produit}/mesures', [App\Http\Controllers\User\MesureController::class, 'index'])
        ->name('mesures.index');
    
    // Enregistrement des mesures
    Route::post('/produit/{produit}/mesures', [App\Http\Controllers\User\MesureController::class, 'store'])
        ->name('mesures.store');
    
    // (Optionnel) Afficher une mesure spécifique
    Route::get('/mesures/{mesure}', [App\Http\Controllers\User\MesureController::class, 'show'])
        ->name('mesures.show');
    
    // (Optionnel) Modifier une mesure
    Route::get('/mesures/{mesure}/edit', [App\Http\Controllers\User\MesureController::class, 'edit'])
        ->name('mesures.edit');
    
    // (Optionnel) Mettre à jour une mesure
    Route::put('/mesures/{mesure}', [App\Http\Controllers\User\MesureController::class, 'update'])
        ->name('mesures.update');
    
    // (Optionnel) Supprimer une mesure
    Route::delete('/mesures/{mesure}', [App\Http\Controllers\User\MesureController::class, 'destroy'])
        ->name('mesures.destroy');

});

//Dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




/////////////////////////////////////////////////////////////////////////////////////////////////


//a securiser via admin
Route::resource('categorieoptionpersonnalisations', CategorieOptionPersonnalisationController::class);
Route::resource('sousoptionpersonnalisations', SousOptionPersonnalisationController::class);

//lookbooks
// web.php
Route::get('/user/lookbooks', [UserLookbookController::class, 'index'])->name('user.lookbooks.index');
// web.php
Route::get('/user/lookbooks/{slug}', [UserLookbookController::class, 'show'])->name('user.lookbooks.show');


// Authentification (générée par Breeze ou Laravel UI)
require __DIR__ . '/auth.php';





///////////////SPECIFIQUES ROUTES: role middleware

// // PRIVATE USER DASHBOARD ROUTES : role =user
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {


    
    // Tableau de bord user (compte, récapitulatif)
    Route::get('dashboarduser', [UserDashboardController::class, 'index'])->name('dashboarduser');

    // Commandes de l'utilisateur
    Route::resource('commandes', UserOrderController::class)->only(['index', 'show']);

    // Gestion des moyens de paiement
    Route::get('payment-methods', [UserPaymentMethodController::class, 'index'])->name('payment-methods.index');
    Route::post('payment-methods', [UserPaymentMethodController::class, 'store'])->name('payment-methods.store');
    Route::delete('payment-methods/{id}', [UserPaymentMethodController::class, 'destroy'])->name('payment-methods.destroy');

    //paiements
    Route::resource('paiements', PaiementController::class)->only(['index', 'show']);
    //nptifications
    Route::resource('notifications', NotificationController::class)->only(['index','show']);
    //profil 
    Route::get('/profile/show', [UserprofileController::class, 'show'])->name('profile.show');
    Route::put('/profile/update', [UserprofileController::class, 'update'])->name('profile.update');
      Route::get('/profile/edit', [UserprofileController::class, 'edit'])->name('profile.edit');

    //mes produits
    Route::resource('produits', UserProductController::class);

    //panier
    Route::get('panier', [CartController::class, 'show'])->name('panier.show');

    // Route::post('panier/checkout', [CartController::class, 'checkout'])->name('panier.checkout');

   




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
     // Commandes admin
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/{id}', [App\Http\Controllers\Admin\CommandeController::class, 'show'])->name('commandes.show');
    Route::put('/commandes/{id}/statut', [App\Http\Controllers\Admin\CommandeController::class, 'updateStatut'])->name('commandes.statut');

    // Méthodes et paiements
    Route::resource('methode-paiements', MethodePaiementController::class);
    Route::resource('paiements', PaiementController::class);

    // Notifications
    Route::resource('notifications', NotificationController::class);
});

Route::get('/test', function () {
    return view('test');
});


