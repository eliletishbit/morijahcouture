@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Créer une nouvelle Catégorie Idée Produit</h1>

    <form action="{{ route('admin.categorie-idee-produits.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('admin.categorie-idee-produits.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
