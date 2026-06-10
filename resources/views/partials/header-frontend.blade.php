<!-- navbar -->
<div class="border-bottom">

   {{-- Debut banniere langues --}}
   <div class="py-4 bannierelangues" style="background-color:#2a2720; color:white; height:50px; ">
      <div class="container" >
         <div class="row" >
            <div class="col-md-6 col-12 text-center text-md-center" ><span>Garantie d'ajustement parfait - 100% unique</span></div>
            <div class="col-6 text-end d-none d-md-block">
               <div class="dropdown selectBox">
                  <a class="dropdown-toggle selectValue text-reset" href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                     <span class="me-2">
                        <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <g clip-path="url(#selectedlang)">
                              <path d="M0 0.5H16V12.5H0V0.5Z" fill="#012169" />
                              <path d="M1.875 0.5L7.975 5.025L14.05 0.5H16V2.05L10 6.525L16 10.975V12.5H14L8 8.025L2.025 12.5H0V11L5.975 6.55L0 2.1V0.5H1.875Z" fill="white" />
                              <path d="M10.6 7.525L16 11.5V12.5L9.225 7.525H10.6ZM6 8.025L6.15 8.9L1.35 12.5H0L6 8.025ZM16 0.5V0.575L9.775 5.275L9.825 4.175L14.75 0.5H16ZM0 0.5L5.975 4.9H4.475L0 1.55V0.5Z" fill="#C8102E" />
                              <path d="M6.025 0.5V12.5H10.025V0.5H6.025ZM0 4.5V8.5H16V4.5H0Z" fill="white" />
                              <path d="M0 5.325V7.725H16V5.325H0ZM6.825 0.5V12.5H9.225V0.5H6.825Z" fill="#C8102E" />
                           </g>
                           <defs>
                              <clipPath id="selectedlang">
                                 <rect width="16" height="12" fill="white" transform="translate(0 0.5)" />
                              </clipPath>
                           </defs>
                        </svg>
                     </span>
                     English
                  </a>
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="javascript:void(0)">English</a></li>
                     <li><a class="dropdown-item" href="javascript:void(0)">Deutsch</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- debut deuxieme ligne: logo, barre de recherche , icones --}}
   <div class="py-5">
      <div class="container">
         <div class="row w-100 align-items-center gx-lg-2 gx-0">

            <div class="col-xxl-2 col-lg-3 col-md-6 col-5">
               <button class="navbar-toggler collapsed d-none d-lg-block sidebar-opener" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbar-default2" aria-controls="navbar-default2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-text-indent-right text-primary" viewBox="0 0 16 16">
                     <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm10.646 2.146a.5.5 0 0 1 .708.708L11.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zM2 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                  </svg>
               </button>
               <a class="navbar-brand d-none d-lg-block" href="{{route('welcome.index')}}">
                  <img style="width:50px;" src="{{asset('assets/images/logo/logomorijah.png')}}" alt="eCommerce HTML Template" />
               </a>
            </div>

            <div class="col-xxl-5 col-lg-5 d-none d-lg-block">
               <form action="#">
                  <div class="input-group">
                     <input class="form-control rounded" type="search" placeholder="Rechercher un produit" />
                     <span class="input-group-append">
                        <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                              <circle cx="11" cy="11" r="8"></circle>
                              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                           </svg>
                        </button>
                     </span>
                  </div>
               </form>
            </div>

            <div class="col-md-2 col-xxl-3 d-none d-lg-block">
               <button type="button" class="btn btn-outline-gray-400 text-muted" data-bs-toggle="modal" data-bs-target="#locationModal">
                  <i class="feather-icon icon-map-pin me-2"></i> Emplacements
               </button>
            </div>

            <div class="col-lg-2 col-xxl-2 text-end col-md-6 col-7">
               <div class="list-inline">
                  <div class="list-inline-item me-5 me-lg-0" style="position: relative;right:25px;">
                     @auth
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Déconnexion">
                           <i class="fa fa-power-off"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                        </form>
                     @else
                        <a href="{{ route('login') }}" title="Connexion" class="text-muted">
                           <i class="fa fa-sign-in-alt"></i>
                        </a>
                     @endauth
                  </div>

                  {{-- Favoris temporairement supprimé --}}
                  
                  <div class="list-inline-item me-5 me-lg-0">
                     <a class="text-muted position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" href="#offcanvasExample" role="button" aria-controls="offcanvasRight">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                           <path d="M6 2L3 6v14a2 2 0 0 1 2 2h14a2 2 0 0 1 2-2V6l-3-4z"></path>
                           <line x1="3" y1="6" x2="21" y2="6"></line>
                           <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                           {{ session('cart') ? count(session('cart')) : 0 }}
                           <span class="visually-hidden">produits dans le panier</span>
                        </span>
                     </a>
                  </div>

                  <div class="list-inline-item d-inline-block d-lg-none">
                     <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbar-default" aria-controls="navbar-default" aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-text-indent-left text-primary" viewBox="0 0 16 16">
                           <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                        </svg>
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- navigation offcanvas --}}
   <nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4" aria-label="Offcanvas navbar large">
      <div class="container">
         <div class="offcanvas offcanvas-start truehomeoffcanva" tabindex="-1" id="navbar-default" aria-labelledby="navbar-defaultLabel">
            <div class="offcanvas-header pb-1">
               <a href="{{route('welcome.index')}}"><img style="width:50px;" src="{{asset('assets/images/logo/logomorijah.png')}}" alt="eCommerce HTML Template" /></a>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
               <div class="d-block d-lg-none mb-4">
                  <form action="#">
                     <div class="input-group">
                        <input class="form-control rounded" type="search" placeholder="Rechercher un produit" />
                        <span class="input-group-append">
                           <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                 <circle cx="11" cy="11" r="8"></circle>
                                 <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                              </svg>
                           </button>
                        </span>
                     </div>
                  </form>
                  <div class="mt-2">
                     <button type="button" class="btn btn-outline-gray-400 text-muted w-100" data-bs-toggle="modal" data-bs-target="#locationModal">
                        <i class="feather-icon icon-map-pin me-2"></i> Choisir un Emplacement
                     </button>
                  </div>
               </div>

               <div class="dropdown me-3 d-none d-lg-block">
                  <button class="btn btn-primary px-6 alldepartement" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                     <span class="me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                           <rect x="3" y="3" width="7" height="7"></rect>
                           <rect x="14" y="3" width="7" height="7"></rect>
                           <rect x="14" y="14" width="7" height="7"></rect>
                           <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                     </span>
                     Toutes les categories
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                     @foreach($categories as $category)
                        <li>
                           <a class="dropdown-item" href="{{ route('shop.grid', ['categorie' => $category->id]) }}">
                              {{ $category->nom }}
                           </a>
                        </li>
                     @endforeach
                  </ul>
               </div>
               <div>
                  <ul class="navbar-nav align-items-center" style="font-size:3.7rem;">
                     <li class="nav-item dropdown w-100 w-lg-auto">
                        <a class="nav-link dropdown-toggle" href="{{route('welcome.index')}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">Accueil</a>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="index.html">A propos</a></li>
                           <li><a class="dropdown-item" href="pages/index-2.html">Contact</a></li>
                           <li><a class="dropdown-item" href="pages/index-3.html">Blog</a></li>
                        </ul>
                     </li>
                     <li class="nav-item w-100 w-lg-auto">
                        <a class="nav-link" href="{{ route('collections.show', ['id' => 1]) }}">Vetements sur mesure</a>
                     </li>
                     <li class="nav-item w-100 w-lg-auto">
                        <a class="nav-link" href="https://www.sumissura.com/fr/?utm_source=hockerty">Femmes</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </nav>
