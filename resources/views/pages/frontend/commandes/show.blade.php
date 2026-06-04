{{-- @extends('layouts.frontendapp')

@section('content')

<div class="container my-5">
    <h1 class="fw-bold mb-4">Commande {{ $commande->numero_commande }}</h1>

    <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Statut :</strong> {{ ucfirst($commande->statut) }}</p>
    <p><strong>Mode de livraison :</strong> {{ $commande->modeLivraison->nom ?? 'N/A' }}</p>
    <p><strong>Adresse de livraison :</strong><br>{{ nl2br(e($commande->adresse_livraison)) }}</p>
    <p><strong>Adresse de facturation :</strong><br>{{ nl2br(e($commande->adresse_facturation)) }}</p>
    <p><strong>Méthode de paiement :</strong> {{ ucfirst($commande->methode_paiement) }}</p>
    @if($commande->notes)
        <p><strong>Notes :</strong><br>{{ nl2br(e($commande->notes)) }}</p>
    @endif

    <h3 class="mt-5 mb-3">Détails des produits</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->produits as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->pivot->quantite }}</td>
                    <td>{{ number_format($produit->pivot->prix_unitaire, 2, ',', ' ') }} €</td>
                    <td>{{ number_format($produit->pivot->prix_total, 2, ',', ' ') }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-end">Montant total : {{ number_format($commande->total, 2, ',', ' ') }} €</h4>

    <a href="{{ route('commandes.index') }}" class="btn btn-secondary mt-4">Retour à la liste</a>
</div>

@endsection --}}


@extends('layouts.frontendapp')

@section('content')

<div class="container my-5">
    {{-- Messages de succès ou d'erreur --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Erreur :</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- En-tête de la commande --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1">Commande #{{ $commande->numero_commande }}</h1>
            <p class="text-muted mb-0">Passée le {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
        </div>
        <div>
            @php
                $badgeClass = match($commande->statut) {
                    'en cours' => 'bg-warning text-dark',
                    'payée' => 'bg-success',
                    'expédiée' => 'bg-info',
                    'livrée' => 'bg-primary',
                    'annulée' => 'bg-danger',
                    default => 'bg-secondary'
                };
            @endphp
            <span class="badge {{ $badgeClass }} fs-6 px-3 py-2">
                {{ ucfirst($commande->statut) }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        {{-- Colonne gauche : Informations client et livraison --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-person-circle me-2 text-primary"></i> Informations client
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">Client</label>
                            <p class="mb-0 fw-medium">{{ $commande->user->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">Email</label>
                            <p class="mb-0 fw-medium">{{ $commande->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-truck me-2 text-primary"></i> Livraison
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">Mode de livraison</label>
                            <p class="mb-0 fw-medium">{{ $commande->modeLivraison->nom ?? 'N/A' }}</p>
                            @if($commande->modeLivraison)
                                <small class="text-muted">{{ number_format($commande->modeLivraison->prix, 2, ',', ' ') }} €</small>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">Adresse de livraison</label>
                            <p class="mb-0">{{ nl2br(e($commande->adresse_livraison)) }}</p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">Adresse de facturation</label>
                            <p class="mb-0">{{ nl2br(e($commande->adresse_facturation)) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-credit-card me-2 text-primary"></i> Paiement
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-semibold">Méthode de paiement</label>
                            <p class="mb-0 fw-medium">{{ ucfirst($commande->methode_paiement) }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase fw-semibold">Statut du paiement</label>
                            <p class="mb-0">
                                @php
                                    $paymentBadgeClass = match($commande->statut_paiement) {
                                        'payé' => 'bg-success',
                                        'en attente' => 'bg-warning text-dark',
                                        'échoué' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $paymentBadgeClass }}">{{ ucfirst($commande->statut_paiement) }}</span>
                            </p>
                        </div>
                    </div>
                    @if($commande->notes)
                        <div class="mt-3">
                            <label class="text-muted small text-uppercase fw-semibold">Notes</label>
                            <p class="mb-0">{{ nl2br(e($commande->notes)) }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Colonne droite : Résumé des produits --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-bottom-0 pt-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-bag-check me-2 text-primary"></i> Résumé de la commande
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($commande->produits as $produit)
                            <div class="list-group-item px-4 py-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">{{ $produit->nom }}</h6>
                                        <small class="text-muted">Quantité : {{ $produit->pivot->quantite }}</small>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold text-primary">
                                            {{ number_format($produit->pivot->prix_total, 2, ',', ' ') }} €
                                        </span>
                                        <div class="small text-muted">
                                            {{ number_format($produit->pivot->prix_unitaire, 2, ',', ' ') }} € / unité
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold">Sous-total</span>
                        <span>{{ number_format($commande->total, 2, ',', ' ') }} €</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3 text-success">
                        <span>Livraison</span>
                        <span>
                            @if($commande->modeLivraison && $commande->modeLivraison->prix > 0)
                                + {{ number_format($commande->modeLivraison->prix, 2, ',', ' ') }} €
                            @else
                                Offerte
                            @endif
                        </span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-4 text-primary">
                            {{ number_format($commande->total + ($commande->modeLivraison->prix ?? 0), 2, ',', ' ') }} €
                        </span>
                    </div>
                    
                    {{-- Boutons d'action --}}
                    <div class="d-grid gap-2">
                        @if($commande->statut_paiement == 'en attente')
                            <a href="{{ route('user.paiements.show', $commande->id) }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-lock-fill me-2"></i> Passer au paiement
                            </a>
                        @endif
                        <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Retour à la liste des commandes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection