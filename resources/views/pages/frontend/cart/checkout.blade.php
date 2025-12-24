@extends('layouts.frontendapp')

@section('content')

<div class="container my-5">
    <h1 class="fw-bold mb-4">Checkout</h1>
    <p class="mb-5 text-muted">Finalize your purchase and enter your payment details</p>
    
    <div class="row">
        <!-- Colonne gauche : formulaire de facturation et paiement -->
        <div class="col-lg-7 col-md-12">
            <div class="card p-4 mb-4 shadow-sm">
                <h4 class="mb-4">Détails de facturation</h4>

                <form action="{{ route('commandes.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="fullname" class="form-label">Nom complet</label>
                        <input 
                            type="text" 
                            id="fullname" 
                            name="fullname" 
                            class="form-control @error('fullname') is-invalid @enderror" 
                            value="{{ old('fullname', $user->name ?? '') }}" 
                            required 
                        />
                        @error('fullname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email', $user->email ?? '') }}" 
                            required 
                        />
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="adresse_livraison" class="form-label">Adresse de livraison</label>
                        <textarea 
                            id="adresse_livraison" 
                            name="adresse_livraison" 
                            class="form-control @error('adresse_livraison') is-invalid @enderror" 
                            rows="3" 
                            required
                        >{{ old('adresse_livraison') }}</textarea>
                        @error('adresse_livraison') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="adresse_facturation" class="form-label">Adresse de facturation</label>
                        <textarea 
                            id="adresse_facturation" 
                            name="adresse_facturation" 
                            class="form-control @error('adresse_facturation') is-invalid @enderror" 
                            rows="2" 
                            required
                        >{{ old('adresse_facturation') }}</textarea>
                        @error('adresse_facturation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="instructions_livraison" class="form-label">Instructions de livraison (optionnel)</label>
                        <textarea 
                            id="instructions_livraison" 
                            name="notes" 
                            class="form-control" 
                            rows="2"
                        >{{ old('instructions_livraison') }}</textarea>
                    </div>

                    <h4 class="mt-5 mb-4">Mode de livraison</h4>

                    @foreach($modesLivraison as $mode)
                        <div class="form-check mb-3">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="mode_livraison_id" 
                                id="modeLivraison{{ $mode->id }}" 
                                value="{{ $mode->id }}" 
                                {{ old('mode_livraison_id') == $mode->id ? 'checked' : ($loop->first ? 'checked' : '') }}
                            >
                            <label class="form-check-label" for="modeLivraison{{ $mode->id }}">
                                {{ $mode->nom }} — {{ number_format($mode->prix, 2, ',', ' ') }} € <br>
                                <small class="text-muted">{{ $mode->description }}</small>
                            </label>
                        </div>
                    @endforeach
                    @error('mode_livraison_id') <div class="text-danger mb-3">{{ $message }}</div> @enderror

                    <h4 class="mt-5 mb-4">Moyen de paiement</h4>

                    <div class="mb-3">
                    <label for="payment_methode" class="form-label">Méthode de paiement</label>
                    <select 
                        id="payment_methode" 
                        name="methode_paiement" 
                        class="form-select @error('methode_paiement') is-invalid @enderror" 
                        required
                    >
                        @foreach($methodesPaiement as $methode)
                            <option 
                                value="{{ $methode->code }}" 
                                {{ old('methode_paiement') == $methode->code ? 'selected' : '' }}
                            >
                                {{ $methode->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('methode_paiement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                    <button type="submit" class="btn btn-primary w-100 mt-4">Finaliser la commande</button>
                </form>
            </div>
        </div>

        <!-- Colonne droite : résumé de la commande -->
        <div class="col-lg-5 col-md-12">
            <div class="card p-4 shadow-sm">
                <h4 class="mb-4">Résumé de la commande</h4>

                @if(empty($cart))
                    <p>Votre panier est vide.</p>
                @else
                    <ul class="list-group list-group-flush mb-3">
                        @foreach($cart as $id => $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                <div>
                                    <div class="fw-bold">{{ $item['nom'] }}</div>
                                    <small>Quantité : {{ $item['quantite'] }}</small>
                                </div>
                                <span class="text-danger fw-bold">{{ number_format($item['prix'] * $item['quantite'], 2, ',', ' ') }} €</span>
                            </li>
                        @endforeach
                    </ul>

                    @php
                        $total = 0;
                        foreach($cart as $item){
                            $total += $item['prix'] * $item['quantite'];
                        }
                    @endphp

                    <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-3">
                        <span>Total</span>
                        <span>{{ number_format($commande->total ?? 0, 2, ',', ' ') }}  €</span>
                    </div>
                @endif

            </div>
        </div>
    </div>

</div>

@endsection
