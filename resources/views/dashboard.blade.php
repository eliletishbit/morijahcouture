@extends('layouts.backendapp')

@section('content')
<div class="container-fluid m-0 auto">
    @if(Auth::check())
        @if(Auth::user()->role == 'admin')
            {{-- Rediriger vers la vue admin --}}
            @include('pages.backend.dashboardadmin')
        @else
            {{-- Rediriger vers la vue utilisateur simple --}}
            @include('pages.backend.dashboarduser')
        @endif
    @else
        <p>Utilisateur non connecté.</p>
    @endif
</div>
@endsection
