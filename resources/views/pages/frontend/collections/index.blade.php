{{-- liste des collections --}}
{{-- @extends('layouts.frontendapp')

@section('content')
<div class="container my-5">
    <h2>Collections dans {{ $sousCategorie->nom }}</h2>
    <div class="row g-4 mt-4">
        @foreach ($collections as $collection)
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $collection->image_principale) }}" class="card-img-top" alt="{{ $collection->nom }}" style="height:600px; width:300px;" >
                    <div class="card-body">
                        <h5 class="card-title">{{ $collection->nom }}</h5>
                        <p class="card-text">{{ Str::limit($collection->description, 100) }}</p>
                        <a href="{{ route('collections.show', ['id' => $collection->id]) }}" class="btn btn-primary">Voir la collection</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection --}}


@extends('layouts.frontendapp')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 fw-bold">Collections dans {{ $sousCategorie->nom }}</h2>
    <div class="row g-4">
        @forelse ($collections as $collection)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 rounded">
                    <div class="overflow-hidden" style="height: 280px;">
                        <img src="{{ asset('storage/' . $collection->image_principale) }}"
                             alt="{{ $collection->nom }}"
                             class="card-img-top rounded-top img-fluid"
                             style="object-fit: cover; width: 100%; height: 100%;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate" title="{{ $collection->nom }}">{{ $collection->nom }}</h5>
                        <p class="card-text flex-grow-1 text-truncate" title="{{ $collection->description }}">{{ Str::limit($collection->description, 100) }}</p>
                        <a href="{{ route('collections.show', ['id' => $collection->id]) }}" class="btn btn-primary mt-auto">
                            Voir la collection
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Aucune collection disponible dans cette sous-catégorie.</p>
        @endforelse
    </div>
</div>
@endsection

