@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détail de la Caractéristique #{{ $caracteristique->id }}</h1>

    <p><strong>Catégorie :</strong> {{ $caracteristique->categorie->nom ?? 'N/A' }}</p>
    <p><strong>Type :</strong> {{ $caracteristique->type }}</p>
    <p><strong>Valeur :</strong> {{ $caracteristique->valeur }}</p>

    <a href="{{ route('admin.caracteristique-produits.edit', $caracteristique->id) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.caracteristique-produits.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
