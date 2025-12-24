@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Échantillons</h1>

    <a href="{{ route('admin.echantillons.create') }}" class="btn btn-primary mb-3">Ajouter un échantillon</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($echantillons->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Catalogue</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($echantillons as $echantillon)
                    <tr>
                        <td>{{ $echantillon->id }}</td>
                        <td>{{ $echantillon->nom }}</td>
                        <td>{{ $echantillon->type }}</td>
                        <td>{{ $echantillon->catalogue->nom ?? 'N/A' }}</td>
                        <td>
                            @if($echantillon->image)
                                <img src="{{ asset('storage/' . $echantillon->image) }}" alt="Image échantillon" width="60" />
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.echantillons.show', $echantillon->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('admin.echantillons.edit', $echantillon->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.echantillons.destroy', $echantillon->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmez la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $echantillons->links() }}

    @else
        <p>Aucun échantillon trouvé.</p>
    @endif
</div>
@endsection
