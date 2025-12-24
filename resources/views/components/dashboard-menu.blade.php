@php
    $user = auth()->user();
@endphp

<div class="main-wrapper">
    <nav class="navbar-vertical-nav d-none d-xl-block">
        <div class="navbar-vertical">
            <div class="px-3 py-4">
                <a href="{{ route('admin.dashboardadmin') }}" class="navbar-brand">
                    <img src="{{ asset('assets/images/logo/freshcart-logo.svg') }}" alt="Logo FreshCart" />
                </a>
            </div>
            <div class="navbar-vertical-content flex-grow-1" data-simplebar style="max-height: 100vh; overflow-y: auto;">
                <ul class="navbar-nav flex-column py-1" id="sideNavbar">

                    {{-- Lien Tableau de bord --}}
                    <li class="nav-item mb-1">
                        <a class="nav-link {{ request()->routeIs($user->role === 'admin' ? 'admin.dashboardadmin' : 'user.dashboarduser') ? 'active' : '' }}"
                           href="{{ $user->role === 'admin' ? route('admin.dashboardadmin') : route('user.dashboarduser') }}">
                            <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                <span class="nav-link-icon me-2"><i class="bi bi-house"></i></span>
                                <span class="nav-link-text">Tableau de bord</span>
                            </div>
                        </a>
                    </li>

                    @if($user->role === 'admin')
                        {{-- Gestion boutique --}}
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-cart"></i></span>
                                    <span class="nav-link-text">Produits</span>
                                </div>
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.caracteristique-produits.*') ? 'active' : '' }}" href="{{ route('admin.caracteristique-produits.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-cart"></i></span>
                                    <span class="nav-link-text">Caractéristiques produits</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-list-task"></i></span>
                                    <span class="nav-link-text">Catégories</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.sous-categories.*') ? 'active' : '' }}" href="{{ route('admin.sous-categories.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-bookmark"></i></span>
                                    <span class="nav-link-text">Sous-catégories</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.collections.*') ? 'active' : '' }}" href="{{ route('admin.collections.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-layers"></i></span>
                                    <span class="nav-link-text">Collections</span>
                                </div>
                            </a>
                        </li>

                        {{-- Commandes --}}
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.commandes.*') ? 'active' : '' }}" href="">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-bag"></i></span>
                                    <span class="nav-link-text">Commandes</span>
                                </div>
                            </a>
                        </li>

                        {{-- Utilisateurs --}}
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-text">Utilisateurs</span>
                                </div>
                            </a>
                        </li>

                        {{-- Avis clients --}}
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.avis-produits.*') ? 'active' : '' }}" href="{{ route('admin.avis-produits.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-star"></i></span>
                                    <span class="nav-link-text">Avis clients</span>
                                </div>
                            </a>
                        </li>

                        {{-- Options de personnalisation --}}
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.option-personnalisations.*') ? 'active' : '' }}" href="{{ route('admin.option-personnalisations.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-gear"></i></span>
                                    <span class="nav-link-text">Options personnalisation</span>
                                </div>
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.valeur-options.*') ? 'active' : '' }}" href="{{ route('admin.valeur-options.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-gear"></i></span>
                                    <span class="nav-link-text">Valeur options</span>
                                </div>
                            </a>
                              <a class="nav-link {{ request()->routeIs('sousoptionpersonnalisations.*') ? 'active' : '' }}" href="{{ route('sousoptionpersonnalisations.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-gear"></i></span>
                                    <span class="nav-link-text">Sous options </span>
                                </div>
                            </a>
                              <a class="nav-link {{ request()->routeIs('categorieoptionpersonnalisations.*') ? 'active' : '' }}" href="{{ route('categorieoptionpersonnalisations.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-gear"></i></span>
                                    <span class="nav-link-text">Categories options </span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.lookbooks.*') ? 'active' : '' }}" href="{{ route('admin.lookbooks.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-images"></i></span>
                                    <span class="nav-link-text">Lookbooks</span>
                                </div>
                            </a>
                        </li>
                         <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.video-lookbooks.*') ? 'active' : '' }}" href="{{ route('admin.video-lookbooks.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-tags"></i></span>
                                    <span class="nav-link-text">videos lookbooks</span>
                                </div>
                            </a>
                        </li>

                           <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.image-lookbooks.*') ? 'active' : '' }}" href="{{ route('admin.image-lookbooks.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-tags"></i></span>
                                    <span class="nav-link-text">images lookbooks</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.catalogue-echantillons.*') ? 'active' : '' }}" href="{{ route('admin.catalogue-echantillons.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-book"></i></span>
                                    <span class="nav-link-text">Catalogue échantillons</span>
                                </div>
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.echantillons.*') ? 'active' : '' }}" href="{{ route('admin.echantillons.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-box"></i></span>
                                    <span class="nav-link-text">Échantillons</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.mode-livraisons.*') ? 'active' : '' }}" href="{{ route('admin.mode-livraisons.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-truck"></i></span>
                                    <span class="nav-link-text">Modes de livraison</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.paiements.*') ? 'active' : '' }}" href="{{ route('admin.paiements.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-credit-card"></i></span>
                                    <span class="nav-link-text">Paiements</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-person"></i></span>
                                    <span class="nav-link-text">Éditer profil</span>
                                </div>
                            </a>
                        </li>
                        
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.idee-produits.*') ? 'active' : '' }}" href="{{ route('admin.idee-produits.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-lightbulb"></i></span>
                                    <span class="nav-link-text">Idées produits</span>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.categorie-idee-produits.*') ? 'active' : '' }}" href="{{ route('admin.categorie-idee-produits.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-tags"></i></span>
                                    <span class="nav-link-text">Catégorie idées produits</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}" href="{{ route('admin.notifications.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-bell"></i></span>
                                    <span class="nav-link-text">Notifications</span>
                                </div>
                            </a>
                        </li>

                    @elseif($user->role === 'user')
                        {{-- Menu spécifique utilisateur simple --}}
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('user.profile.*') ? 'active' : '' }}" href="{{ route('user.profile.show') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-credit-card"></i></span>
                                    <span class="nav-link-text">Profile</span>
                                </div>
                            </a>
                        </li>
                        {{-- <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('user.produits.*') ? 'active' : '' }}" href="{{ route('user.produits.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-credit-card"></i></span>
                                    <span class="nav-link-text">Mes Produits</span>
                                </div>
                            </a>
                        </li> --}}
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('user.panier.*') ? 'active' : '' }}" href="{{ route('user.panier.show') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-credit-card"></i></span>
                                    <span class="nav-link-text">Panier </span>
                                </div>
                            </a>
                        </li>      
                         <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('user.commandes.*') ? 'active' : '' }}" href="{{ route('user.commandes.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-credit-card"></i></span>
                                    <span class="nav-link-text">Commandes </span>
                                </div>
                            </a>
                        </li>                  
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('user.payment-methods.*') ? 'active' : '' }}" href="{{ route('user.payment-methods.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-credit-card"></i></span>
                                    <span class="nav-link-text">Méthodes de paiement</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('user.paiements.*') ? 'active' : '' }}" href="{{ route('user.paiements.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-credit-card"></i></span>
                                    <span class="nav-link-text">Paiements</span>
                                </div>
                            </a>
                        </li>                       
                        <li class="nav-item mb-1">
                            <a class="nav-link {{ request()->routeIs('user.notifications.*') ? 'active' : '' }}" href="{{ route('user.notifications.index') }}">
                                <div class="d-flex align-items-center" style="font-size: 0.9rem;">
                                    <span class="nav-link-icon me-2"><i class="bi bi-credit-card"></i></span>
                                    <span class="nav-link-text">Notifications</span>
                                </div>
                            </a>
                        </li>
                    @endif

                    {{-- Vous pouvez ajouter d'autres rôles et leurs menus ici --}}

                    
                </ul>
            </div>
        </div>
    </nav>
</div>

{{-- SimpleBar CSS --}}
<link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css" />

{{-- SimpleBar JS --}}
<script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>

{{-- Initialisation de SimpleBar --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new SimpleBar(document.querySelector('[data-simplebar]'));
    });
</script>
