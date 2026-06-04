@extends('layouts.backendapp')

@section('content')
<div class="container py-5">
    <!-- En-tête avec navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-6 fw-bold text-primary mb-1">{{ $product->nom }}</h1>
            <p class="text-muted">Détails complets du produit</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square me-1"></i> Modifier
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Retour
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Colonne gauche : Images -->
        <div class="col-lg-5">
            <!-- Image principale -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    @if ($product->image_produit)
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $product->image_produit) }}" 
                                 alt="{{ $product->nom }}" 
                                 class="img-fluid rounded-3 shadow-sm" 
                                 style="max-height: 300px; object-fit: contain;">
                            <p class="text-muted small mt-3 mb-0">Image principale du produit</p>
                        </div>
                    @else
                        <div class="text-center py-5 bg-light rounded-3">
                            <i class="bi bi-image fs-1 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Aucune image principale</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Modèle neutre -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    @if ($product->image_modele_neutre)
                        <img src="{{ asset('storage/' . $product->image_modele_neutre) }}" 
                        alt="Modèle neutre" 
                        class="img-fluid rounded-3 shadow-sm" 
                        style="max-height: 300px; object-fit: contain;">
                         <p class="text-muted text-center small mt-3 mb-0">Image modèle neutre</p>
                    @else
                        <div class="text-center py-5 bg-light rounded-3">
                            <i class="bi bi-layers fs-1 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Aucun modèle neutre</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Colonne droite : Informations -->
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <!-- Description -->
                    <div class="mb-4">
                        <h5 class="fw-bold text-primary mb-3">
                            <i class="bi bi-file-text me-2"></i> Description
                        </h5>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>

                    <hr>

                    <!-- Informations principales -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-circle">
                                    <i class="bi bi-tag fs-5 text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Prix de base</small>
                                    <strong class="fs-4">{{ number_format($product->prix_base, 2, ',', ' ') }} €</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                                <div class="bg-info bg-opacity-10 p-2 rounded-circle">
                                    <i class="bi bi-list-check fs-5 text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Sous-catégorie</small>
                                    <strong>{{ $product->sousCategorie->nom ?? 'Non définie' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                                <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                                    <i class="bi bi-collection fs-5 text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Collection</small>
                                    <strong>{{ $product->collection->nom ?? 'Aucune' }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                                <div class="bg-warning bg-opacity-10 p-2 rounded-circle">
                                    <i class="bi bi-box fs-5 text-warning"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Matériau</small>
                                    <strong>{{ $product->materiau->nom ?? '-' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Délais et autres infos -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded-3">
                                <i class="bi bi-calendar-check fs-4 text-primary"></i>
                                <p class="mb-0 mt-2">
                                    <small class="text-muted d-block">Fabrication</small>
                                    <strong>{{ $product->delai_fabrication ?? '-' }} jours</strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded-3">
                                <i class="bi bi-truck fs-4 text-primary"></i>
                                <p class="mb-0 mt-2">
                                    <small class="text-muted d-block">Livraison</small>
                                    <strong>{{ $product->delai_livraison ?? '-' }} jours</strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded-3">
                                <i class="bi bi-person-check {{ $product->personnalisable ? 'text-success' : 'text-secondary' }} fs-4"></i>
                                <p class="mb-0 mt-2">
                                    <small class="text-muted d-block">Personnalisable</small>
                                    <strong>{{ $product->personnalisable ? 'Oui' : 'Non' }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Type et gamme -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between p-3 bg-light rounded-3">
                                <span class="text-muted">Type de produit :</span>
                                <strong>{{ $product->type_produit }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between p-3 bg-light rounded-3">
                                <span class="text-muted">Gamme taille :</span>
                                <strong>{{ $product->gamme_taille ?? 'Non spécifiée' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Pièces (si tenue) -->
    @if ($product->pieces && $product->pieces->count() > 0)
    <div class="mt-5">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h5 class="fw-bold text-primary mb-0">
                    <i class="bi bi-cubes me-2"></i> Pièces composant cette tenue
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    @foreach ($product->pieces as $piece)
                    <div class="col-md-2 col-sm-3 col-6">
                        <div class="text-center">
                            @if($piece->image_produit)
                                <img src="{{ asset('storage/' . $piece->image_produit) }}" 
                                     class="rounded-3 shadow-sm mb-2" 
                                     alt="{{ $piece->nom }}"
                                     style="width: 100%; height: 100px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height: 100px;">
                                    <i class="bi bi-image fs-2 text-muted"></i>
                                </div>
                            @endif
                            <small class="text-muted">{{ Str::limit($piece->nom, 30) }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection