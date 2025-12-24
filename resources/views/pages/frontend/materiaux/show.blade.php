@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détail du Matériau #{{ $materiau->id }}</h1>

    <p><strong>Nom :</strong> {{ $materiau->nom }}</p>
    <p><strong>Description :</strong> {{ $materiau->description }}</p>

    <a href="{{ route('admin.materiaux.edit', $materiau->id) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.materiaux.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
