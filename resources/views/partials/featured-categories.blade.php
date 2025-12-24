<!-- Category Section Start -->
<section class="mb-lg-10 mt-lg-14 my-8">
    <div class="">
        <div class="row">
            <div class="col-12 mb-6">
                <h3 class="mb-0">Sous Catégories en vedette</h3>
            </div>
        </div>

        <div class="category-slider">
            @foreach ($sousCategories as $sousCategorie)
                <div class="item">
                    <a href="{{ route('collections.index', ['id' => $sousCategorie->id]) }}" class="text-decoration-none text-inherit">
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




