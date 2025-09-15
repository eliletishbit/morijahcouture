@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier l'Échantillon #{{ $echantillon->id }}</h1>

    <form action="{{ route('admin.echantillons.update', $echantillon->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $echantillon->nom) }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $echantillon->type) }}" required>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="catalogue_id" class="form-label">Catalogue d'Échantillons</label>
            <select name="catalogue_id" id="catalogue_id" class="form-control @error('catalogue_id') is-invalid @enderror" required>
                <option value="">-- Sélectionner --</option>
                @foreach($catalogues as $catalogue)
                    <option value="{{ $catalogue->id }}" {{ (old('catalogue_id', $echantillon->catalogue_id) == $catalogue->id) ? 'selected' : '' }}>
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
            @if($echantillon->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $echantillon->image) }}" alt="Image actuelle" width="100">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.echantillons.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
