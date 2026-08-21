<section class="my-5 px-6 container-fluid">
    <div class="d-flex justify-content-between align-items-start mb-4">
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

    {{-- GRILLE DYNAMIQUE DES PRODUITS --}}
    <div class="row">
        @forelse($tenueproduits as $produit)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 bg-secondary text-white border-0 shadow">
                    <!-- Image du produit -->
                    <img src="{{ asset('storage/' . $produit->image_produit) }}" 
                         class="card-img-top" 
                         alt="{{ $produit->nom }}" 
                         style="height: 350px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column justify-content-between">
                        <!-- Nom du produit (limité pour le design) -->
                        <h5 class="card-title text-truncate">{{ $produit->nom }}</h5>
                        <p class="card-text text-muted " style="color:gold;">{{ $produit->prix_base }} €</p>
                        
                        <!-- Bouton d'action pour la Modal -->
                        <button class="btn btn-light w-100 open-product-modal" 
                                data-bs-toggle="modal" 
                                data-bs-target="#productModal"
                                data-nom="{{ $produit->nom }}"
                                data-desc="{{ $produit->description }}"
                                data-image="{{ asset('storage/' . $produit->image_produit) }}"
                                data-pieces="{{ json_encode($produit->pieces) }}">
                            Voir le style
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-4">
                <p class="text-muted">Aucune idée de tenue disponible pour le moment.</p>
            </div>
        @endforelse
    </div>
</section>

{{-- Modal Popup --}}
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true" aria-labelledby="productModalLabel">
  <div class="modal-dialog modal-xl text-dark"> {{-- Ajout text-dark pour la lisibilité --}}
    <div class="modal-content" style="height: 80vh;">
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
            {{-- Pièces générées dynamiquement par le JavaScript --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- SCRIPT JAVASCRIPT POUR REMPLIR LA MODAL DYNAMIQUEMENT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.open-product-modal');
    
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            // Récupération des données du bouton
            const nom = this.getAttribute('data-nom');
            const desc = this.getAttribute('data-desc');
            const image = this.getAttribute('data-image');
            const pieces = JSON.parse(this.getAttribute('data-pieces') || '[]');

            // Injection dans la Modal
            document.getElementById('modalProductTitle').textContent = nom;
            document.getElementById('modalProductDescription').textContent = desc;
            document.getElementById('modalProductImage').src = image;

            // Remplissage de la liste des pièces liées
            const piecesList = document.getElementById('modalPiecesList');
            piecesList.innerHTML = ''; // Vider les anciennes pièces

            if(pieces.length === 0) {
                piecesList.innerHTML = '<p class="text-muted">Aucune pièce individuelle enregistrée.</p>';
            } else {
                pieces.forEach(piece => {
                    piecesList.innerHTML += `
                        <div class="border p-2 rounded text-center" style="width: 100px;">
                            <small class="d-block text-truncate">${piece.nom || 'Pièce'}</small>
                        </div>
                    `;
                });
            }
        });
    });
});
</script>
