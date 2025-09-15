@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détail de la Valeur d'Option #{{ $valeurOption->id }}</h1>

    <p><strong>Option de personnalisation :</strong> {{ $valeurOption->optionPersonnalisation->nom_option ?? 'N/A' }}</p>
    <p><strong>Valeur :</strong> {{ $valeurOption->valeur }}</p>

    @if($valeurOption->image)
        <p><strong>Image :</strong></p>
        <img src="{{ asset('storage/' . $valeurOption->image) }}" alt="Image option" width="200" />
    @endif

    <a href="{{ route('admin.valeur-options.edit', $valeurOption->id) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.valeur-options.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
