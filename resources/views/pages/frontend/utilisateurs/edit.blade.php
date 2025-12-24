@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier l'utilisateur : {{ $user->name }}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe (laisser vide pour garder l'actuel)</label>
            <input type="password" name="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label for="profile_picture" class="form-label">Changer la photo de profil</label>
            <input type="file" name="profile_picture" class="form-control" accept="image/*">
            @if ($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo {{ $user->name }}" class="rounded-circle mt-2" style="width:80px; height:80px; object-fit:cover;">
            @endif
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" class="form-select" required>
                <option value="active" @selected(old('status', $user->status) === 'active')>Actif</option>
                <option value="inactive" @selected(old('status', $user->status) === 'inactive')>Inactif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
