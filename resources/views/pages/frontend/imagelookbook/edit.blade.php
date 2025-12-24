@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier Image Lookbook</h1>

    <form action="{{ route('admin.image-lookbooks.update', $imageLookbook) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="url" class="form-label">ID Google Drive (de l'image)</label>
            <input type="text" id="url" name="url" class="form-control" value="{{ old('url', $imageLookbook->url) }}" placeholder="Ex : 1u-4cc96XySUagKeV4bzIF_HQ5HB1yJ8G" required>
            @error('url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lookbook_id" class="form-label">Lookbook</label>
            <select id="lookbook_id" name="lookbook_id" class="form-select" required>
                <option value="">Sélectionner un lookbook</option>
                @foreach($lookbooks as $lookbook)
                    <option value="{{ $lookbook->id }}" {{ old('lookbook_id', $imageLookbook->lookbook_id) == $lookbook->id ? 'selected' : '' }}>
                        {{ $lookbook->titre }}
                    </option>
                @endforeach
            </select>
            @error('lookbook_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" id="is_principale" name="is_principale" class="form-check-input" {{ old('is_principale', $imageLookbook->is_principale) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_principale">Est Principale</label>
        </div>

        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
        <a href="{{ route('admin.image-lookbooks.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
