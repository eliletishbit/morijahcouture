@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier l'Idée Produit</h1>

    <form action="{{ route('admin.idee-produits.update', $idee_produit) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom', $idee_produit->nom) }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Mettre à jour</button>
        <a href="{{ route('admin.idee-produits.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
