<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
     
     <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles & Scripts compilés par Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />

    {{-- styles et scripts pour le dashboard admin/user --}}

      <!-- Bootstrap 5 CSS + Icons + Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- ApexCharts -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Styles spécifiques template chargés après Bootstrap/Vite -->
    <link href="{{ asset('assets/libs/slick-carousel/slick/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
<script>
   window.dataLayer = window.dataLayer || [];
   function gtag() {
      dataLayer.push(arguments);
   }
   gtag("js", new Date());

   gtag("config", "G-M8S4MT3EYG");
</script>
 <script type="text/javascript">
   (function (c, l, a, r, i, t, y) {
      c[a] =
         c[a] ||
         function () {
            (c[a].q = c[a].q || []).push(arguments);
         };
      t = l.createElement(r);
      t.async = 1;
      t.src = "https://www.clarity.ms/tag/" + i;
      y = l.getElementsByTagName(r)[0];
      y.parentNode.insertBefore(t, y);
   })(window, document, "clarity", "script", "kuc8w5o9nt");
</script>

<style>
    /*styles du dashboarduser*/
    :root {
      --citrus-primary: #8cc63f;   /* vert citron vif */
      --citrus-primary-dark: #6b9c2a;
      --citrus-primary-soft: #e9f5df;
      --citrus-gold: #f9b23f;
      --citrus-gold-soft: #fff1e0;
      --dark-text: #1e2a2e;
      --muted-text: #5a6e6f;
      --card-bg: #ffffff;
      --shadow-sm: 0 8px 20px rgba(0, 0, 0, 0.03), 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    body {
      background: #f5f7fb;
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
      color: var(--dark-text);
    }

    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap');

    .main-content-wrapper {
      margin-top: 2rem;
      margin-bottom: 3rem;
    }

    .card-lg {
      border: none;
      border-radius: 1.5rem;
      background: var(--card-bg);
      box-shadow: var(--shadow-sm);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-lg:hover {
      transform: translateY(-3px);
      box-shadow: 0 16px 30px -12px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
      background-color: var(--citrus-primary);
      border-color: var(--citrus-primary);
      font-weight: 600;
      padding: 0.6rem 1.4rem;
      border-radius: 2rem;
      transition: all 0.2s;
      color: #1a2e1a;
    }
    .btn-primary:hover {
      background-color: var(--citrus-primary-dark);
      border-color: var(--citrus-primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(140, 198, 63, 0.3);
      color: white;
    }

    .icon-shape {
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 1.2rem;
    }

    .badge {
      padding: 0.45rem 1rem;
      font-weight: 500;
      border-radius: 2rem;
      font-size: 0.75rem;
    }
    .bg-light-primary {
      background-color: #eef5e2 !important;
      color: #568c2a !important;
    }
    .bg-light-warning {
      background-color: #fff0db !important;
      color: #c97e0b !important;
    }
    .bg-light-danger {
      background-color: #ffe4e2 !important;
      color: #c0392b !important;
    }
    .bg-light-info {
      background-color: #e4f0fa !important;
      color: #2c7da0 !important;
    }
    .text-dark-primary { color: #568c2a; }
    .text-dark-warning { color: #c97e0b; }
    .text-dark-danger { color: #c0392b; }
    .text-dark-info { color: #2c7da0; }

    .progress {
      border-radius: 10px;
      background-color: #edf2ec;
    }
    .bg-primary { background-color: var(--citrus-primary) !important; }
    .bg-info { background-color: #50b5e0 !important; }
    .bg-danger { background-color: #e46d5d !important; }

    .link-info {
      color: var(--citrus-primary);
      text-decoration: none;
      font-weight: 500;
    }
    .link-info:hover {
      color: var(--citrus-primary-dark);
      text-decoration: underline;
    }

    select.form-select {
      background-color: #f8faf6;
      border-radius: 2rem;
      border: 1px solid #e2e8e0;
      font-size: 0.85rem;
      font-weight: 500;
    }

    h1, h2, h3, h4, h5 {
      font-weight: 600;
    }
    .table-hover > tbody > tr:hover {
      background-color: #fafef5;
    }
    @media (max-width: 768px) {
      .main-content-wrapper {
        width: 92% !important;
      }
    }
</style>

    @stack('styles')  {{-- C’est ici que les styles poussé via @push('styles') seront injectés --}}
</head>
<body>
    <div id="app" class="px-0 py-0"  style="border:1px solid rgb(184, 176, 176);">

        @include('partials.header-admin')
        @include('partials.sidebar-admin')

        {{-- <main class="py-4 px-4" style="width:70%;margin:0 auto;margin-top:60px;">
            @yield('content')
        </main> --}}

        
        <main class="container-fluid " style="width:70%;margin:0 auto;margin-top:60px;" >
            @yield('content')
        </main>

        @include('partials.footer-admin')

    </div>


   <script src="{{ asset('assets/js/product-form.js') }}"></script>
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
