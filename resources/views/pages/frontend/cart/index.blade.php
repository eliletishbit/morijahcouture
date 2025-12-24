@extends('layouts.frontendapp')

@section('content')

<div class="container my-5">
    <h1 class="fw-bold mb-4">Shop Cart</h1>
    <p class="mb-4 text-muted">Location in 382480</p>

    @if(empty($cart))
        <p class="lead">Votre panier est vide.</p>
        <a href="{{ route('shop.grid') }}" class="btn btn-primary">Continuer vos achats</a>
    @else
        <div class="alert alert-danger p-2 mb-4" role="alert">
            Livraison GRATUITE. Finalisez votre  <a href="{{ route('checkout') }}" class="alert-link"> commande dès maintenant !</a>
        </div>

        <ul class="list-group list-group-flush">
            @foreach ($cart as $id => $item)
                <li class="list-group-item py-3 ps-0 border-top">
                    <div class="row align-items-center">
                        <div class="col-6 col-md-6 col-lg-7 d-flex align-items-center">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['nom'] }}" class="icon-shape icon-xxl me-3" />
                            <div>
                                <h6 class="mb-1">{{ $item['nom'] }}</h6>
                                @if(isset($item['description']))
                                    <small class="text-muted d-block mb-2">{{ $item['description'] }}</small>
                                @endif
                                <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-link p-0 text-decoration-none text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="col-4 col-md-3 col-lg-3">
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="this.nextElementSibling.stepDown(); this.form.submit();">-</button>
                                <input 
                                  type="number" 
                                  name="quantite" 
                                  class="form-control form-control-sm mx-2 text-center" 
                                  min="1" 
                                  max="{{ $item['stock'] ?? 1000 }}" 
                                  value="{{ $item['quantite'] }}" 
                                  style="width: 60px;" 
                                  onchange="this.form.submit();" 
                                />
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="this.previousElementSibling.stepUp(); this.form.submit();">+</button>
                            </form>
                        </div>

                        <div class="col-2 text-end">
                            <strong class="text-danger">{{ number_format($item['prix'] * $item['quantite'], 2, ',', ' ') }} €</strong>
                            @if(isset($item['old_price']))
                                <div class="text-decoration-line-through text-muted small">{{ number_format($item['old_price'], 2, ',', ' ') }} €</div>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        @php
            $total = 0;
            foreach($cart as $item) {
                $total += $item['prix'] * $item['quantite'];
            }
        @endphp

        <div class="d-flex justify-content-between align-items-center mt-4">
            <strong>Total: {{ number_format($total, 2, ',', ' ') }} €</strong>
            <div>
                <a href="{{ route('shop.grid') }}" class="btn btn-primary me-2">Continuer vos achats</a>
                <a href="{{ route('checkout') }}" class="btn btn-dark">Passer à la caisse</a>
            </div>
        </div>
    @endif
</div>

@endsection
