@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails de la Carte Cadeau</h1>

    <p><strong>ID :</strong> {{ $cartecadeau->id }}</p>
    <p><strong>Code :</strong> {{ $cartecadeau->code }}</p>
    <p><strong>Valeur :</strong> {{ $cartecadeau->valeur }} €</p>
    <p><strong>Date d'expiration :</strong> {{ $cartecadeau->date_expiration ? $cartecadeau->date_expiration->format('d/m/Y') : 'Aucune' }}</p>
    <p><strong>Statut :</strong> {{ $cartecadeau->statut }}</p>

    <a href="{{ route('admin.carte-cadeaus.edit', $cartecadeau) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.carte-cadeaus.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
