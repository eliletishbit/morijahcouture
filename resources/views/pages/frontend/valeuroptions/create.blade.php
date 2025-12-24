{{-- creer valeur option --}}
@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Ajouter une nouvelle Valeur d'Option</h1>

    <form action="{{ route('admin.valeur-options.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="option_personnalisation_id" class="form-label">Option de Personnalisation</label>
            <select name="option_personnalisation_id" id="option_personnalisation_id" class="form-control @error('option_personnalisation_id') is-invalid @enderror" required>
                <option value="">-- Sélectionner --</option>
                @foreach($options as $option)
                    <option value="{{ $option->id }}" {{ old('option_personnalisation_id') == $option->id ? 'selected' : '' }}>
                        {{ $option->nom_option }}
                    </option>
                @endforeach
            </select>
            @error('option_personnalisation_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="valeur" class="form-label">Valeur</label>
            <input type="text" name="valeur" id="valeur" class="form-control @error('valeur') is-invalid @enderror" value="{{ old('valeur') }}" required>
            @error('valeur')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label">Image (optionnelle)</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="sous_option_personnalisation_id" class="form-label">Sous Option de Personnalisation (optionnelle)</label>
            <select name="sous_option_personnalisation_id" id="sous_option_personnalisation_id" class="form-control @error('sous_option_personnalisation_id') is-invalid @enderror">
                <option value="">-- Sélectionner --</option>
                @foreach($sousOptionsP as $sousOption)
                    <option value="{{ $sousOption->id }}" {{ old('sous_option_personnalisation_id') == $sousOption->id ? 'selected' : '' }}>
                        {{ $sousOption->nom_sous_option ?? 'Sous Option ' . $sousOption->id }}
                    </option>
                @endforeach
            </select>
            @error('sous_option_personnalisation_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="prix" class="form-label">Prix (optionnel)</label>
            <input type="number" step="0.01" name="prix" id="prix" class="form-control @error('prix') is-invalid @enderror" value="{{ old('prix') }}">
            @error('prix')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.valeur-options.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
