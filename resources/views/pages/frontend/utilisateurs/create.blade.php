@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Ajouter un utilisateur</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="profile_picture" class="form-label">Photo de profil (optionnelle)</label>
            <input type="file" name="profile_picture" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select name="status" class="form-select" required>
                <option value="active" @selected(old('status')==='active')>Actif</option>
                <option value="inactive" @selected(old('status')==='inactive')>Inactif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
