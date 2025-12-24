@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier le Catalogue d'Échantillons #{{ $catalogue->id }}</h1>

    <form action="{{ route('admin.catalogue-echantillons.update', $catalogue->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $catalogue->nom) }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description (optionnelle)</label>
            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $catalogue->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label">Image (optionnelle)</label>
            @if($catalogue->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $catalogue->image) }}" alt="Image actuelle" width="100">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.catalogue-echantillons.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
