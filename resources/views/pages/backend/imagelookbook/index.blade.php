@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Images Lookbook</h1>

    <a href="{{ route('admin.image-lookbooks.create') }}" class="btn btn-primary mb-3">Nouvelle Image</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>URL (ID)</th>
                <th>Lookbook</th>
                <th>Est Principale</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td>
                        @if($image->url)                       
                            <img src="{{ $image->drive_image_url }}">

                            <img src="https://drive.google.com/uc?export=view&id={{ $image->url }}" alt="Image Lookbook" style="max-width:150px; max-height:100px;">
                        @else
                            Pas d'image
                        @endif
                    </td>
                    <td>{{ $image->url }}</td>
                    <td>{{ $image->lookbook->titre ?? '' }}</td>
                    <td>{{ $image->is_principale ? 'Oui' : 'Non' }}</td>
                    <td>
                        <a href="{{ route('admin.image-lookbooks.show', $image) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('admin.image-lookbooks.edit', $image) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('admin.image-lookbooks.destroy', $image) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $images->links('pagination::bootstrap-5') }}
</div>
@endsection
