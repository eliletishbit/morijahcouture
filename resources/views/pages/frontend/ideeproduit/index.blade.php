@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Idées Produits</h1>

    <a href="{{ route('admin.idee-produits.create') }}" class="btn btn-primary mb-3">Nouvelle Idée Produit</a>

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
            @foreach($idee_produits as $idee_produit)
                <tr>
                    <td>{{ $idee_produit->id }}</td>
                    <td>{{ $idee_produit->nom }}</td>
                    <td>
                        <a href="{{ route('admin.idee-produits.show', $idee_produit) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('admin.idee-produits.edit', $idee_produit) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('admin.idee-produits.destroy', $idee_produit) }}" method="POST" style="display:inline" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $idee_produits->links('pagination::bootstrap-5') }}
</div>
@endsection
