@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Ajouter un produit</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required />
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="prix_base" class="form-label">Prix de base (€)</label>
            <input type="number" step="0.01" name="prix_base" class="form-control" value="{{ old('prix_base') }}" required />
        </div>

        <div class="mb-3">
            <label for="collection_id" class="form-label">Collection (optionnelle)</label>
            <select name="collection_id" class="form-select">
                <option value="">Aucune</option>
                @foreach($collections as $collection)
                <option value="{{ $collection->id }}" @selected(old('collection_id') == $collection->id)>{{ $collection->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sous_categorie_id" class="form-label">Sous-catégorie</label>
            <select name="sous_categorie_id" class="form-select" required id="sousCategorieSelect">
                @foreach($sousCategories as $sousCategorie)
                <option value="{{ $sousCategorie->id }}" @selected(old('sous_categorie_id') == $sousCategorie->id) data-name="{{ strtolower($sousCategorie->nom) }}">{{ $sousCategorie->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="materiau_id" class="form-label">Matériau (optionnel)</label>
            <select name="materiau_id" class="form-select">
                <option value="">Aucun</option>
                @foreach($materiaux as $materiau)
                <option value="{{ $materiau->id }}" @selected(old('materiau_id') == $materiau->id)>{{ $materiau->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="personnalisable" class="form-label">Personnalisable</label>
            <select name="personnalisable" class="form-select" required>
                <option value="0" @selected(old('personnalisable') === '0')>Non</option>
                <option value="1" @selected(old('personnalisable') === '1')>Oui</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="type_produit" class="form-label">Type de produit</label>
            <input type="text" name="type_produit" class="form-control" value="{{ old('type_produit') }}" required />
        </div>

        <div class="mb-3">
            <label for="gamme_taille" class="form-label">Gamme taille</label>
            <input type="text" name="gamme_taille" class="form-control" value="{{ old('gamme_taille') }}" />
        </div>

        <div class="mb-3">
            <label for="delai_fabrication" class="form-label">Délai fabrication (jours)</label>
            <input type="number" name="delai_fabrication" class="form-control" value="{{ old('delai_fabrication') }}" />
        </div>

        <div class="mb-3">
            <label for="delai_livraison" class="form-label">Délai livraison (jours)</label>
            <input type="number" name="delai_livraison" class="form-control" value="{{ old('delai_livraison') }}" />
        </div>

        <div class="mb-3">
            <label for="image_produit" class="form-label">Image du produit</label>
            <input type="file" name="image_produit" class="form-control" required />
        </div>

        <!-- Bloc dynamique des pièces : caché par défaut -->
        <div id="piecesSection" style="display:none;">
            <h4>Ajouter des pièces (jusqu'à 7)</h4>
            <div id="piecesContainer">
                <!-- Champs pièces ajoutés ici via JS -->
            </div>
            <button type="button" id="addPieceBtn" class="btn btn-secondary">+ Ajouter une pièce</button>
        </div>

        <button type="submit" class="btn btn-success mt-3">Créer</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sousCategorieSelect = document.getElementById('sousCategorieSelect');
        const piecesSection = document.getElementById('piecesSection');
        const piecesContainer = document.getElementById('piecesContainer');
        const addPieceBtn = document.getElementById('addPieceBtn');
        let piecesCount = 0;
        const maxPieces = 7;

        function updatePiecesSectionVisibility() {
            const selectedOption = sousCategorieSelect.options[sousCategorieSelect.selectedIndex];
            const catName = selectedOption.getAttribute('data-name');
            piecesSection.style.display = catName === 'tenues' ? 'block' : 'none';
            if (catName !== 'tenues') {
                piecesContainer.innerHTML = '';
                piecesCount = 0;
            }
        }

        addPieceBtn.addEventListener('click', function () {
            if (piecesCount >= maxPieces) return;

            piecesCount++;
            const index = piecesCount - 1;
            const pieceField = document.createElement('div');
            pieceField.classList.add('mb-3');
            pieceField.innerHTML = `
                <label class="form-label">Pièce #${piecesCount} pièce </label>
                <input type="number" name="pieces[]" class="form-control" placeholder="ID du produit pièce" min="1" required />
                <button type="button" class="btn btn-danger btn-sm mt-1 remove-piece-btn">Supprimer</button>
            `;
            piecesContainer.appendChild(pieceField);

            // Gestion suppression
            pieceField.querySelector('.remove-piece-btn').addEventListener('click', () => {
                piecesContainer.removeChild(pieceField);
                piecesCount--;
                // Réorganiser les labels si nécessaire
            });
        });

        sousCategorieSelect.addEventListener('change', updatePiecesSectionVisibility);

        // Initial check
        updatePiecesSectionVisibility();
    });
</script>
@endsection
