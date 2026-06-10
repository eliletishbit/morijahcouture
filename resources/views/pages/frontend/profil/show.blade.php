

@extends('layouts.backendapp')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-dark fw-bold"><i class="fas fa-user-circle me-2 text-primary"></i>Mon Profil</h4>
                    <span class="badge bg-light text-primary rounded-pill px-3">Membre actif</span>
                </div>
                
                <div class="card-body p-4">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 py-3 border-0 d-flex align-items-center">
                            <i class="fas fa-user text-muted me-3 fa-fw"></i>
                            <div>
                                <small class="text-uppercase text-muted d-block" style="font-size: 0.7rem;">Nom complet</small>
                                <span class="fw-semibold">{{ $user->name }}</span>
                            </div>
                        </div>

                        <div class="list-group-item px-0 py-3 d-flex align-items-center">
                            <i class="fas fa-envelope text-muted me-3 fa-fw"></i>
                            <div>
                                <small class="text-uppercase text-muted d-block" style="font-size: 0.7rem;">Adresse email</small>
                                <span class="fw-semibold">{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('user.profile.edit') }}" id="editProfileBtn" class="btn btn-primary btn-lg w-100 rounded-3 shadow-sm transition-all">
                            <span class="btn-text"><i class="fas fa-edit me-2"></i>Modifier mes informations</span>
                            <span class="spinner" style="display: none;"><i class="fas fa-spinner fa-spin"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-all { transition: all 0.3s ease; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(13,110,253,0.3) !important; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editBtn = document.getElementById('editProfileBtn');
        
        editBtn.addEventListener('click', function(e) {
            // Animation simple pour montrer que l'action est prise en compte
            this.querySelector('.btn-text').style.display = 'none';
            this.querySelector('.spinner').style.display = 'inline-block';
            this.classList.add('disabled');
        });
    });
</script>
@endsection