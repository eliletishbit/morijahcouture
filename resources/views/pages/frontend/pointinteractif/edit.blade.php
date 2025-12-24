@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier le Point Interactif</h1>

    <form action="{{ route('admin.point-interactifs.update', $pointInteractif) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="image_lookbook_id" class="form-label">Image Lookbook</label>
            <select id="image_lookbook_id" name="image_lookbook_id" class="form-select" required>
                @foreach($images as $img)
                    <option value="{{ $img->id }}" {{ old('image_lookbook_id', $pointInteractif->image_lookbook_id) == $img->id ? 'selected' : '' }}>{{ $img->url }}</option>
                @endforeach
            </select>
            @error('image_lookbook_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="produit_id" class="form-label">Produit (optionnel)</label>
            <select id="produit_id" name="produit_id" class="form-select">
                <option value="">Aucun</option>
                @foreach($produits as $prod)
                    <option value="{{ $prod->id }}" {{ old('produit_id', $pointInteractif->produit_id) == $prod->id ? 'selected' : '' }}>{{ $prod->nom }}</option>
                @endforeach
            </select>
            @error('produit_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="position_x" class="form-label">Position X (entre 0 et 1)</label>
            <input type="number" step="0.01" min="0" max="1" id="position_x" name="position_x" class="form-control" value="{{ old('position_x', $pointInteractif->position_x) }}" required>
            @error('position_x')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="position_y" class="form-label">Position Y (entre 0 et 1)</label>
            <input type="number" step="0.01" min="0" max="1" id="position_y" name="position_y" class="form-control" value="{{ old('position_y', $pointInteractif->position_y) }}" required>
            @error('position_y')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description_popup" class="form-label">Description Popup (optionnelle)</label>
            <textarea id="description_popup" name="description_popup" class="form-control">{{ old('description_popup', $pointInteractif->description_popup) }}</textarea>
            @error('description_popup')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Mettre à jour</button>
        <a href="{{ route('admin.point-interactifs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
