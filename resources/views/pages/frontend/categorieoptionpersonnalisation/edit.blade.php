@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier une catégorie d'option de personnalisation</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('categorieoptionpersonnalisations.update', $categorie) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_categorie" class="form-label">Nom de la catégorie</label>
            <input type="text" name="nom_categorie" class="form-control" value="{{ old('nom_categorie', $categorie->nom_categorie) }}" required />
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('categorieoptionpersonnalisations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
