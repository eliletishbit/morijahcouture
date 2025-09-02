@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Catégorie : {{ $category->nom }}</h1>
    <p>{{ $category->description }}</p>

    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">Modifier cette catégorie</a>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
