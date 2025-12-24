@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Caractéristiques de Produits</h1>

    <a href="{{ route('admin.caracteristique-produits.create') }}" class="btn btn-primary mb-3">Ajouter une caractéristique</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($caracteristiques->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Catégorie</th>
                    <th>Type</th>
                    <th>Valeur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($caracteristiques as $caracteristique)
                    <tr>
                        <td>{{ $caracteristique->id }}</td>
                        <td>{{ $caracteristique->categorie->nom ?? 'N/A' }}</td>
                        <td>{{ $caracteristique->type }}</td>
                        <td>{{ $caracteristique->valeur }}</td>
                        <td>
                            <a href="{{ route('admin.caracteristique-produits.show', $caracteristique->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('admin.caracteristique-produits.edit', $caracteristique->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.caracteristique-produits.destroy', $caracteristique->id) }}" method="POST"
                                style="display:inline-block" onsubmit="return confirm('Confirmez la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $caracteristiques->links() }}

    @else
        <p>Aucune caractéristique trouvée.</p>
    @endif
</div>
@endsection
