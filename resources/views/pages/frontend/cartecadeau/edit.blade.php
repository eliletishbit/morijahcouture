@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier la Carte Cadeau</h1>

    <form action="{{ route('admin.carte-cadeaus.update', $cartecadeau) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" id="code" name="code" class="form-control" value="{{ old('code', $cartecadeau->code) }}" required>
            @error('code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="valeur" class="form-label">Valeur (€)</label>
            <input type="number" id="valeur" name="valeur" class="form-control" value="{{ old('valeur', $cartecadeau->valeur) }}" step="0.01" min="0" required>
            @error('valeur')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date_expiration" class="form-label">Date d'expiration</label>
            <input type="date" id="date_expiration" name="date_expiration" class="form-control" value="{{ old('date_expiration', $cartecadeau->date_expiration?->format('Y-m-d')) }}">
            @error('date_expiration')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select name="statut" id="statut" class="form-select" required>
                <option value="active" {{ old('statut', $cartecadeau->statut) == 'active' ? 'selected' : '' }}>Actif</option>
                <option value="utilisée" {{ old('statut', $cartecadeau->statut) == 'utilisée' ? 'selected' : '' }}>Utilisée</option>
                <option value="expirée" {{ old('statut', $cartecadeau->statut) == 'expirée' ? 'selected' : '' }}>Expirée</option>
            </select>
            @error('statut')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.carte-cadeaus.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
