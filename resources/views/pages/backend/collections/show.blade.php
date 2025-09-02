{{-- void les detail d'une collection --}}

@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails de la collection : {{ $collection->nom }}</h1>
    <p><strong>Sous-catégorie :</strong> {{ $collection->sousCategorie->nom ?? 'Non définie' }}</p>
    <p>
        <strong>Image principale :</strong><br>
        @if($collection->image_principale)
            <img src="{{ asset('storage/' . $collection->image_principale) }}" alt="{{ $collection->nom }}" style="max-width:200px;">
        @else
            Aucune image
        @endif
    </p>

    <a href="{{ route('admin.collections.edit', $collection) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.collections.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
