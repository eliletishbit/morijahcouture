<section class="my-5 px-6 container-fluid" >
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h2 class="display-5 fw-bold" style="color:white;">Idées de Tenues</h2>
            <p class="mb-0 lead" style="color:white;">
                Inspirez-vous de notre communauté. Nos clients sont les meilleurs <br> pour styliser leurs vêtements et chaussures Morijahcouture.
            </p>
        </div>
        <div>
            <a href="#!" class="btn btn-primary rounded-pill">Découvrez leurs tenues</a>
        </div>
    </div>

    {{-- Carousel --}}
    <div id="ideetenueCarousel" class="carousel slide" data-bs-ride="false" style="max-width: 100%;">
        <div class="carousel-inner">
            @foreach($tenueproduits as $index => $product)
            <div class="carousel-item @if($index == 0) active @endif">
                <div class="position-relative" style="max-width: 300px; margin: auto;">
                    <img src="{{ asset('storage/' . $product->image_produit) }}" class="d-block w-100 product-image" alt="{{ $product->nom }}">

                    <button type="button" class="btn btn-dark position-absolute buy-look-btn"
                        style="bottom: 10px; left: 50%; transform: translateX(-50%); opacity: 0; transition: opacity 0.3s;"
                        data-bs-toggle="modal" data-bs-target="#productModal"
                        data-product="{{ htmlspecialchars(json_encode($product), ENT_QUOTES, 'UTF-8') }}">
                        Acheter le look
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Bouton de navigation uniquement à droite --}}
        <button class="carousel-control-next" type="button" data-bs-target="#ideetenueCarousel" data-bs-slide="next" style="right: 0;">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>
</section>

{{-- Modal Popup --}}
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true" aria-labelledby="productModalLabel">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="height: 90vh;">
      <div class="modal-header border-0">
        <button type="button" class="btn-close fs-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex h-100">
        <div class="col-6 pe-3 d-flex align-items-center justify-content-center">
          <img id="modalProductImage" src="" alt="" class="img-fluid h-100" style="object-fit: contain;">
        </div>
        <div class="col-6 d-flex flex-column">
          <h3 id="modalProductTitle"></h3>
          <p id="modalProductDescription" class="flex-grow-1 overflow-auto"></p>
          <h5>Pièces de la tenue</h5>
          <div id="modalPiecesList" class="d-flex flex-wrap gap-3 overflow-auto" style="max-height: 30%;">
            {{-- Pièces générées dynamiquement --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
