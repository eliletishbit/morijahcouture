{{-- @extends('layouts.frontendapp')

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

    @if ($product->pieces && $product->pieces->count() > 0)
    <h3>Pièces composant cette tenue :</h3>
    <div class="d-flex flex-wrap gap-3">
        @foreach ($product->pieces as $piece)
        <div class="card" style="width: 150px;">
            @if($piece->image_produit)
            <img src="{{ asset('storage/' . $piece->image_produit) }}" class="card-img-top" alt="{{ $piece->nom }}">
            @endif
            <div class="card-body">
                <p class="card-text">{{ $piece->nom }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @endif

   @if($product->personnalisable)
    <a href="{{ route('produits.personnalisation', ['product' => $produit->id]) }}" class="btn btn-warning mt-3">
        Personnaliser
    </a>
    @else
        <a href="" class="btn btn-warning mt-3">
            Ajouter au panier
        </a>
    @endif

   

</div>
@endsection --}}

@extends('layouts.frontendapp')

@section('content')

<div class="container my-5">
    <div class="row g-5">
        <!-- Colonne image produit avec zoom effet -->
        <div class="col-md-6">
            <div class="position-relative rounded-4 overflow-hidden" style="height:450px; background-size: cover; background-position: center; background-image: url('{{ asset('storage/' . $product->image_produit) }}');">
                <img src="{{ asset('storage/' . $product->image_produit) }}" alt="{{ $product->nom }}" class="img-fluid d-none" />
            </div>

            @if($product->pieces && $product->pieces->count() > 0)
            <div class="d-flex mt-3 gap-2 justify-content-center">
                @foreach ($product->pieces as $piece)
                    @if ($piece->image_produit)
                        <img src="{{ asset('storage/' . $piece->image_produit) }}" alt="{{ $piece->nom }}" class="img-thumbnail rounded-3" style="width: 80px; height: 80px; object-fit: cover;">
                    @endif
                @endforeach
            </div>
            @endif
        </div>

        <!-- Colonne informations produit -->
        <div class="col-md-6">
            <h1 class="mb-3 fw-bold">{{ $product->nom }}</h1>

            <div class="mb-3">
                <span class="fs-3 text-primary fw-semibold">{{ number_format($product->prix_base, 2, ',', ' ') }} €</span>
                @if(!empty($product->prix_ancien) && $product->prix_ancien > $product->prix_base)
                    <span class="ms-3 text-muted text-decoration-line-through">{{ number_format($product->prix_ancien, 2, ',', ' ') }} €</span>
                @endif
            </div>

            <p class="mb-4">{{ $product->description }}</p>

            <ul class="list-unstyled mb-4">
                <li><strong>Collection :</strong> {{ $product->collection->nom ?? 'Aucune' }}</li>
                <li><strong>Sous-catégorie :</strong> {{ $product->sousCategorie->nom ?? 'Non définie' }}</li>
                <li><strong>Matériau :</strong> {{ $product->materiau->nom ?? '-' }}</li>
                <li><strong>Type de produit :</strong> {{ $product->type_produit }}</li>
                <li><strong>Gamme taille :</strong> {{ $product->gamme_taille }}</li>
                <li><strong>Délai fabrication :</strong> {{ $product->delai_fabrication ?? '-' }} jours</li>
                <li><strong>Délai livraison :</strong> {{ $product->delai_livraison ?? '-' }} jours</li>
                <li><strong>Personnalisable :</strong> {{ $product->personnalisable ? 'Oui' : 'Non' }}</li>
            </ul>

            @if($product->personnalisable)
                <a href="{{ route('produits.personnalisation', ['product' => $product->id]) }}" class="btn btn-warning btn-lg rounded-pill">
                    Personnaliser
                </a>
            @else
                <form action="{{ route('cart.ajouter', ['produit' => $product->id]) }}" method="POST" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill" style="">Ajouter au panier</button>
                </form>
            @endif

            <!-- Bouton Retour -->
            <div class="mt-4">
                <a href="{{ route('collections.show', ['id' => $product->collection->id]) }}" class="btn btn-secondary rounded-pill px-4 py-2" style="opacity:0.8;">
                    &laquo; Retour à la collection
                </a>
            </div>
        </div>
    </div>
    
</div>

<section class="container mt-5 my-5">
    <h3 class="mb-4">Produits similaires</h3>
    <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-5">
        @forelse($relatedProducts as $related)
            <div class="col">
                <div class="card h-100">
                    <a href="{{ route('products.show', ['product' => $related->id]) }}">
                        <img src="{{ asset('storage/' . $related->image_produit) }}" alt="{{ $related->nom }}" class="img-fluid" style="height:150px; object-fit:cover; width:100%;">
                    </a>
                    <div class="card-body p-2">
                        <h6 class="card-title text-truncate">
                            <a href="{{ route('products.show', ['product' => $related->id]) }}" class="text-decoration-none">{{ $related->nom }}</a>
                        </h6>
                        <p class="mb-1 text-primary fw-bold">{{ number_format($related->prix_base, 2, ',', ' ') }} €</p>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucun produit similaire trouvé.</p>
        @endforelse
    </div>
</section>


@endsection
