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
            <label for="image" class="form-label">Image principale (optionnelle)</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="prix" class="form-label">Prix (€)</label>
            <input type="number" name="prix" id="prix" 
                class="form-control @error('prix') is-invalid @enderror" 
                value="{{ old('prix') }}" 
                step="0.01" min="0" placeholder="0.00" required>
            
            @error('prix')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="image_calque" class="form-label">Image / Calque</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                        id="image_calque" name="image_calque" accept="image/png">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if(isset($valeurOption) && $valeurOption->image_calque)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $valeurOption->image_calque) }}" alt="Calque" style="height: 60px;">
                        </div>
                    @endif
                    <small class="form-text text-muted">PNG avec transparence recommandé pour les calques.</small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="ordre_calque" class="form-label">Ordre de superposition</label>
                    <input type="number" class="form-control @error('ordre_calque') is-invalid @enderror" 
                        id="ordre_calque" name="ordre_calque" value="{{ old('ordre_calque', $valeurOption->ordre_calque ?? 0) }}" 
                        min="0" step="1">
                    <small class="form-text text-muted">
                        Plus le nombre est petit, plus le calque est superposé en premier (ex: Tissu=1, Col=2, Boutons=3).
                    </small>
                    @error('ordre_calque') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.valeur-options.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
