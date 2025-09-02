<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles & Scripts compilés par Vite -->
    @vite(['resources/sass/app.scss', 'resources/assets/css/theme.min.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />


    <!-- Styles spécifiques template chargés après Bootstrap/Vite -->
    <link href="{{ asset('assets/libs/slick-carousel/slick/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" />

    <!-- Scripts async dans head (Google, Clarity, etc.) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag("js", new Date());
        gtag("config", "G-M8S4MT3EYG");
    </script>
    {{-- scripts et styles via push --}}

    @stack('styles')  {{-- C’est ici que les styles poussé via @push('styles') seront injectés --}}
</head>
<body>
    <div id="app">


        @include('partials.header-frontend')
        @include('partials.sidebar-frontend')

        <main>
            @yield('content')
        </main>

        @include('partials.footer-frontend')


    </div>

  <!-- Scripts JS du template -->
    <script src="{{ asset('assets/libs/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/validation.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

      <!-- Theme JS -->
      <script src="assets/js/theme.min.js"></script>

      <script src="{{ asset('assets/js/vendors/jquery.min.js')}}"></script>
      <script src="{{ asset('assets/js/vendors/countdown.js')}}"></script>
      <script src="{{ asset('assets/libs/slick-carousel/slick/slick.min.js')}}"></script>
      <script src="{{ asset('assets/js/vendors/slick-slider.js')}}"></script>
      <script src="{{ asset('assets/libs/tiny-slider/dist/min/tiny-slider.js')}}"></script>
      <script src="{{ asset('assets/js/vendors/tns-slider.js')}}"></script>
      <script src="{{ asset('assets/js/vendors/zoom.js')}}"></script>
</body>
</html>
