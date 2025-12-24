@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails de l'Idée Produit</h1>

    <p><strong>ID :</strong> {{ $idee_produit->id }}</p>
    <p><strong>Nom :</strong> {{ $idee_produit->nom }}</p>

    <a href="{{ route('admin.idee-produits.edit', $idee_produit) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.idee-produits.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
