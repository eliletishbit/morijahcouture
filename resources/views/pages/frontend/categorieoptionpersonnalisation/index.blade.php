@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des catégories d'options de personnalisation</h1>

    <a href="{{ route('categorieoptionpersonnalisations.create') }}" class="btn btn-primary mb-3">Ajouter une nouvelle catégorie</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($categoriesOptions->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriesOptions as $categorie)
            <tr>
                <td>{{ $categorie->id }}</td>
                <td>{{ $categorie->nom_categorie }}</td>
                <td>
                    <a href="{{ route('categorieoptionpersonnalisations.show', $categorie) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('categorieoptionpersonnalisations.edit', $categorie) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('categorieoptionpersonnalisations.destroy', $categorie) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Aucune catégorie d'option de personnalisation disponible.</p>
    @endif
</div>
@endsection
