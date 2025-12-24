@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Matériaux</h1>

    <a href="{{ route('admin.materiaux.create') }}" class="btn btn-primary mb-3">Ajouter un matériau</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($materiaux->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiaux as $materiau)
                    <tr>
                        <td>{{ $materiau->id }}</td>
                        <td>{{ $materiau->nom }}</td>
                        <td>{{ Str::limit($materiau->description, 50) }}</td>
                        <td>
                            <a href="{{ route('admin.materiaux.show', $materiau->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('admin.materiaux.edit', $materiau->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.materiaux.destroy', $materiau->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmez la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $materiaux->links() }}

    @else
        <p>Aucun matériau trouvé.</p>
    @endif
</div>
@endsection
