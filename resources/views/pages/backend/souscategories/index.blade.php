{{-- liste des sous categories --}}

@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des sous-catégories</h1>

    <a href="{{ route('admin.sous-categories.create') }}" class="btn btn-primary mb-3">Ajouter une sous-catégorie</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Catégorie parente</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sousCategories as $sousCategorie)
            <tr>
                <td>{{ $sousCategorie->nom }}</td>
                <td>{{ $sousCategorie->categorie->nom ?? 'Non définie' }}</td>
                <td>
                    <a href="{{ route('admin.sous-categories.show', $sousCategorie) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('admin.sous-categories.edit', $sousCategorie) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.sous-categories.destroy', $sousCategorie) }}" method="POST" style="display:inline-block"
                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette sous-catégorie ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
