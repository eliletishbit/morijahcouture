@php
    $user = auth()->user();
@endphp

<div class="main-wrapper">
    <nav class="navbar-vertical-nav d-none d-xl-block">
        <div class="navbar-vertical">
            <div class="px-4 py-5">
                <a href="{{ route('admin.dashboardadmin') }}" class="navbar-brand">
                    <img src="{{ asset('assets/images/logo/freshcart-logo.svg') }}" alt="Logo FreshCart" />
                </a>
            </div>
            <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
			  <div data-simplebar style="height: 100%;">
                <ul class="navbar-nav flex-column" id="sideNavbar">

                    
                    {{-- Lien Tableau de bord --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($user->role === 'admin' ? 'admin.dashboardadmin' : 'user.dashboarduser') ? 'active' : '' }}"
                           href="{{ $user->role === 'admin' ? route('admin.dashboardadmin') : route('user.dashboarduser') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="bi bi-house"></i></span>
                                <span class="nav-link-text">Tableau de bord</span>
                            </div>
                        </a>
                    </li>

                    @if($user->role === 'admin')
                        {{-- Gestion boutique --}}
                        <li class="nav-item mt-6 mb-3"><span class="nav-label">Gestion de la boutique</span></li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
                                    <span class="nav-link-text">Produits</span>
                                </div>
                            </a>
                             <a class="nav-link {{ request()->routeIs('admin.caracteristique-produits.*') ? 'active' : '' }}" href="{{ route('admin.caracteristique-produits.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
                                    <span class="nav-link-text">Carcteristiques produits</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-list-task"></i></span>
                                    <span class="nav-link-text">Catégories</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.sous-categories.*') ? 'active' : '' }}" href="{{ route('admin.sous-categories.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-bookmark"></i></span>
                                    <span class="nav-link-text">Sous-catégories</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.collections.*') ? 'active' : '' }}" href="{{ route('admin.collections.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-layers"></i></span>
                                    <span class="nav-link-text">Collections</span>
                                </div>
                            </a>
                        </li>

                        {{-- Commandes --}}
                        <li class="nav-item mt-6 mb-3"><span class="nav-label">Gestion des commandes</span></li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.commandes.*') ? 'active' : '' }}" href="{{ route('admin.commandes.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
                                    <span class="nav-link-text">Commandes</span>
                                </div>
                            </a>
                        </li>

                        {{-- Utilisateurs --}}
                        <li class="nav-item mt-6 mb-3"><span class="nav-label">Gestion des utilisateurs</span></li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-text">Utilisateurs</span>
                                </div>
                            </a>
                        </li>

                        {{-- Avis clients --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.avis-produits.*') ? 'active' : '' }}" href="{{ route('admin.avis-produits.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-star"></i></span>
                                    <span class="nav-link-text">Avis clients</span>
                                </div>
                            </a>
                        </li>

                     
                       
                        {{-- options de personnalisation --}}
                        <li class="nav-item mt-6 mb-3"><span class="nav-label">gestion du personnalisation</span></li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.option-personnalisations.*') ? 'active' : '' }}" href="{{ route('admin.option-personnalisations.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-text">options</span>                                    
                                </div>
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.valeur-options.*') ? 'active' : '' }}" href="{{ route('admin.valeur-options.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-text">valeur options</span>                                    
                                </div>
                            </a>
                        </li>                    
                       

                        <li class="nav-item mt-6 mb-3"><span class="nav-label">gestion lookbooks</span></li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.lookbooks.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-text">lookbooks</span>
                                </div>
                            </a>
                        </li>

                         <li class="nav-item mt-6 mb-3"><span class="nav-label">gestion echantillons</span></li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.catalogue-echantillons.*') ? 'active' : '' }}" href="{{ route('admin.catalogue-echantillons.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-text">catalogue echantillons</span>
                                </div>
                            </a>
                            <a class="nav-link {{ request()->routeIs('admin.echantillons.*') ? 'active' : '' }}" href="{{ route('admin.echantillons.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-text">echantillons</span>
                                </div>
                            </a>
                        </li>

                         <li class="nav-item mt-6 mb-3"><span class="nav-label">gestion livraisons</span></li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.mode-livraisons.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-text">modes de livraisons</span>
                                </div>
                            </a>
                        </li>

                         <li class="nav-item mt-6 mb-3"><span class="nav-label">gestion paiements</span></li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.paiements.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-text">paiements</span>
                                </div>
                            </a>
                        </li>






                    @elseif($user->role === 'user')
                        {{-- Menu spécifique utilisateur simple, par exemple --}}                       
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.ordsers.*') ? 'active' : '' }}" href="{{ route('admin.avis-produits.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-star"></i></span>
                                    <span class="nav-link-text">Commandes</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.payment-methods.index.*') ? 'active' : '' }}" href="{{ route('admin.avis-produits.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-star"></i></span>
                                    <span class="nav-link-text">Methodes de paiement</span>
                                </div>
                            </a>
                        </li>
                    @endif

                    {{-- Vous pouvez ajouter d'autres rôles et leurs menus ici --}}
                   <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="bi bi-person"></i></span>
                                <span class="nav-link-text">Mon Profil</span>
                            </div>
                        </a>
                    </li>

                   <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.notifications*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon"><i class="bi bi-person"></i></span>
                                <span class="nav-link-text">Notifications</span>
                            </div>
                        </a>
                    </li>

                </ul>
			  </div>
            </div>
        </div>
    </nav>
</div>

{{-- Ajouter le CSS de SimpleBar --}}
<link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css" />

{{-- Ajouter le JS de SimpleBar --}}
<script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>

{{-- Initialiser SimpleBar sur tous les éléments avec data-simplebar --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser SimpleBar sur tous les éléments avec l'attribut data-simplebar
        new SimpleBar(document.querySelector('[data-simplebar]'));
    });
</script>