@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des utilisateurs</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Statut de connexion</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        @if($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo de {{ $user->name }}" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                        @else
                            <i class="fas fa-user-circle fa-2x text-secondary"></i>
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        @if(auth()->check() && auth()->id() === $user->id)
                            <i class="fas fa-circle text-success" title="Connecté"></i>
                        @else
                            <i class="fas fa-circle text-danger" title="Déconnecté"></i>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">Modifier</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
