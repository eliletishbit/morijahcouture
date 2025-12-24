@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des produits</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Collection</th>
                <th>Sous-catégorie</th>
                <th>Matériau</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->image_produit)
                    
                        <img src="{{ asset('storage/' . $product->image_produit) }}" alt="{{ $product->nom }}" width="80" />
                    @else
                        Aucune image
                    @endif
                </td>                
                <td>{{ $product->nom }}</td>
                <td>{{ $product->collection->nom ?? 'Non définie' }}</td>
                <td>{{ $product->sousCategorie->nom ?? 'Non définie' }}</td>
                <td>{{ $product->materiau->nom ?? 'Non défini' }}</td>
                <td>{{ number_format($product->prix_base, 2, ',', ' ') }} €</td>
                <td>
                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
