<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles & Scripts compilés par Vite -->
    {{-- @vite(['resources/sass/app.scss', 'resources/assets/css/theme.min.css','resources/js/app.js']) --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />
     <!-- Bootstrap CSS + Icons + Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Styles spécifiques template chargés après Bootstrap/Vite -->
    <link href="{{ asset('assets/libs/slick-carousel/slick/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
    <!--styles pour le panier-->
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/feather-webfont/dist/feather-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    
@if(app()->environment('production'))
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/theme.min.css') }}">
    <script src="{{ asset('build/assets/app.js') }}" defer></script>
@else
    @vite([
        'resources/sass/app.scss', 
        'resources/assets/css/theme.min.css', 
        'resources/js/app.js'
    ])
@endif

    <!-- Scripts async dans head (Google, Clarity, etc.) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag("js", new Date());
        gtag("config", "G-M8S4MT3EYG");
    </script>
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
    {{-- scripts et styles via push --}}

    @stack('styles')  {{-- C’est ici que les styles poussé via @push('styles') seront injectés --}}
    {{-- @livewireStyles --}}
</head>
<body>
    <div id="app" class="px-0">


        @include('partials.header-frontend')
        @include('partials.sidebar-frontend')

      <main class="p-0 m-0" style="width: 100%; max-width: 100%;">
  @yield('content')
</main>


        @include('partials.footer-frontend')

           
        {{-- @livewireScripts --}}
    </div>


    <!-- Bouton retour en haut --> 
<a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'});" class="btn btn-secondary position-fixed bottom-3 start-50 translate-middle-x" style="z-index: 9999;">
    Retour en haut
</a>


  
<!-- jQuery d'abord (obligatoire pour certains plugins) -->
<script src="{{ asset('assets/js/vendors/jquery.min.js') }}"></script>

<!-- Bootstrap ensuite -->
<!-- <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- Puis les autres scripts -->
<script src="{{ asset('assets/libs/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/validation.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/countdown.js') }}"></script>
<script src="{{ asset('assets/js/vendors/slick-slider.js') }}"></script>
<script src="{{ asset('assets/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/js/vendors/tns-slider.js') }}"></script>
<script src="{{ asset('assets/js/vendors/zoom.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script defer>
document.addEventListener('DOMContentLoaded', function () {
    // Initialisation du carousel
    var myCarousel = document.querySelector('#ideetenueCarousel');
    var carousel = bootstrap.Carousel.getInstance(myCarousel)
        || new bootstrap.Carousel(myCarousel, {
            interval: false,
            ride: false,
            pause: 'hover',
            touch: true,
        });
    myCarousel.querySelectorAll('.carousel-item').forEach(function(item) {
        item.style.transitionDuration = '15000ms';
    });

    // ========== GESTION DU MODAL ==========
    const productModal = document.getElementById('productModal');
    
    if (productModal) {
        productModal.addEventListener('show.bs.modal', async function (event) {
            // Récupérer le bouton qui a déclenché le modal
            const button = event.relatedTarget;
            
            // Vérifier que le bouton existe et a l'attribut data-product
            if (!button || !button.getAttribute('data-product')) {
                console.error('Bouton ou data-product manquant');
                return;
            }
            
            // Récupérer les données du produit depuis l'attribut data-product
            let productData;
            try {
                productData = JSON.parse(button.getAttribute('data-product'));
            } catch (e) {
                console.error('Erreur de parsing JSON', e);
                return;
            }
            
            // Remplir les champs du modal
            const modalImage = document.getElementById('modalProductImage');
            const modalTitle = document.getElementById('modalProductTitle');
            const modalDescription = document.getElementById('modalProductDescription');
            
            if (modalImage) modalImage.src = '/storage/' + productData.image_produit;
            if (modalTitle) modalTitle.innerText = productData.nom;
            if (modalDescription) modalDescription.innerText = productData.description || 'Aucune description disponible.';
            
            // Récupérer les pièces de la tenue via l'API
            const piecesListDiv = document.getElementById('modalPiecesList');
            if (piecesListDiv) {
                piecesListDiv.innerHTML = '<div class="text-center w-100">Chargement des pièces...</div>';
                
                try {
                    const response = await fetch(`/api/produit/${productData.id}/pieces`);
                    const data = await response.json();
                    
                    if (data.pieces && data.pieces.length > 0) {
                        piecesListDiv.innerHTML = '';
                        data.pieces.forEach(piece => {
                            const pieceCard = `
                                <div class="card" style="width: 150px;">
                                    <img src="/storage/${piece.image_produit}" class="card-img-top" alt="${piece.nom}" style="height: 120px; object-fit: cover;">
                                    <div class="card-body p-2">
                                        <h6 class="card-title">${piece.nom}</h6>
                                        <p class="card-text mb-1">${piece.prix_base} €</p>
                                        <a href="/produit/${piece.id}" class="btn btn-primary btn-sm w-100">Voir</a>
                                    </div>
                                </div>
                            `;
                            piecesListDiv.innerHTML += pieceCard;
                        });
                    } else {
                        piecesListDiv.innerHTML = '<p class="text-muted">Aucune pièce disponible pour cette tenue.</p>';
                    }
                } catch (error) {
                    console.error('Erreur:', error);
                    piecesListDiv.innerHTML = '<p class="text-danger">Erreur lors du chargement des pièces.</p>';
                }
            }
        });
    } else {
        console.error('Modal #productModal non trouvé');
    }
});
</script>

</body>
</html>
