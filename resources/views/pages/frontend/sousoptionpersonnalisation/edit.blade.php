@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier une sous-option</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
    @endif

    <form action="{{ route('sousoptionpersonnalisations.update', $sousOption) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="option_personnalisation_id" class="form-label">Option de personnalisation liée</label>
            <select name="option_personnalisation_id" class="form-select" required>
                <option value="">Sélectionnez une option</option>
                @foreach ($options as $option)
                <option value="{{ $option->id }}" @selected(old('option_personnalisation_id', $sousOption->option_personnalisation_id) == $option->id)>{{ $option->nom_option }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nom_sous_option" class="form-label">Nom de la sous-option</label>
            <input type="text" name="nom_sous_option" class="form-control" value="{{ old('nom_sous_option', $sousOption->nom_sous_option) }}" required />
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('sousoptionpersonnalisations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
