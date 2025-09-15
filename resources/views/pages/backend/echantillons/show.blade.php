@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détail de l'Échantillon #{{ $echantillon->id }}</h1>

    <p><strong>Nom :</strong> {{ $echantillon->nom }}</p>
    <p><strong>Type :</strong> {{ $echantillon->type }}</p>
    <p><strong>Catalogue :</strong> {{ $echantillon->catalogue->nom ?? 'N/A' }}</p>

    @if($echantillon->image)
        <p><strong>Image :</strong></p>
        <img src="{{ asset('storage/' . $echantillon->image) }}" alt="Image échantillon" width="200" />
    @endif

    <a href="{{ route('admin.echantillons.edit', $echantillon->id) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.echantillons.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
