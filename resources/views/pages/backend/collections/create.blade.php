{{-- vue de creation d'une collection --}}

@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Ajouter une nouvelle collection</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.collections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="sous_categorie_id" class="form-label">Sous-catégorie</label>
            <select name="sous_categorie_id" class="form-select" required>
                <option value="">Sélectionnez une sous-catégorie</option>
                @foreach($sousCategories as $sc)
                    <option value="{{ $sc->id }}" @selected(old('sous_categorie_id') == $sc->id)>{{ $sc->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image_principale" class="form-label">Image principale (URL ou chemin relatif)</label>
            <input type="text" name="image_principale" class="form-control" value="{{ old('image_principale') }}">
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('admin.collections.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
