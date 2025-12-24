{{-- //liste des categories --}}

@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des catégories</h1>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Ajouter une catégorie</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->nom }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-info btn-sm">détail</a>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline-block"
                          onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">
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
