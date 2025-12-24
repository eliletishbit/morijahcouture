@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Ajouter un Échantillon</h1>

    <form action="{{ route('admin.echantillons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}" required>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="catalogue_id" class="form-label">Catalogue d'Échantillons</label>
            <select name="catalogue_id" id="catalogue_id" class="form-control @error('catalogue_id') is-invalid @enderror" required>
                <option value="">-- Sélectionner --</option>
                @foreach($catalogues as $catalogue)
                    <option value="{{ $catalogue->id }}" {{ old('catalogue_id') == $catalogue->id ? 'selected' : '' }}>
                        {{ $catalogue->nom }}
                    </option>
                @endforeach
            </select>
            @error('catalogue_id')
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

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.echantillons.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
