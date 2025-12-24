@extends('layouts.backendapp')

@section('content')
<div class="container ">
    <h1>Liste des Avis Produits</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Utilisateur</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avis as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->produit->nom ?? 'N/A' }}</td>
                <td>{{ $item->user->name ?? 'N/A' }}</td>
                <td>{{ $item->note }}</td>
                <td>{{ $item->commentaire }}</td>
                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.avis-produits.destroy', $item) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $avis->links('pagination::bootstrap-5') }}
</div>
@endsection
