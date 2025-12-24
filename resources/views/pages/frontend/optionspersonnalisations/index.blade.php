{{-- liste options personnalisations --}}

@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Options de Personnalisation</h1>

    <a href="{{ route('admin.option-personnalisations.create') }}" class="btn btn-primary mb-3">Ajouter une option</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($options->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom option</th>
                    <th>Type option</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($options as $option)
                    <tr>
                        <td>{{ $option->id }}</td>
                        <td>{{ $option->nom_option }}</td>
                        <td>{{ $option->type_option }}</td>
                        <td>
                            <a href="{{ route('admin.option-personnalisations.show', $option->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('admin.option-personnalisations.edit', $option->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.option-personnalisations.destroy', $option->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmez la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $options->links() }}

    @else
        <p>Aucune option de personnalisation trouvée.</p>
    @endif
</div>
@endsection
