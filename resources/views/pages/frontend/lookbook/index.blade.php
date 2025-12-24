@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Lookbooks</h1>

    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Sous-titre</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lookbooks as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->titre }}</td>
                <td>{{ $item->sous_titre }}</td>
                <td>{{ $item->statut }}</td>
                <td>
                    <a href="{{ route('user.lookbooks.show', $item) }}" class="btn btn-info btn-sm">Voir</a>          
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $lookbooks->links('pagination::bootstrap-5') }}
</div>
@endsection
