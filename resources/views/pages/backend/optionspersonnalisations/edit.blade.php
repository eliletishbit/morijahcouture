{{-- //editer option personnalisation --}}
@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier Option de Personnalisation #{{ $option->id }}</h1>

    <form action="{{ route('admin.option-personnalisations.update', $option->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nom_option" class="form-label">Nom de l'option</label>
            <input type="text" name="nom_option" id="nom_option" class="form-control @error('nom_option') is-invalid @enderror" value="{{ old('nom_option', $option->nom_option) }}" required>
            @error('nom_option')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="type_option" class="form-label">Type d'option</label>
            <input type="text" name="type_option" id="type_option" class="form-control @error('type_option') is-invalid @enderror" value="{{ old('type_option', $option->type_option) }}" required>
            @error('type_option')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.option-personnalisations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
