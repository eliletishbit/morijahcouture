{{-- liste des valeurs options --}}

@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Valeurs d'Options</h1>

    <a href="{{ route('admin.valeur-options.create') }}" class="btn btn-primary mb-3">Ajouter une valeur d'option</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($valeurOptions->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Option de personnalisation</th>
                    <th>Valeur</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($valeurOptions as $vo)
                    <tr>
                        <td>{{ $vo->id }}</td>
                        <td>{{ $vo->optionPersonnalisation->nom_option ?? 'N/A' }}</td>
                        <td>{{ $vo->valeur }}</td>
                        <td>
                            @if($vo->image)
                                <img src="{{ asset('storage/' . $vo->image) }}" alt="Image" width="60" />
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.valeur-options.show', $vo->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('admin.valeur-options.edit', $vo->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.valeur-options.destroy', $vo->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmez la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $valeurOptions->links() }}

    @else
        <p>Aucune valeur d'option trouvée.</p>
    @endif
</div>
@endsection
