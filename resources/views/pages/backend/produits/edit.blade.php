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

         {{-- image modele --}}
        <div class="col-md-6">
            <div class="mb-3">
                <label for="image_modele_neutre" class="form-label">Modèle neutre (base pour personnalisation)</label>
                <input type="file" class="form-control @error('image_modele_neutre') is-invalid @enderror" 
                    id="image_modele_neutre" name="image_modele_neutre" accept="image/png,image/jpeg">
                @error('image_modele_neutre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @if(isset($produit) && $produit->image_modele_neutre)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $produit->image_modele_neutre) }}" alt="Modèle neutre" style="height: 80px;">
                        <p class="small text-muted mt-1">Format recommandé : PNG avec dimensions exactes</p>
                    </div>
                @endif
            </div>
        </div>


       

        <!-- Personnalisation : Catégories d'options et options -->
        @php
            // Récupérer les valeurs sélectionnées une fois pour toutes
            $selectedValues = [];
            foreach($product->optionsPersonnalisation as $selected) {
                $selectedValues[$selected->id] = $selected->pivot->valeur_option_id;
            }
        @endphp

        @if (isset($categoriesOptions) && $categoriesOptions->count())
            <h3 class="mt-4">Options de personnalisation</h3>

            @foreach ($categoriesOptions as $categorie)
                @if($categorie->options && $categorie->options->count())
                    <div class="category-block mb-4">
                        <h4 class="bg-light p-2">{{ $categorie->nom_categorie }}</h4>
                        
                        @foreach ($categorie->options as $option)
                            <div class="option-block mb-3 p-3 border rounded">
                                <label for="option_{{ $option->id }}" class="form-label fw-bold">
                                    {{ $option->nom_option }}
                                </label>
                                
                                <select name="options[{{ $option->id }}]" id="option_{{ $option->id }}" class="form-select">
                                    <option value="">-- Choisissez --</option>
                                    @foreach ($option->valeurs as $valeur)
                                        <option value="{{ $valeur->id }}"
                                            {{ (old("options.$option->id", $selectedValues[$option->id] ?? null) == $valeur->id) ? 'selected' : '' }}>
                                            {{ $valeur->valeur }}
                                            @if($valeur->prix > 0) (+{{ number_format($valeur->prix, 2) }} €) @endif
                                        </option>
                                    @endforeach
                                </select>

                                {{-- Sous-options si besoin --}}
                                @if($option->sousOptions && $option->sousOptions->count())
                                    @foreach ($option->sousOptions as $sousOption)
                                        @php
                                            $selectedSousValue = $sousOption->pivot->valeur_option_id ?? null;
                                        @endphp
                                        <div class="mt-2 ms-3">
                                            <label for="sousoption_{{ $sousOption->id }}" class="form-label">
                                                {{ $sousOption->nom_sous_option }}
                                            </label>
                                            <select name="sousoptions[{{ $sousOption->id }}]" id="sousoption_{{ $sousOption->id }}" class="form-select">
                                                <option value="">-- Choisissez --</option>
                                                @foreach ($sousOption->valeurs as $sousValeur)
                                                    <option value="{{ $sousValeur->id }}"
                                                        {{ old("sousoptions.$sousOption->id", $selectedSousValue) == $sousValeur->id ? 'selected' : '' }}>
                                                        {{ $sousValeur->valeur }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        @else
            <div class="alert alert-info mt-3">
                Aucune option de personnalisation disponible. Veuillez d'abord créer des catégories, options et valeurs.
            </div>
        @endif

        <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">Annuler</a>

    </form>
</div>
@endsection
