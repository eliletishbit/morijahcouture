@extends('layouts.backendapp')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('user.profile.show') }}" class="btn btn-outline-secondary btn-sm me-3"><i class="fas fa-arrow-left"></i></a>
                <h3 class="fw-bold mb-0">Paramètres du profil</h3>
            </div>

            @if(session('status') === 'profil-modifie')
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> Votre profil a été mis à jour avec succès.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3"><i class="fas fa-user-edit me-2 text-primary"></i>Informations personnelles</h5>
                    <form method="POST" action="{{ route('profile.update') }}" id="updateForm">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label text-muted small text-uppercase fw-bold">Nom</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control form-control-lg @error('name') is-invalid @enderror" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label text-muted small text-uppercase fw-bold">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control form-control-lg @error('email') is-invalid @enderror" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg px-4" id="submitBtn">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-danger border-opacity-25 rounded-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold text-danger mb-3"><i class="fas fa-exclamation-triangle me-2"></i>Zone dangereuse</h5>
                    <p class="text-muted small mb-4">La suppression de votre compte est irréversible. Toutes vos données seront effacées.</p>
                    
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Confirmez votre mot de passe" required>
                        </div>
                        <button type="submit" class="btn btn-outline-danger">Supprimer définitivement mon compte</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Simple feedback utilisateur
    document.getElementById('updateForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Enregistrement...';
        btn.disabled = true;
    });
</script>
@endsection