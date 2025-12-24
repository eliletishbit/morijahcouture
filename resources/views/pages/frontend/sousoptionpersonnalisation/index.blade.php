@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des sous-options de personnalisation</h1>

    <a href="{{ route('sousoptionpersonnalisations.create') }}" class="btn btn-primary mb-3">Ajouter une nouvelle sous-option</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($sousOptions->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom sous-option</th>
                <th>Option liée</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sousOptions as $sousOption)
            <tr>
                <td>{{ $sousOption->id }}</td>
                <td>{{ $sousOption->nom_sous_option }}</td>
                <td>{{ $sousOption->option->nom_option ?? 'Non défini' }}</td>
                <td>
                    <a href="{{ route('sousoptionpersonnalisations.show', $sousOption) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('sousoptionpersonnalisations.edit', $sousOption) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('sousoptionpersonnalisations.destroy', $sousOption) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Aucune sous-option trouvée.</p>
    @endif
</div>
@endsection
