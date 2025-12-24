@extends('layouts.frontendapp')

@section('content')

<div class="container my-5">
    <h1 class="fw-bold mb-4">Commande {{ $commande->numero_commande }}</h1>

    <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Statut :</strong> {{ ucfirst($commande->statut) }}</p>
    <p><strong>Mode de livraison :</strong> {{ $commande->modeLivraison->nom ?? 'N/A' }}</p>
    <p><strong>Adresse de livraison :</strong><br>{{ nl2br(e($commande->adresse_livraison)) }}</p>
    <p><strong>Adresse de facturation :</strong><br>{{ nl2br(e($commande->adresse_facturation)) }}</p>
    <p><strong>Méthode de paiement :</strong> {{ ucfirst($commande->methode_paiement) }}</p>
    @if($commande->notes)
        <p><strong>Notes :</strong><br>{{ nl2br(e($commande->notes)) }}</p>
    @endif

    <h3 class="mt-5 mb-3">Détails des produits</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->produits as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->pivot->quantite }}</td>
                    <td>{{ number_format($produit->pivot->prix_unitaire, 2, ',', ' ') }} €</td>
                    <td>{{ number_format($produit->pivot->prix_total, 2, ',', ' ') }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-end">Montant total : {{ number_format($commande->total, 2, ',', ' ') }} €</h4>

    <a href="{{ route('commandes.index') }}" class="btn btn-secondary mt-4">Retour à la liste</a>
</div>

@endsection