</div>

{{-- Location Modal (garde-le tel quel si nécessaire) --}}
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-body p-6">
            <div class="d-flex justify-content-between align-items-start">
               <div>
                  <h5 class="mb-1" id="locationModalLabel">Choose your Delivery Location</h5>
                  <p class="mb-0 small">Enter your address and we will specify the offer you area.</p>
               </div>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="my-5">
               <input type="search" class="form-control" placeholder="Search your area" />
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
               <h6 class="mb-0">Select Location</h6>
               <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Clear All</a>
            </div>
            <div data-simplebar style="height: 300px">
               <div class="list-group list-group-flush">
                  <a href="#" class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action active">Alabama <span>Min:$20</span></a>
                  <a href="#" class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">Alaska <span>Min:$30</span></a>
                  <a href="#" class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">Arizona <span>Min:$50</span></a>
                  <a href="#" class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">California <span>Min:$29</span></a>
                  <a href="#" class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">Colorado <span>Min:$80</span></a>
                  <a href="#" class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">Florida <span>Min:$90</span></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- Shop Cart offcanvas (inchangé) --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
   <div class="offcanvas-header border-bottom">
      <div class="text-start">
         <h5 id="offcanvasRightLabel" class="mb-0 fs-4">Shop Cart</h5>
         <small>Location in 382480</small>
      </div>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
   </div>
   <div class="offcanvas-body">
      <div>
         <!-- alert -->
         <div class="alert alert-danger p-2" role="alert">
            You’ve got FREE delivery. Start <a href="#!" class="alert-link">checkout now!</a>
         </div>
         <!-- ici viendra le contenu réel du panier -->
         <div class="text-center py-4">Panier à implémenter</div>
      </div>
   </div>
</div>