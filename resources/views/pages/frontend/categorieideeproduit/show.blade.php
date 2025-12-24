@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails de la catégorie idée produit</h1>

    <p><strong>ID :</strong> {{ $categorie_idee_produit->id }}</p>
    <p><strong>Nom :</strong> {{ $categorie_idee_produit->nom }}</p>

    <a href="{{ route('admin.categorie-idee-produits.edit', $categorie_idee_produit) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.categorie-idee-produits.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
