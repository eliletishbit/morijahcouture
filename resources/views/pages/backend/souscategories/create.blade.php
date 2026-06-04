{{-- creer une sous categorie --}}

@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Ajouter une sous-catégorie</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.sous-categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
    </div>

    <div class="mb-3">
        <label for="categorie_id" class="form-label">Catégorie parente</label>
        <select name="categorie_id" id="categorie_id" class="form-select" required>
            <option value="">Sélectionnez une catégorie</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('categorie_id') == $category->id)>{{ $category->nom }}</option>
            @endforeach
        </select>
    </div>

    {{-- choisir la categorie d'option de personalisation aproprié --}}
    <div class="mb-3">
        <label for="categorie_option_personnalisation_id" class="form-label">
            Catégorie d'options de personnalisation
        </label>
        <select name="categorie_option_personnalisation_id" id="categorie_option_personnalisation_id" 
                class="form-select @error('categorie_option_personnalisation_id') is-invalid @enderror">
            <option value="">-- Aucune --</option>
            @foreach($categoriesOptions as $catOption)
                <option value="{{ $catOption->id }}" 
                    {{ old('categorie_option_personnalisation_id', $sousCategorie->categorie_option_personnalisation_id ?? '') == $catOption->id ? 'selected' : '' }}>
                    {{ $catOption->nom_categorie }}
                </option>
            @endforeach
        </select>
        <small class="form-text text-muted">
            Associer à une catégorie d'options pour activer la personnalisation des produits de cette sous-catégorie.
        </small>
        @error('categorie_option_personnalisation_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Champ pour l'upload de l'image -->
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" name="image" id="image" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-success">Créer</button>
    <a href="{{ route('admin.sous-categories.index') }}" class="btn btn-secondary">Annuler</a>
</form>

</div>
@endsection
