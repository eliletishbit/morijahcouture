@extends('layouts.backendapp')

@section('content')
<div class="container">
    <h1>Liste des Vidéos Lookbook</h1>

    <a href="{{ route('admin.video-lookbooks.create') }}" class="btn btn-primary mb-3">Nouvelle Vidéo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>Lookbookvideo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
   @foreach($videos as $video)
<tr>
    <td>{{ $video->id }}</td>
    <td>{{ $video->url }}</td>

    <td>
        @php
            parse_str(parse_url($video->url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? '';
        @endphp

        @if($videoId)
            <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" 
                 alt="Miniature vidéo" 
                 style="width: 120px; cursor: pointer;"
                 data-bs-toggle="modal" data-bs-target="#videoModal{{ $video->id }}">
        @else
            N/A
        @endif
    </td>

    <td>{{ $video->lookbook->titre ?? '' }}</td>
    <td>
        <a href="{{ route('admin.video-lookbooks.show', $video) }}" class="btn btn-info btn-sm">Voir</a>
        <a href="{{ route('admin.video-lookbooks.edit', $video) }}" class="btn btn-warning btn-sm">Modifier</a>
        <form action="{{ route('admin.video-lookbooks.destroy', $video) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Supprimer</button>
        </form>
    </td>
</tr>

<!-- Bootstrap Modal -->
<div class="modal fade" id="videoModal{{ $video->id }}" tabindex="-1" aria-labelledby="videoModalLabel{{ $video->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="ratio ratio-16x9">
          <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

@endforeach

        </tbody>
    </table>

    {{ $videos->links('pagination::bootstrap-5') }}
</div>
@endsection
