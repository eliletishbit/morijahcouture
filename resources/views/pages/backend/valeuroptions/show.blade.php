@extends('layouts.backendapp')

@section('content')
<div class="container py-5">
    <!-- En-tête avec carte de navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold text-primary mb-0">Détail de la Valeur d'Option</h1>
            <p class="text-muted mt-2">#{{ $valeurOption->id }} — Consultation des informations détaillées</p>
        </div>
        <div>
            <a href="{{ route('admin.valeur-options.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Retour à la liste
            </a>
        </div>
    </div>

    <!-- Carte principale -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-5">
            <div class="row g-4">
                <!-- Colonne gauche : infos texte -->
                <div class="col-md-6">
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-tags fs-2 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-primary mb-0">Option de personnalisation</h5>
                                <p class="fs-4 fw-semibold text-dark mb-0">{{ $valeurOption->optionPersonnalisation->nom_option ?? 'Non définie' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-success bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-palette fs-2 text-success"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-success mb-0">Valeur</h5>
                                <p class="fs-4 fw-semibold text-dark mb-0">{{ $valeurOption->valeur }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-coin fs-2 text-warning"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-warning mb-0">Prix</h5>
                                <p class="fs-4 fw-semibold text-dark mb-0">{{ number_format($valeurOption->prix ?? 0, 2, ',', ' ') }} €</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-info bg-opacity-10 p-3 rounded-3">
                                <i class="bi bi-sort-numeric-down fs-2 text-info"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-info mb-0">Ordre de superposition</h5>
                                <p class="fs-4 fw-semibold text-dark mb-0">{{ $valeurOption->ordre_calque ?? 0 }}</p>
                                <small class="text-muted">Plus le chiffre est petit, plus le calque est superposé en premier</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite : images -->
                <div class="col-md-6">
                    @if($valeurOption->image)
                        <div class="mb-4">
                            <div class="card border-0 bg-light rounded-4 h-100">
                                <div class="card-body text-center p-4">
                                    <div class="bg-white rounded-3 p-3 mb-3 d-inline-block">
                                        <i class="bi bi-image fs-1 text-secondary"></i>
                                    </div>
                                    <h6 class="fw-bold mb-3">Image illustrative</h6>
                                    <img src="{{ asset('storage/' . $valeurOption->image) }}" 
                                         alt="Image option" 
                                         class="img-fluid rounded-3 shadow-sm" 
                                         style="max-height: 200px; object-fit: contain;">
                                    <p class="text-muted small mt-3 mb-0">Affichée dans la liste des options</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($valeurOption->image_calque)
                        <div class="mb-4">
                            <div class="card border-0 bg-dark text-white rounded-4 h-100">
                                <div class="card-body text-center p-4">
                                    <div class="bg-white bg-opacity-10 rounded-3 p-3 mb-3 d-inline-block">
                                        <i class="bi bi-layers fs-1 text-white"></i>
                                    </div>
                                    <h6 class="fw-bold mb-3 text-white">Calque de superposition (PNG transparent)</h6>
                                    <img src="{{ asset('storage/' . $valeurOption->image_calque) }}" 
                                         alt="Calque option" 
                                         class="img-fluid rounded-3 shadow-sm" 
                                         style="max-height: 200px; background-color: #2a2a2a; object-fit: contain;">
                                    <p class="text-white-50 small mt-3 mb-0">Utilisé dans l'éditeur pour personnaliser le vêtement</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!$valeurOption->image && !$valeurOption->image_calque)
                        <div class="alert alert-secondary text-center py-5 rounded-4">
                            <i class="bi bi-eye-slash fs-1 d-block mb-3"></i>
                            <p class="mb-0">Aucune image associée à cette valeur d'option</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Séparateur -->
            <hr class="my-5">

            <!-- Actions -->
            <div class="d-flex gap-3 justify-content-end">
                <a href="{{ route('admin.valeur-options.edit', $valeurOption->id) }}" class="btn btn-warning btn-lg px-5">
                    <i class="bi bi-pencil-square me-2"></i> Modifier
                </a>
                <a href="{{ route('admin.valeur-options.index') }}" class="btn btn-outline-secondary btn-lg px-5">
                    <i class="bi bi-list-ul me-2"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection