@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails du produit : {{ $product->nom }}</h1>

    <p><strong>Description :</strong> {{ $product->description }}</p>
    <p><strong>Prix de base :</strong> {{ number_format($product->prix_base, 2, ',', ' ') }} €</p>
    <p><strong>Collection :</strong> {{ $product->collection->nom ?? 'Aucune' }}</p>
    <p><strong>Sous-catégorie :</strong> {{ $product->sousCategorie->nom ?? 'Non définie' }}</p>
    <p><strong>Matériau :</strong> {{ $product->materiau->nom ?? '-' }}</p>
    <p><strong>Personnalisable :</strong> {{ $product->personnalisable ? 'Oui' : 'Non' }}</p>
    <p><strong>Type de produit :</strong> {{ $product->type_produit }}</p>
    <p><strong>Gamme taille :</strong> {{ $product->gamme_taille }}</p>
    <p><strong>Délai fabrication :</strong> {{ $product->delai_fabrication ?? '-' }} jours</p>
    <p><strong>Délai livraison :</strong> {{ $product->delai_livraison ?? '-' }} jours</p>
    <p>
        <strong>Image :</strong><br />
        @if ($product->image_produit)
        <img src="{{ asset('storage/' . $product->image_produit) }}" alt="{{ $product->nom }}" style="max-width: 300px;" />
        @else
        Aucune image
        @endif
    </p>

    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
