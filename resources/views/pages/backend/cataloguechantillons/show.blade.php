@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détail du Catalogue d'Échantillons #{{ $catalogue->id }}</h1>

    <p><strong>Nom :</strong> {{ $catalogue->nom }}</p>
    <p><strong>Description :</strong> {{ $catalogue->description }}</p>

    @if($catalogue->image)
        <p><strong>Image :</strong></p>
        <img src="{{ asset('storage/' . $catalogue->image) }}" alt="Image catalogue" width="200" />
    @endif

    <a href="{{ route('admin.catalogue-echantillons.edit', $catalogue->id) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.catalogue-echantillons.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
