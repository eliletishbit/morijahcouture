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

        <!-- Champs produit classiques -->
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
            <select name="sous_categorie_id" class="form-select" required>
                @foreach($sousCategories as $sousCategorie)
                <option value="{{ $sousCategorie->id }}" @selected(old('sous_categorie_id') == $sousCategorie->id)>{{ $sousCategorie->nom }}</option>
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

        <!-- Personnalisable -->
        <div class="mb-3">
            <label for="personnalisable" class="form-label">Personnalisable</label>
            <select name="personnalisable" id="personnalisable" class="form-select" required>
                <option value="0" @selected(old('personnalisable') === '0')>Non</option>
                <option value="1" @selected(old('personnalisable') === '1')>Oui</option>
            </select>
        </div>

        <!-- Type produit -->
        <div class="mb-3">
            <label for="type_produit" class="form-label">Type de produit</label>
            <input type="text" name="type_produit" class="form-control" value="{{ old('type_produit') }}" required />
        </div>

        <!-- Gamme taille -->
        <div class="mb-3">
            <label for="gamme_taille" class="form-label">Gamme taille</label>
            <input type="text" name="gamme_taille" class="form-control" value="{{ old('gamme_taille') }}" />
        </div>

        <!-- Délais -->
        <div class="mb-3">
            <label for="delai_fabrication" class="form-label">Délai fabrication (jours)</label>
            <input type="number" name="delai_fabrication" class="form-control" value="{{ old('delai_fabrication') }}" />
        </div>

        <div class="mb-3">
            <label for="delai_livraison" class="form-label">Délai livraison (jours)</label>
            <input type="number" name="delai_livraison" class="form-control" value="{{ old('delai_livraison') }}" />
        </div>

        <!-- Image principale -->
        <div class="mb-3">
            <label for="image_produit" class="form-label">Image du produit</label>
            <input type="file" name="image_produit" class="form-control" required />
        </div>

        <!-- Bloc catégorie option personnalisable, caché par défaut -->
        <div id="personnalisable-categorie-block" class="mb-3" style="display:none">
            <label for="categorie_option_personnalisation_id" class="form-label">Catégorie d'option de personnalisation</label>
            <select name="categorie_option_personnalisation_id" id="categorie_option_personnalisation_id" class="form-select">
                <option value="">-- Sélectionner une catégorie --</option>
                @foreach ($categoriesOptions as $categorie)
                <option value="{{ $categorie->id }}" @selected(old('categorie_option_personnalisation_id') == $categorie->id)>{{ $categorie->nom_categorie }}</option>
                @endforeach
            </select>
        </div>

        <!-- Bloc options personnalisables dynamiques, caché par défaut -->
        <div id="personnalisable-options" style="display:none;"></div>

        <!-- Bloc upload image personnalisée, caché par défaut -->
        <div id="personnalisable-image-upload" class="mb-3" style="display:none">
            <label for="image_personnalisee" class="form-label">Image personnalisée du produit</label>
            <input type="file" name="image_personnalisee" id="image_personnalisee" class="form-control" accept="image/*" />
        </div>


        <!-- inputs cachés dans la vue -->
        <input type="hidden" name="option_personnalisation_id" id="option_personnalisation_id" value="" />
        <input type="hidden" name="valeur_option_id" id="valeur_option_id" value="" />

        <button type="submit" class="btn btn-success mt-3">Créer</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">Annuler</a>
    </form>
</div>
@endsection 

