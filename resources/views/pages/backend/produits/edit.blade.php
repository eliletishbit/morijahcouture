@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier le produit : {{ $product->nom }}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productFormEdit">
        @csrf
        @method('PUT')

        <!-- Champs classique -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $product->nom) }}" required />
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="prix_base" class="form-label">Prix de base (€)</label>
            <input type="number" step="0.01" name="prix_base" class="form-control" value="{{ old('prix_base', $product->prix_base) }}" required />
        </div>

        <!-- Collections, Sous-catégories, Matériaux -->
        <div class="mb-3">
            <label for="collection_id" class="form-label">Collection (optionnelle)</label>
            <select name="collection_id" class="form-select">
                <option value="">Aucune</option>
                @foreach($collections as $collection)
                <option value="{{ $collection->id }}" @selected(old('collection_id', $product->collection_id) == $collection->id)>{{ $collection->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sous_categorie_id" class="form-label">Sous-catégorie</label>
            <select name="sous_categorie_id" class="form-select" required>
                @foreach($sousCategories as $sousCategorie)
                <option value="{{ $sousCategorie->id }}" @selected(old('sous_categorie_id', $product->sous_categorie_id) == $sousCategorie->id)>{{ $sousCategorie->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="materiau_id" class="form-label">Matériau (optionnel)</label>
            <select name="materiau_id" class="form-select">
                <option value="">Aucun</option>
                @foreach($materiaux as $materiau)
                <option value="{{ $materiau->id }}" @selected(old('materiau_id', $product->materiau_id) == $materiau->id)>{{ $materiau->nom }}</option>
                @endforeach
            </select>
        </div>

        <!-- Personnalisable, Type, Gamme -->
        <div class="mb-3">
            <label for="personnalisable" class="form-label">Personnalisable</label>
            <select name="personnalisable" class="form-select" required>
                <option value="0" @selected(old('personnalisable', $product->personnalisable) == 0)>Non</option>
                <option value="1" @selected(old('personnalisable', $product->personnalisable) == 1)>Oui</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="type_produit" class="form-label">Type de produit</label>
            <input type="text" name="type_produit" class="form-control" value="{{ old('type_produit', $product->type_produit) }}" required />
        </div>

        <div class="mb-3">
            <label for="gamme_taille" class="form-label">Gamme taille</label>
            <input type="text" name="gamme_taille" class="form-control" value="{{ old('gamme_taille', $product->gamme_taille) }}" />
        </div>

        <!-- Délais -->
        <div class="mb-3">
            <label for="delai_fabrication" class="form-label">Délai fabrication (jours)</label>
            <input type="number" name="delai_fabrication" class="form-control" value="{{ old('delai_fabrication', $product->delai_fabrication) }}" />
        </div>

        <div class="mb-3">
            <label for="delai_livraison" class="form-label">Délai livraison (jours)</label>
            <input type="number" name="delai_livraison" class="form-control" value="{{ old('delai_livraison', $product->delai_livraison) }}" />
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label for="image_produit" class="form-label">Changer l’image du produit (facultatif)</label>
            <input type="file" name="image_produit" class="form-control" />
            @if ($product->image_produit)
            <img src="{{ asset('storage/' . $product->image_produit) }}" alt="{{ $product->nom }}" style="max-width: 150px; margin-top: 10px;" />
            @endif
        </div>

        <!-- Personnalisation : Catégories d'options et options -->
        @if (isset($categoriesOptions) && $categoriesOptions->count())
            <h3>Options de personnalisation</h3>

            @foreach ($categoriesOptions as $categorie)
                <div class="category-block">
                    <h4>{{ $categorie->nom_categorie }}</h4>
                    @foreach ($categorie->options as $option)
                        <div class="option-block mb-3">
                            <label for="option_{{ $option->id }}">{{ $option->nom_option }}</label>
                            <select name="options[{{ $option->id }}]" id="option_{{ $option->id }}" class="form-select">
                                @foreach ($option->valeurs as $valeur)
                                    <option value="{{ $valeur->id }}"
                                     @selected(old("options.$option->id", optional($product->optionsValeurs->where('id', $option->id)->first())->pivot->valeur_option_id) == $valeur->id)>
                                     {{ $valeur->valeur }}</option>
                                @endforeach
                            </select>

                            @if ($option->sousOptions->count())
                                @foreach ($option->sousOptions as $sousOption)
                                    <label for="sousoption_{{ $sousOption->id }}">{{ $sousOption->nom_sous_option }}</label>
                                    <select name="sousoptions[{{ $sousOption->id }}]" id="sousoption_{{ $sousOption->id }}" class="form-select mb-2">
                                        @foreach ($sousOption->valeurs as $sousValeur)
                                            <option value="{{ $sousValeur->id }}"
                                             @selected(old("sousoptions.$sousOption->id", optional($product->sousOptionsValeurs->where('id', $sousOption->id)->first())->pivot->valeur_option_id) == $sousValeur->id)>
                                             {{ $sousValeur->valeur }}</option>
                                        @endforeach
                                    </select>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p>Aucune option personnalisée disponible.</p>
        @endif

        <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">Annuler</a>

    </form>
</div>
@endsection
