@extends('layouts.frontendapp')

@section('content')
<div class="container my-5">
    <h1>Mon Profil</h1>

    <div class="card p-4">
        <p><strong>Nom :</strong> {{ $user->name }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <!-- Ajoutez d'autres informations utilisateur ici -->

        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary mt-3">Modifier mon profil</a>
    </div>
</div>
@endsection
