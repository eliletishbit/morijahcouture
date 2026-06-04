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
<style>
    .product-detail-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    
    .product-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .image-zoom-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        cursor: zoom-in;
    }
    
    .image-zoom-container img {
        transition: transform 0.5s ease;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .image-zoom-container:hover img {
        transform: scale(1.1);
    }
    
    .thumbnail-item {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid transparent;
    }
    
    .thumbnail-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .thumbnail-item.active {
        border-color: #ffc107;
        transform: scale(1.05);
    }
    
    .price-tag {
        background: linear-gradient(135deg, #ffc107, #ff9800);
        padding: 8px 20px;
        border-radius: 50px;
        display: inline-block;
    }
    
    .info-badge {
        background: #f8f9fa;
        padding: 8px 15px;
        border-radius: 12px;
        margin: 5px;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .info-badge:hover {
        background: #ffc107;
        transform: translateX(5px);
    }
    
    .personnalize-btn {
        background: linear-gradient(135deg, #ffc107, #ff9800);
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .personnalize-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255,193,7,0.3);
    }
    
    .cart-btn {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        transition: all 0.3s ease;
    }
    
    .cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(40,167,69,0.3);
    }
    
    .similar-product-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .similar-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .similar-product-card img {
        transition: transform 0.5s ease;
    }
    
    .similar-product-card:hover img {
        transform: scale(1.05);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
    
    .breadcrumb-custom {
        background: transparent;
        padding: 15px 0;
    }
    
    .breadcrumb-custom a {
        text-decoration: none;
        color: #666;
        transition: color 0.3s ease;
    }
    
    .breadcrumb-custom a:hover {
        color: #ffc107;
    }
    
    .stock-info {
        background: #e8f5e9;
        padding: 8px 15px;
        border-radius: 50px;
        font-size: 0.9rem;
    }
    
    .feature-list {
        list-style: none;
        padding-left: 0;
    }
    
    .feature-list li {
        padding: 8px 0;
        border-bottom: 1px dashed #e0e0e0;
    }
    
    .feature-list li:last-child {
        border-bottom: none;
    }
    
    .feature-list i {
        margin-right: 10px;
        color: #ffc107;
    }
</style>

<div class="product-detail-page py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb-custom fade-in-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome.index') }}">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('collections.show', ['id' => $product->collection->id]) }}">{{ $product->collection->nom ?? 'Collections' }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->nom }}</li>
                </ol>
            </nav>
        </div>

        <!-- Produit Principal -->
        <div class="product-card fade-in-up">
            <div class="row g-0">
                <!-- Colonne image -->
                <div class="col-md-6 p-4">
                    <div class="image-zoom-container" style="height: 450px;">
                        <img src="{{ asset('storage/' . $product->image_produit) }}" 
                             alt="{{ $product->nom }}" 
                             id="main-image"
                             class="img-fluid rounded-4">
                    </div>

                    <!-- Miniatures des pièces -->
                    @if($product->pieces && $product->pieces->count() > 0)
                    <div class="d-flex mt-4 gap-3 justify-content-center">
                        @foreach ($product->pieces as $index => $piece)
                            @if ($piece->image_produit)
                                <div class="thumbnail-item {{ $index == 0 ? 'active' : '' }}" 
                                     onclick="changeImage('{{ asset('storage/' . $piece->image_produit) }}', this)">
                                    <img src="{{ asset('storage/' . $piece->image_produit) }}" 
                                         alt="{{ $piece->nom }}" 
                                         class="img-thumbnail rounded-3"
                                         style="width: 80px; height: 80px; object-fit: cover;">
                                    <div class="text-center small mt-1">{{ $piece->nom }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Colonne informations -->
                <div class="col-md-6 p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-warning text-dark mb-2 px-3 py-2">
                                <i class="bi bi-star-fill me-1"></i> Nouveauté
                            </span>
                            <h1 class="display-5 fw-bold mb-3">{{ $product->nom }}</h1>
                        </div>
                        @if($product->personnalisable)
                            <div class="stock-info">
                                <i class="bi bi-palette me-1"></i> Personnalisable
                            </div>
                        @endif
                    </div>

                    <!-- Prix -->
                    <div class="mb-4">
                        <div class="price-tag">
                            <span class="display-6 fw-bold text-dark">{{ number_format($product->prix_base, 2, ',', ' ') }} €</span>
                            @if(!empty($product->prix_ancien) && $product->prix_ancien > $product->prix_base)
                                <span class="ms-2 text-muted text-decoration-line-through h6">
                                    {{ number_format($product->prix_ancien, 2, ',', ' ') }} €
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="lead mb-4 text-muted">{{ $product->description }}</p>

                    <!-- Caractéristiques -->
                    <div class="mb-4">
                        <h5 class="mb-3 fw-bold">
                            <i class="bi bi-info-circle me-2 text-warning"></i>Caractéristiques
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-badge">
                                    <i class="bi bi-tag me-1"></i>
                                    <strong>Collection:</strong> {{ $product->collection->nom ?? 'Aucune' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-badge">
                                    <i class="bi bi-grid me-1"></i>
                                    <strong>Sous-catégorie:</strong> {{ $product->sousCategorie->nom ?? 'Non définie' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-badge">
                                    <i class="bi bi-droplet me-1"></i>
                                    <strong>Matériau:</strong> {{ $product->materiau->nom ?? '-' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-badge">
                                    <i class="bi bi-bounding-box me-1"></i>
                                    <strong>Type:</strong> {{ $product->type_produit }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-badge">
                                    <i class="bi bi-rulers me-1"></i>
                                    <strong>Gamme taille:</strong> {{ $product->gamme_taille }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-badge">
                                    <i class="bi bi-clock me-1"></i>
                                    <strong>Délai fabrication:</strong> {{ $product->delai_fabrication ?? '-' }} jours
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4">
                        @if($product->personnalisable)
                            <a href="{{ route('produits.personnalisation', ['product' => $product->id]) }}" 
                               class="btn personnalize-btn btn-lg rounded-pill px-5 py-3 me-2">
                                <i class="bi bi-palette me-2"></i>Personnaliser
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @else
                            <form action="{{ route('cart.ajouter', ['produit' => $product->id]) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn cart-btn btn-lg rounded-pill px-5 py-3">
                                    <i class="bi bi-cart-plus me-2"></i>Ajouter au panier
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('collections.show', ['id' => $product->collection->id]) }}" 
                           class="btn btn-outline-secondary btn-lg rounded-pill px-4 py-3">
                            <i class="bi bi-arrow-left me-2"></i>Retour
                        </a>
                    </div>

                    <!-- Avantages -->
                    <div class="mt-5 pt-3 border-top">
                        <div class="row text-center">
                            <div class="col-4">
                                <i class="bi bi-truck fs-4 text-warning"></i>
                                <p class="small mt-2 mb-0">Livraison offerte</p>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-arrow-repeat fs-4 text-warning"></i>
                                <p class="small mt-2 mb-0">Retour 30 jours</p>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-shield-lock fs-4 text-warning"></i>
                                <p class="small mt-2 mb-0">Paiement sécurisé</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produits similaires -->
        <div class="mt-5 fade-in-up">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">
                    <i class="bi bi-heart me-2 text-warning"></i>Produits similaires
                </h2>
                <a href="{{ route('collections.show', ['id' => $product->collection->id]) }}" class="text-decoration-none">
                    Voir tout <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            
            <div class="row g-4">
                @forelse($relatedProducts as $related)
                    <div class="col-md-6 col-lg-3">
                        <div class="similar-product-card card h-100 border-0 shadow-sm">
                            <a href="{{ route('products.show', ['product' => $related->id]) }}" class="text-decoration-none">
                                <div class="position-relative overflow-hidden" style="height: 250px;">
                                    <img src="{{ asset('storage/' . $related->image_produit) }}" 
                                         alt="{{ $related->nom }}" 
                                         class="img-fluid w-100 h-100"
                                         style="object-fit: cover;">
                                    @if($related->personnalisable)
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-palette"></i> Sur mesure
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body text-center p-3">
                                    <h6 class="card-title fw-bold mb-2 text-dark">{{ $related->nom }}</h6>
                                    <div class="mb-2">
                                        <span class="text-primary fw-bold fs-5">
                                            {{ number_format($related->prix_base, 2, ',', ' ') }} €
                                        </span>
                                        @if(!empty($related->prix_ancien) && $related->prix_ancien > $related->prix_base)
                                            <span class="text-muted text-decoration-line-through small ms-2">
                                                {{ number_format($related->prix_ancien, 2, ',', ' ') }} €
                                            </span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $related->sousCategorie->nom ?? '' }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-emoji-frown fs-1"></i>
                            <p class="mt-2">Aucun produit similaire trouvé dans cette collection.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(imageUrl, element) {
        // Changer l'image principale
        document.getElementById('main-image').src = imageUrl;
        
        // Gérer l'effet actif sur les miniatures
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        thumbnails.forEach(thumb => thumb.classList.remove('active'));
        element.classList.add('active');
    }
</script>

@endsection