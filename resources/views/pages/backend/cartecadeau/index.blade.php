@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Cartes Cadeaux</h1>

    <a href="{{ route('admin.carte-cadeaus.create') }}" class="btn btn-primary mb-3">Nouvelle Carte Cadeau</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Valeur</th>
                <th>Date d'expiration</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartes as $carte)
                <tr>
                    <td>{{ $carte->id }}</td>
                    <td>{{ $carte->code }}</td>
                    <td>{{ $carte->valeur }}</td>
                    <td>{{ $carte->date_expiration ? $carte->date_expiration->format('d/m/Y') : 'Aucune' }}</td>
                    <td>{{ $carte->statut }}</td>
                    <td>
                        <a href="{{ route('admin.carte-cadeaus.show', $carte) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('admin.carte-cadeaus.edit', $carte) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('admin.carte-cadeaus.destroy', $carte) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $cartes->links('pagination::bootstrap-5') }}
</div>
@endsection
