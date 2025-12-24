{{-- detail d'une sous categorie --}}
@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails de la sous-catégorie : {{ $sous_category->nom }}</h1>

    <p><strong>Nom :</strong> {{ $sous_category->nom }}</p>
    <p><strong>Catégorie parente :</strong> {{ $sous_category->categorie->nom ?? 'Non définie' }}</p>

    <a href="{{ route('admin.sous-categories.edit', $sous_category) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.sous-categories.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
