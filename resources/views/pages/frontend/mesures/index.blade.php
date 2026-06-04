@extends('layouts.frontendapp')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Carte principale --}}
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h1 class="fw-bold text-primary mb-1">Vos mesures</h1>
                    <p class="text-muted">
                        Pour que votre <strong>{{ $produit->nom }}</strong> soit parfaitement ajusté, 
                        renseignez vos mesures ci-dessous.
                    </p>
                </div>

                <div class="card-body p-4">
                    {{-- Message d'info si des mesures existent déjà --}}
                    @if($mesuresExistantes)
                        <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                            <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                            <div>
                                Nous avons pré-rempli vos dernières mesures. 
                                Vous pouvez les modifier ou les utiliser telles quelles.
                            </div>
                        </div>
                    @endif

                    {{-- Formulaire --}}
                    <form action="{{ route('mesures.store', $produit) }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            {{-- Poitrine --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tour de poitrine <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-arrow-left-right"></i></span>
                                    <input type="number" step="0.5" name="tour_poitrine" 
                                           class="form-control @error('tour_poitrine') is-invalid @enderror"
                                           value="{{ old('tour_poitrine', $mesuresExistantes->data['tour_poitrine'] ?? '') }}" 
                                           placeholder="ex: 92" required>
                                    <span class="input-group-text bg-light">cm</span>
                                </div>
                                @error('tour_poitrine') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            {{-- Taille --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tour de taille <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-arrow-left-right"></i></span>
                                    <input type="number" step="0.5" name="tour_taille" 
                                           class="form-control @error('tour_taille') is-invalid @enderror"
                                           value="{{ old('tour_taille', $mesuresExistantes->data['tour_taille'] ?? '') }}" 
                                           placeholder="ex: 78" required>
                                    <span class="input-group-text bg-light">cm</span>
                                </div>
                                @error('tour_taille') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            {{-- Hanche --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tour de hanche <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-arrow-left-right"></i></span>
                                    <input type="number" step="0.5" name="tour_hanche" 
                                           class="form-control @error('tour_hanche') is-invalid @enderror"
                                           value="{{ old('tour_hanche', $mesuresExistantes->data['tour_hanche'] ?? '') }}" 
                                           placeholder="ex: 96" required>
                                    <span class="input-group-text bg-light">cm</span>
                                </div>
                                @error('tour_hanche') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            {{-- Longueur manche --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Longueur manche <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-rulers"></i></span>
                                    <input type="number" step="0.5" name="longueur_manche" 
                                           class="form-control @error('longueur_manche') is-invalid @enderror"
                                           value="{{ old('longueur_manche', $mesuresExistantes->data['longueur_manche'] ?? '') }}" 
                                           placeholder="ex: 62" required>
                                    <span class="input-group-text bg-light">cm</span>
                                </div>
                                @error('longueur_manche') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            {{-- Longueur totale --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Longueur totale <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-arrow-up-down"></i></span>
                                    <input type="number" step="0.5" name="longueur_totale" 
                                           class="form-control @error('longueur_totale') is-invalid @enderror"
                                           value="{{ old('longueur_totale', $mesuresExistantes->data['longueur_totale'] ?? '') }}" 
                                           placeholder="ex: 165" required>
                                    <span class="input-group-text bg-light">cm</span>
                                </div>
                                @error('longueur_totale') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            {{-- Tour épaule (optionnel) --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tour épaule <span class="text-muted">(optionnel)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person-standing"></i></span>
                                    <input type="number" step="0.5" name="tour_epaule" 
                                           class="form-control"
                                           value="{{ old('tour_epaule', $mesuresExistantes->data['tour_epaule'] ?? '') }}" 
                                           placeholder="ex: 110">
                                    <span class="input-group-text bg-light">cm</span>
                                </div>
                            </div>

                            {{-- Tour cou (optionnel) --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tour cou <span class="text-muted">(optionnel)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-arrow-left-right"></i></span>
                                    <input type="number" step="0.5" name="tour_cou" 
                                           class="form-control"
                                           value="{{ old('tour_cou', $mesuresExistantes->data['tour_cou'] ?? '') }}" 
                                           placeholder="ex: 38">
                                    <span class="input-group-text bg-light">cm</span>
                                </div>
                            </div>

                            {{-- Largeur dos (optionnel) --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Largeur dos <span class="text-muted">(optionnel)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-arrow-left-right"></i></span>
                                    <input type="number" step="0.5" name="largeur_dos" 
                                           class="form-control"
                                           value="{{ old('largeur_dos', $mesuresExistantes->data['largeur_dos'] ?? '') }}" 
                                           placeholder="ex: 38">
                                    <span class="input-group-text bg-light">cm</span>
                                </div>
                            </div>

                            {{-- Hauteur taille (optionnel) --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Hauteur taille <span class="text-muted">(optionnel)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-arrow-up"></i></span>
                                    <input type="number" step="0.5" name="hauteur_taille" 
                                           class="form-control"
                                           value="{{ old('hauteur_taille', $mesuresExistantes->data['hauteur_taille'] ?? '') }}" 
                                           placeholder="ex: 102">
                                    <span class="input-group-text bg-light">cm</span>
                                </div>
                            </div>

                            {{-- Commentaires --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Commentaires supplémentaires</label>
                                <textarea name="commentaires" class="form-control" rows="3" 
                                          placeholder="Ex : épaules larges, bras longs, ventre, etc.">{{ old('commentaires', $mesuresExistantes->data['commentaires'] ?? '') }}</textarea>
                                <div class="form-text text-muted">
                                    <i class="bi bi-chat-dots"></i> Ces informations aideront le couturier à mieux ajuster votre vêtement.
                                </div>
                            </div>
                        </div>

                        {{-- Boutons d'action --}}
                        <div class="d-flex flex-column flex-sm-row gap-3 mt-5">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-cart-plus me-2"></i> Enregistrer et ajouter au panier
                            </button>
                            <a href="{{ route('produits.personnalisation', $produit) }}" 
                               class="btn btn-outline-secondary btn-lg px-4">
                                <i class="bi bi-arrow-left me-2"></i> Retour à la personnalisation
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Lien d'aide (optionnel mais rassurant) --}}
            <div class="text-center mt-4">
                <a href="#" class="text-muted small text-decoration-none">
                    <i class="bi bi-question-circle me-1"></i> Comment bien prendre mes mesures ?
                </a>
            </div>
        </div>
    </div>
</div>
@endsection