@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Ajouter une catégorie d'option de personnalisation</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('categorieoptionpersonnalisations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nom_categorie" class="form-label">Nom de la catégorie</label>
            <input type="text" name="nom_categorie" class="form-control" value="{{ old('nom_categorie') }}" required />
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('categorieoptionpersonnalisations.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </form>
</div>
@endsection
