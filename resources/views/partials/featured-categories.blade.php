<!-- Category Section Start -->
<section class="mb-lg-10 mt-lg-14 my-8">
    <div class="">
        <div class="row">
            <div class="col-12 mb-6">
                <h3 class="mb-0">Catégories en vedette</h3>
            </div>
        </div>

        <div class="category-slider">
            @foreach ($sousCategories as $sousCategorie)
                <div class="item">
                    <a href="{{ route('shop.grid', ['sous_categorie' => $sousCategorie->id]) }}" class="text-decoration-none text-inherit">
                        <div class="card card-product mb-lg-4">
                            <div class="card-body text-center py-8">
                                <img src="{{ asset('storage/' . $sousCategorie->image) }}" alt="{{ $sousCategorie->nom }}" class="mb-3 img-fluid" />
                                <div class="text-truncate">{{ $sousCategorie->nom }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Category Section End -->
{{-- 
<section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 mb-3 mb-lg-0">
                <div class="py-10 px-8 rounded" style="background: url('{{ asset('assets/images/banner/grocery-banner.png') }}') no-repeat; background-size: cover; background-position: center">
                    <h3 class="fw-bold mb-1">Fruits & légumes</h3>
                    <p class="mb-4">
                        Jusqu'à <span class="fw-bold">30%</span> de réduction
                    </p>
                    <a href="{{ route('shop.grid', ['category' => 'fruits-legumes']) }}" class="btn btn-dark">Acheter maintenant</a>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="py-10 px-8 rounded" style="background: url('{{ asset('assets/images/banner/grocery-banner-2.jpg') }}') no-repeat; background-size: cover; background-position: center">
                    <h3 class="fw-bold mb-1">Pains fraîchement cuits</h3>
                    <p class="mb-4">
                        Jusqu'à <span class="fw-bold">25%</span> de réduction
                    </p>
                    <a href="{{ route('shop.grid', ['category' => 'pains']) }}" class="btn btn-dark">Acheter maintenant</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
