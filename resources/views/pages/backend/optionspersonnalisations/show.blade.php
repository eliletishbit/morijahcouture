{{-- voir option de personnalisation --}}
@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détail de l'Option de Personnalisation #{{ $option->id }}</h1>

    <p><strong>Nom de l'option :</strong> {{ $option->nom_option }}</p>
    <p><strong>Type d'option :</strong> {{ $option->type_option }}</p>

    <a href="{{ route('admin.option-personnalisations.edit', $option->id) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.option-personnalisations.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
