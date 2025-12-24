@extends('layouts.frontendapp')

@section('content')
<main>
    <div class="mt-4">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shop Grid</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="mt-8 mb-lg-14 mb-8">
        <div class="container">
            <div class="row gx-10">
                <!-- Sidebar start -->
                <aside class="col-xl-3 col-lg-4 col-md-5">
                    <div class="bg-light rounded p-4 mb-6 d-none d-lg-block">
                        <h5 class="mb-4">Categories</h5>
                        <ul class="list-unstyled categories">
                            @foreach($categories as $category)
                                <li>
                                    <a href="#" class="text-inherit">{{ $category->nom }}</a>
                                    @if($category->sousCategories->isNotEmpty())
                                    <ul>
                                        @foreach($category->sousCategories as $subCategory)
                                            <li><a href="#" class="text-inherit">{{ $subCategory->nom }}</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="bg-light rounded p-4 mb-6 d-none d-lg-block">
                        <h5 class="mb-4">Filtres</h5>
                        <!-- Exemple simple de filtre -->
                        <div class="mb-3">
                            <label class="form-label d-block">Price Range</label>
                            <input type="range" class="form-range" min="0" max="500" step="5" id="priceRange">
                        </div>
                        <button class="btn btn-primary w-100">Appliquer filtres</button>
                    </div>
                </aside>
                <!-- Sidebar end -->

                <!-- Main content -->
                <section class="col-xl-9 col-lg-8 col-md-7">
                    <div class="card mb-4 bg-light border-0">
                        <div class="card-body p-9">
                            <h2 class="mb-0 fs-1">Shop Grid</h2>
                        </div>
                    </div>

                    <div class="d-lg-flex justify-content-between align-items-center mb-4">
                        <div class="mb-3 mb-lg-0">
                            <p class="mb-0">
                                <span class="text-dark">{{ $products->count() }}</span> Products found
                            </p>
                        </div>
                    </div>

                    <div class="row g-4 row-cols-xl-3 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                        @foreach ($products as $product)
                        <div class="col">
                            <div class="card card-product h-100">
                                <div class="card-body">
                                    <div class="text-center position-relative">
                                        @if($product->promo)
                                        <div class="position-absolute top-0 start-0">
                                            <span class="badge bg-danger">Sale</span>
                                        </div>
                                        @endif

                                        <a href="{{ route('products.show', $product->id) }}">
                                            <img src="{{ asset('storage/' . $product->image_produit) }}" alt="{{ $product->nom }}" class="mb-3 img-fluid" />
                                        </a>

                                        <div class="card-product-action">
                                            <a href="#quickViewModal" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal" title="Quick View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="#" class="btn-action" title="Wishlist"><i class="bi bi-heart"></i></a>
                                            <a href="#" class="btn-action" title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="text-small mb-1">
                                        <a href="#" class="text-decoration-none text-muted"><small>{{ $product->categorie ?? 'Category' }}</small></a>
                                    </div>

                                    <h2 class="fs-6">
                                        <a href="{{ route('products.show', $product->id) }}" class="text-inherit text-decoration-none">{{ $product->nom }}</a>
                                    </h2>

                                    <div class="text-warning">
                                        <small>
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < floor($product->rating))
                                                    <i class="bi bi-star-fill"></i>
                                                @elseif ($i < ceil($product->rating))
                                                    <i class="bi bi-star-half"></i>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                            @endfor
                                        </small>
                                        <span class="text-muted small">{{ number_format($product->rating, 1) }} ({{ $product->reviews_count }})</span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            <span class="text-dark">${{ number_format($product->prix_base, 2) }}</span>
                                            @if($product->old_price)
                                            <span class="text-decoration-line-through text-muted">${{ number_format($product->old_price, 2) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                             @if($product->personnalisable)
                                                    <a href="{{ route('produits.personnalisation', $product->id) }}" class="btn btn-primary">
                                                        Personnaliser 
                                                    </a>
                                            @else
                                            <a href="#" class="btn btn-primary btn-sm">
                                                <i class="feather-icon icon-plus"></i> Ajouter au panier
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row mt-8">
                        <div class="col">
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>


{{-- Modal Quick View : adapter au besoin --}}
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-8">
                <button type="button" class="btn-close position-absolute top-0 end-0 me-3 mt-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row">
                    <div class="col-lg-6">
                        <div id="productModal" class="product productModal">
                            <div class="zoom" style="background-image: url('{{ asset('storage/' . $product->image_produit) }}')">
                                <img src="{{ asset('storage/' . $product->image_produit) }}" alt="{{ $product->nom }}" />
                            </div>
                            {{-- Miniatures à adapter si vous avez plusieurs images --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ps-lg-8 mt-6 mt-lg-0">
                            <a href="#" class="mb-4 d-block">{{ $product->categorie ?? 'Category' }}</a>
                            <h2 class="mb-1 h1">{{ $product->nom }}</h2>

                            <div class="mb-4">
                                <small class="text-warning">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < floor($product->rating))
                                            <i class="bi bi-star-fill"></i>
                                        @elseif ($i < ceil($product->rating))
                                            <i class="bi bi-star-half"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </small>
                                <a href="#" class="ms-2">({{ $product->reviews_count ?? 0 }} reviews)</a>
                            </div>

                            <div class="fs-4">
                                <span class="fw-bold text-dark">${{ number_format($product->prix_base ?? $product->price, 2) }}</span>
                                @if(!empty($product->old_price))
                                <span class="text-decoration-line-through text-muted">${{ number_format($product->old_price, 2) }}</span>
                                @endif
                                @if(!empty($product->promo))
                                <span><small class="fs-6 ms-2 text-danger">{{ $product->promo }}% Off</small></span>
                                @endif
                            </div>

                            <hr class="my-6" />

                            {{-- Boutons poids à personnaliser si besoin --}}
                            <div class="mb-4">
                                <button type="button" class="btn btn-outline-secondary">250g</button>
                                <button type="button" class="btn btn-outline-secondary">500g</button>
                                <button type="button" class="btn btn-outline-secondary">1kg</button>
                            </div>

                            {{-- Quantité --}}
                            <div>
                                <div class="input-group input-spinner">
                                    <input type="button" value="-" class="button-minus btn btn-sm" data-field="quantity" />
                                    <input type="number" step="1" max="10" value="1" name="quantity" class="quantity-field form-control-sm form-input" />
                                    <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity" />
                                </div>
                            </div>

                            <div class="mt-3 row justify-content-start g-2 align-items-center">
                                <div class="col-lg-4 col-md-5 col-6 d-grid">
                                   <button type="button" class="btn btn-primary">
                                        <i class="feather-icon icon-shopping-bag me-2"></i>
                                        
                                             @if($product->personnalisable)
                                                    <a href="{{ route('produits.personnalisation', $product->id) }}" class="btn btn-primary">
                                                        Personnaliser 
                                                    </a>
                                            @else
                                            <a href="#" class="btn btn-primary btn-sm">
                                                <i class="feather-icon icon-plus"></i> Ajouter au panier
                                            </a>
                                            @endif
                                        
                                    </button> 
                                </div>
                                <div class="col-md-4 col-5">
                                    <a href="#" class="btn btn-light" title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                    <a href="#" class="btn btn-light" title="Wishlist"><i class="feather-icon icon-heart"></i></a>
                                </div>
                            </div>

                            <hr class="my-6" />

                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Product Code:</td>
                                        <td>{{ $product->code ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Availability:</td>
                                        <td>{{ $product->stock_status ?? 'In Stock' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Type:</td>
                                        <td>{{ $product->type_produit ?? 'Category' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping:</td>
                                        <td>
                                            <small>{{ $product->shipping_info ?? '01 day shipping.' }} <span class="text-muted">({{ $product->pickup_info ?? 'Free pickup today' }})</span></small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
