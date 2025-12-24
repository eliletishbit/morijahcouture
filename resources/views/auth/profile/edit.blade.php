@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Modifier mon profil</h1>

    @if(session('status') === 'profil-modifie')
        <div class="alert alert-success">
            Profil mis à jour avec succès.
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Ajoutez champs supplémentaires si besoin -->

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4">
        @csrf
        @method('DELETE')

        <div class="mb-3">
            <label for="password">Confirmez votre mot de passe pour supprimer le compte</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-danger">Supprimer mon compte</button>
    </form>
</div>
@endsection
