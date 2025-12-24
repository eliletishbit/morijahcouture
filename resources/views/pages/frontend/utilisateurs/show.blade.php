@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails de l'utilisateur : {{ $user->name }}</h1>

    <p><strong>Nom :</strong> {{ $user->name }}</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>

    <p><strong>Photo :</strong><br>
        @if($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo de {{ $user->name }}" class="rounded-circle" style="width:150px; height:150px; object-fit:cover;">
        @else
            <i class="fas fa-user-circle fa-5x text-secondary"></i>
        @endif
    </p>

    <p><strong>Statut de connexion : </strong>
        @if(auth()->check() && auth()->id() === $user->id)
            <span class="badge bg-success">Connecté</span>
        @else
            <span class="badge bg-danger">Déconnecté</span>
        @endif
    </p>

    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
