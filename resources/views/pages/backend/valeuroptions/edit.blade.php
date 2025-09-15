{{-- editer valeur option --}}

@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier Valeur d'Option #{{ $valeurOption->id }}</h1>

    <form action="{{ route('admin.valeur-options.update', $valeurOption->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="option_personnalisation_id" class="form-label">Option de Personnalisation</label>
            <select name="option_personnalisation_id" id="option_personnalisation_id" class="form-control @error('option_personnalisation_id') is-invalid @enderror" required>
                <option value="">-- Sélectionner --</option>
                @foreach($options as $option)
                    <option value="{{ $option->id }}" {{ (old('option_personnalisation_id', $valeurOption->option_personnalisation_id) == $option->id) ? 'selected' : '' }}>
                        {{ $option->nom_option }}
                    </option>
                @endforeach
            </select>
            @error('option_personnalisation_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="valeur" class="form-label">Valeur</label>
            <input type="text" name="valeur" id="valeur" class="form-control @error('valeur') is-invalid @enderror" value="{{ old('valeur', $valeurOption->valeur) }}" required>
            @error('valeur')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label">Image (optionnelle)</label>
            @if($valeurOption->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $valeurOption->image) }}" alt="Image actuelle" width="100">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.valeur-options.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
