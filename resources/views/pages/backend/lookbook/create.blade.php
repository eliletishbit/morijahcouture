@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Créer un nouveau Lookbook</h1>

    <form action="{{ route('admin.lookbooks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" class="form-control" value="{{ old('titre') }}" required>
            @error('titre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sous_titre" class="form-label">Sous-titre</label>
            <input type="text" id="sous_titre" name="sous_titre" class="form-control" value="{{ old('sous_titre') }}">
            @error('sous_titre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select id="statut" name="statut" class="form-select" required>
                <option value="new" {{ old('statut') == 'new' ? 'selected' : '' }}>Nouveau</option>
                <option value="promo" {{ old('statut') == 'promo' ? 'selected' : '' }}>Promo</option>
                <option value="archive" {{ old('statut') == 'archive' ? 'selected' : '' }}>Archivé</option>
            </select>
            @error('statut')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Créer</button>
        <a href="{{ route('admin.lookbooks.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
