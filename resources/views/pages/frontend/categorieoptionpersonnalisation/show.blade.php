@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails de la catégorie d'option de personnalisation: {{ $categorie->nom_categorie }}</h1>

    <div class="mb-3">
        <strong>ID :</strong> {{ $categorie->id }}
    </div>

    <div class="mb-3">
        <strong>Nom de la catégorie :</strong> {{ $categorie->nom_categorie }}
    </div>

    @if ($categorie->options && $categorie->options->count())
    <h3>Options associées</h3>
    <ul>
        @foreach ($categorie->options as $option)
        <li>{{ $option->nom_option }} (Type : {{ $option->type_option ?? 'N/A' }})
            @if ($option->sousOptions && $option->sousOptions->count())
            <ul>
                @foreach ($option->sousOptions as $sousOption)
                <li>{{ $sousOption->nom_sous_option }}</li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
    @else
    <p>Aucune option associée.</p>
    @endif

    <a href="{{ route('categorieoptionpersonnalisations.edit', $categorie) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('categorieoptionpersonnalisations.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
