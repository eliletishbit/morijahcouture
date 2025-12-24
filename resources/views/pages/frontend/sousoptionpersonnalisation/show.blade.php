@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails de la sous-option de personnalisation: {{ $sousOption->nom_sous_option }}</h1>

    <div class="mb-3">
        <strong>ID :</strong> {{ $sousOption->id }}
    </div>

    <div class="mb-3">
        <strong>Nom de la sous-option :</strong> {{ $sousOption->nom_sous_option }}
    </div>

    <div class="mb-3">
        <strong>Option liée :</strong> {{ $sousOption->option->nom_option ?? 'Non défini' }}
    </div>

    @if ($sousOption->valeurs && $sousOption->valeurs->count())
    <h3>Valeurs disponibles</h3>
    <ul>
        @foreach ($sousOption->valeurs as $valeur)
        <li>{{ $valeur->valeur }}</li>
        @endforeach
    </ul>
    @else
    <p>Aucune valeur disponible pour cette sous-option.</p>
    @endif

    <a href="{{ route('sousoptionpersonnalisations.edit', $sousOption) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('sousoptionpersonnalisations.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
