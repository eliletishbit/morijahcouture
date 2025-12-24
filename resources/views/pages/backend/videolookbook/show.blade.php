@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Détails de la Vidéo Lookbook</h1>

    <p><strong>ID :</strong> {{ $videoLookbook->id }}</p>
    <p><strong>URL :</strong> {{ $videoLookbook->url }}</p>
    <p><strong>Lookbook :</strong> {{ $videoLookbook->lookbook->titre ?? '' }}</p>

    <a href="{{ route('admin.video-lookbooks.edit', $videoLookbook) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('admin.video-lookbooks.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
