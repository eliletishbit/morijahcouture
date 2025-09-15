@extends('layouts.frontendapp')

@section('content')
<div class="container-fluid p-0 py-4 px-4">
    @include('partials.heroslider')
    @include('partials.featured-categories')
    @include('partials.complementarysection')
    {{-- @include('partials.popularproducts')
    @include('partials.dailybestsells')
    @include('partials.whyus')
    @include('partials.productsquickview') --}}
</div>
@endsection
