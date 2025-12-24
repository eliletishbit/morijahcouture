@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Catégories Idée Produit</h1>

    <a href="{{ route('admin.categorie-idee-produits.create') }}" class="btn btn-primary mb-3">Nouvelle Catégorie</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorie_idee_produits as $categorie_idee_produit)
                <tr>
                    <td>{{ $categorie_idee_produit->id }}</td>
                    <td>{{ $categorie_idee_produit->nom }}</td>
                    <td>
                        <a href="{{ route('admin.categorie-idee-produits.show', $categorie_idee_produit) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('admin.categorie-idee-produits.edit', $categorie_idee_produit) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('admin.categorie-idee-produits.destroy', $categorie_idee_produit) }}" method="POST" style="display:inline" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categorie_idee_produits->links('pagination::bootstrap-5') }}
</div>
@endsection
