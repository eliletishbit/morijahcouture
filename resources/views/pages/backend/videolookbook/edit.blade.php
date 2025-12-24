@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier la Vidéo Lookbook</h1>

    <form action="{{ route('admin.video-lookbooks.update', $videoLookbook) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="url" class="form-label">URL vidéo</label>
            <input type="text" id="url" name="url" class="form-control" value="{{ old('url', $videoLookbook->url) }}" required>
            @error('url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lookbook_id" class="form-label">Lookbook</label>
            <select id="lookbook_id" name="lookbook_id" class="form-select" required>
                @foreach($lookbooks as $lookbook)
                    <option value="{{ $lookbook->id }}" {{ (old('lookbook_id', $videoLookbook->lookbook_id) == $lookbook->id) ? 'selected' : '' }}>{{ $lookbook->titre }}</option>
                @endforeach
            </select>
            @error('lookbook_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Mettre à jour</button>
        <a href="{{ route('admin.video-lookbooks.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
