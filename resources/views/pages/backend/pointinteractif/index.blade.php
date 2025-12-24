@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Points Interactifs</h1>

    <a href="{{ route('admin.point-interactifs.create') }}" class="btn btn-primary mb-3">Nouveau Point Interactif</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image Lookbook</th>
                <th>Produit</th>
                <th>Position X</th>
                <th>Position Y</th>
                <th>Description Popup</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($points as $point)
                <tr>
                    <td>{{ $point->id }}</td>
                    <td>{{ $point->imageLookbook->url ?? 'N/A' }}</td>
                    <td>{{ $point->produit->nom ?? 'Aucun' }}</td>
                    <td>{{ $point->position_x }}</td>
                    <td>{{ $point->position_y }}</td>
                    <td>{{ $point->description_popup }}</td>
                    <td>
                        <a href="{{ route('admin.point-interactifs.show', $point) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('admin.point-interactifs.edit', $point) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('admin.point-interactifs.destroy', $point) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $points->links('pagination::bootstrap-5') }}
</div>
@endsection
