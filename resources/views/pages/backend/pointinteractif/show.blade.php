@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails du Point Interactif</h1>

    <p><strong>ID :</strong> {{ $pointInteractif->id }}</p>
    <p><strong>Image Lookbook :</strong> {{ $pointInteractif->imageLookbook->url ?? 'N/A' }}</p>
    <p><strong>Produit :</strong> {{ $pointInteractif->produit->nom ?? 'Aucun' }}</p>
    <p><strong>Position X :</strong> {{ $pointInteractif->position_x }}</p>
    <p><strong>Position Y :</strong> {{ $pointInteractif->position_y }}</p>
    <p><strong>Description Popup :</strong> {{ $pointInteractif->description_popup }}</p>

    <a href="{{ route('admin.point-interactifs.edit', $pointInteractif) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.point-interactifs.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
