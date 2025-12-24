@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails du Lookbook</h1>

    <p><strong>ID :</strong> {{ $lookbook->id }}</p>
    <p><strong>Titre :</strong> {{ $lookbook->titre }}</p>
    <p><strong>Sous-titre :</strong> {{ $lookbook->sous_titre }}</p>
    <p><strong>Description :</strong> {{ $lookbook->description }}</p>
    <p><strong>Statut :</strong> {{ $lookbook->statut }}</p>

    <a href="{{ route('admin.lookbooks.edit', $lookbook) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.lookbooks.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
