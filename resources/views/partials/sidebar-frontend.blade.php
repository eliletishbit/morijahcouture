<div class="offcanvas offcanvas-start p-4 w-xxl-20 w-lg-30" id="navbar-default2">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <a href="{{route('welcome.index')}}"><img style="width:50px;" src="{{asset('assets/images/logo/logomorijah.png')}}" alt="eCommerce HTML Template" /></a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="my-4">
        <form action="#">
            <div class="input-group">
            <input class="form-control rounded" type="search" placeholder="Rechercher un produit" />
            <span class="input-group-append">
                <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </span>
            </div>
        </form>
        {{-- <div class="mt-2">
            <button type="button" class="btn btn-outline-gray-400 text-muted w-100" data-bs-toggle="modal" data-bs-target="#locationModal">
            <i class="feather-icon icon-map-pin me-2"></i>
            Choisir un emplacement
            </button>
        </div> --}}
    </div>
    <div class="mb-4">
        <a style="background-color:#ab5440; color:white;border:0px;"
            class="btn btn-primary w-100 d-flex justify-content-center align-items-center"
            data-bs-toggle="collapse"
            href="#collapseExample"
            role="button"
            aria-expanded="false"
            aria-controls="collapseExample">
            <span class="me-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-grid">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            </span>
            Toutes les catégories
        </a>
        <div class="collapse mt-2" id="collapseExample">
            <div class="card card-body">
            <ul class="mb-0 list-unstyled">
                  @foreach($categories as $category)
                    <li>
                        <a class="dropdown-item" href="{{ route('shop.grid', ['categorie' => $category->id]) }}">
                            {{ $category->nom }}
                        </a>
                    </li>
                @endforeach
            </ul>
            </div>
        </div>
    </div>
    <div class="h-100" data-simplebar="">
        <ul class="navbar-nav navbar-nav-offcanvac" style="font-size:3.7rem;">          
             {{-- <li class="nav-item w-100 w-lg-auto">
            <a class="nav-link" href="{{route('user.lookbooks.index')}}" >Lookbooks</a>
            </li> --}}
             
                <li class="nav-item w-100 w-lg-auto">
                    <a class="nav-link" href="{{ route('collections.show', ['id' => 1]) }}">
                        vetements sur mesure
                    </a>
                </li>
         
            <li class="nav-item w-100 w-lg-auto">
                <a class="nav-link" href="https://www.sumissura.com/fr/?utm_source=hockerty">Femmes</a>
            </li>          
               <li class="nav-item w-100 w-lg-auto">
                <a class="nav-link" href="dashboard/index.html">A propos</a>
            </li> 
            <br/> <br/>
                   
             <li class="nav-item w-100 w-lg-auto"><a class="nav-link" href="dashboard/index.html">Contactez-nous</a></li> 
             <li class="nav-item w-100 w-lg-auto"><a class="nav-link" href="dashboard/index.html">Commander échantillons</a></li> 
             <li class="nav-item w-100 w-lg-auto"><a class="nav-link" href="dashboard/index.html">Carte cadeaux</a></li> 
             
          
        </ul>
    </div>
</div>
