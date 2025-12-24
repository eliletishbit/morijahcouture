@extends('layouts.frontendapp')

@section('content')

<div class="container my-5">
    <h1 class="fw-bold mb-4">Mes commandes</h1>

    @if($commandes->isEmpty())
        <p>Vous n'avez aucune commande pour le moment.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numéro de commande</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td>{{ $commande->numero_commande }}</td>
                        <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ number_format($commande->total, 2, ',', ' ') }} €</td>
                        <td>{{ ucfirst($commande->statut) }}</td>
                        <td>
                            <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-sm btn-primary">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $commandes->links() }}
    @endif
</div>

@endsection
