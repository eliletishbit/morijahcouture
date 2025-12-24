@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Catalogues d'Échantillons</h1>

    <a href="{{ route('admin.catalogue-echantillons.create') }}" class="btn btn-primary mb-3">Ajouter un catalogue</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($catalogues->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($catalogues as $catalogue)
                    <tr>
                        <td>{{ $catalogue->id }}</td>
                        <td>{{ $catalogue->nom }}</td>
                        <td>{{ Str::limit($catalogue->description, 50) }}</td>
                        <td>
                            @if($catalogue->image)
                                <img src="{{ asset('storage/' . $catalogue->image) }}" alt="Image catalogue" width="60" />
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.catalogue-echantillons.show', $catalogue->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('admin.catalogue-echantillons.edit', $catalogue->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.catalogue-echantillons.destroy', $catalogue->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmez la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $catalogues->links() }}

    @else
        <p>Aucun catalogue trouvé.</p>
    @endif
</div>
@endsection
