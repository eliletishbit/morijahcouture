@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Créer une nouvelle Carte Cadeau</h1>

    <form action="{{ route('admin.carte-cadeaus.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" id="code" name="code" class="form-control" value="{{ old('code') }}" required>
            @error('code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="valeur" class="form-label">Valeur (€)</label>
            <input type="number" id="valeur" name="valeur" class="form-control" value="{{ old('valeur') }}" step="0.01" min="0" required>
            @error('valeur')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date_expiration" class="form-label">Date d'expiration</label>
            <input type="date" id="date_expiration" name="date_expiration" class="form-control" value="{{ old('date_expiration') }}">
            @error('date_expiration')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" id="statut" class="form-select" required>
                <option value="active" {{ old('statut') == 'active' ? 'selected' : '' }}>Actif</option>
                <option value="utilisée" {{ old('statut') == 'utilisée' ? 'selected' : '' }}>Utilisée</option>
                <option value="expirée" {{ old('statut') == 'expirée' ? 'selected' : '' }}>Expirée</option>
            </select>
            @error('statut')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('admin.carte-cadeaus.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
