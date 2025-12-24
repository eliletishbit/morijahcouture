@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Ajouter une nouvelle Option de Personnalisation</h1>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.option-personnalisations.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="categorie_option_personnalisation_id" class="form-label">Catégorie de personnalisation</label>
        
            <select name="categorie_option_personnalisation_id" id="categorie_option_personnalisation_id" class="form-control @error('categorie_option_personnalisation_id') is-invalid @enderror" required>
                <option value="">-- Sélectionner une catégorie --</option>
                @foreach ($categoriesOptionsP as $categorie) 
                    <option value="{{ $categorie->id }}" {{ old('categorie_option_personnalisation_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom_categorie }}
                    </option>
                @endforeach
            </select>
            @error('categorie_option_personnalisation_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="nom_option" class="form-label">Nom de l'option</label>
            <input type="text" name="nom_option" id="nom_option" class="form-control @error('nom_option') is-invalid @enderror" value="{{ old('nom_option') }}" required>
            @error('nom_option')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="type_option" class="form-label">Type d'option</label>
            <input type="text" name="type_option" id="type_option" class="form-control @error('type_option') is-invalid @enderror" value="{{ old('type_option') }}" required>
            @error('type_option')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.option-personnalisations.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
