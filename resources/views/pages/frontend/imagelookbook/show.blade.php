@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détail Image Lookbook</h1>

    <p><strong>ID :</strong> {{ $imageLookbook->id }}</p>
    <p><strong>Lookbook :</strong> {{ $imageLookbook->lookbook->titre ?? '' }}</p>
    <p><strong>Est Principale :</strong> {{ $imageLookbook->is_principale ? 'Oui' : 'Non' }}</p>

    <p><strong>Image :</strong></p>
    @if($imageLookbook->url)
        <img src="https://drive.google.com/uc?export=view&id={{ $imageLookbook->url }}" alt="Image Lookbook" style="max-width:400px;">
    @else
        Pas d'image disponible
    @endif

    <a href="{{ route('admin.image-lookbooks.edit', $imageLookbook) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.image-lookbooks.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
