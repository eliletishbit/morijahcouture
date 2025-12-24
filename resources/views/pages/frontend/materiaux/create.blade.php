@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Ajouter un Matériau</h1>

    <form action="{{ route('admin.materiaux.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description (optionnelle)</label>
            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.materiaux.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
