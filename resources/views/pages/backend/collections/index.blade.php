{{-- liste des collections --}}
@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des collections</h1>

    <a href="{{ route('admin.collections.create') }}" class="btn btn-primary mb-3">Ajouter une collection</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Sous-catégorie</th>
                <th>Image principale</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collections as $collection)
            <tr>
                <td>{{ $collection->nom }}</td>
                <td>{{ $collection->sousCategorie->nom ?? 'Non définie' }}</td>
                <td>
                    @if($collection->image_principale)
                    <img src="{{ asset('storage/' . $collection->image_principale) }}" alt="{{ $collection->nom }}" width="80">
                    @else
                    Aucune image
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.collections.show', $collection) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('admin.collections.edit', $collection) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.collections.destroy', $collection) }}" method="POST" style="display:inline-block"
                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette collection ?');">
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
