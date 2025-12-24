 @extends('layouts.frontendapp')

@section('content')

   <section
    class="vh-100 d-flex align-items-center"
    style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('storage/' . $collection->image_principale) }}') no-repeat center center/cover;"
>
    <div class="container">
        <div class="row">
            <!-- Colonne gauche contenant le texte -->
            <div class="col-12 col-md-5 text-white d-flex flex-column justify-content-center" style="min-height: 70vh;">
                <h1 class="display-3 fw-bold" style="color:white;">
                    {{ $nomcollection ?? $collection->nom }} sur mesure
                </h1>
                <p class="lead mb-4">
                    {{ $collection->description }}
                </p>
                <a href="http://127.0.0.1:8000/produits/11/personnalisation" class="btn btn-primary btn-lg rounded-pill">
                    Créez votre {{ $nomdelacollection ?? $collection->nom }}
                </a>
                
            </div>

            <!-- Colonne droite vide pour l'espacement -->
            <div class="col-12 col-md-7"></div>
        </div>
    </div>
</section>


    <section class="container my-5">
    <h2 class="mb-4 text-center">Comment créer votre collection sur mesure</h2>
    <div class="row text-center">
        <!-- Colonne 1 -->
        <div class="col-md-4 mb-4">
            <div class="mb-3">
                <i class="bi bi-basket-fill fs-1 text-primary"></i>
            </div>
            <h5>Choisissez le tissu de votre costume</h5>
            <p>À chaque nouvelle saison, nous faisons une sélection minutieuse des tissus de costumes les plus raffinés afin de vous offrir un confort et une élégance inégalés au quotidien.</p>
        </div>

        <!-- Colonne 2 -->
        <div class="col-md-4 mb-4">
            <div class="mb-3">
                <i class="bi bi-pencil-square fs-1 text-success"></i>
            </div>
            <h5>Personnalisez votre costume</h5>
            <p>Personnalisez intégralement votre costume sur-mesure jusque dans les moindres détails. Du choix des revers à la coupe du pantalon en passant par les boutons, la couleur des fils, ou encore la doublure, découvrez nos nombreuses options de configuration !</p>
        </div>

        <!-- Colonne 3 -->
        <div class="col-md-4 mb-4">
            <div class="mb-3">
                <i class="bi bi-truck fs-1 text-warning"></i>
            </div>
            <h5>Entrez vos mesures</h5>
            <p>C'est ici que nous faisons toute la différence ! Peu importe votre taille, votre costume sera parfaitement taillé à vos mesures.</p>
        </div>
    </div>
</section>

   <section class="mb-lg-10 mt-lg-14 my-8">
        <div class="row align-items-center" >
                <!-- Colonne de texte -->
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="display-5 fw-bold mb-4">Notre technologie pour un ajustement parfait</h2>
                    <p class="lead mb-4">Vous percevez clairement une différence lorsque vos vêtements sont minutieusement fabriqués. Avant que nos artisans tailleurs ne confectionnent chaque pièce à la main, notre algorithme exploite une multitude de données sur les mesures pour assurer un ajustement impeccable.</p>
                    <p class="mb-5">Difficile à croire, facile à prouver.</p>
                    <a href="#" class="btn btn-outline-dark btn-lg">En savoir plus</a>
                </div>
                
                <!-- Colonne vidéo -->
                <div class="col-lg-6">
                    <div class="video-container">
                        <!-- Remplacez "votre-video.mp4" par le chemin de votre vidéo -->
                       <video width="100%" controls muted autoplay poster="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 9'%3E%3C/svg%3E">
                            <source src="{{asset('assets/videos/vid.mp4')}}" type="video/mp4">
                            Votre navigateur ne supporte pas la lecture de vidéos.
                        </video>
                        
                        <!-- Placeholder si la vidéo n'est pas disponible -->
                        <div class="video-placeholder" style="display: none;">
                            <div class="text-center p-4">
                                <div class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-play-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445z"/>
                                    </svg>
                                </div>
                                <p>Vidéo de démonstration</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>             
        </div>


        <div class="ideetenue px-4  py-4 " style="background-color:#212727; color:white;">
                <x-ideetenue :tenueproduits="$tenueproduits" />
        </div>
       
     
        <div class="container py-5 ecologie">
                {{-- Première rangée --}}
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                    <img src="{{ asset('assets/images/home/ecologi1.jpg') }}" alt="Tenue Image" class="img-fluid rounded shadow">
                    </div>
                    <div class="col-md-6">
                    <h2>Notre planète vous en sera reconnaissante</h2>
                    <p>Sentez-vous bien dans vos vêtements tout en restant conscient de votre empreinte écologique. Avec une pièce unique, plus de gaspillage.</p>
                    <a href="#!" class="btn btn-primary">Decouvrez notre processus</a>
                    </div>
                </div>

                {{-- Deuxième rangée --}}
                <div class="row align-items-center">
                    {{-- Col texte à gauche (ordre 1 desktop) --}}
                    <div class="col-md-6 order-md-1 order-2 mb-3 mb-md-0">
                    <h2>Des tenues qui durent</h2>
                    <p>Nous reconnaissons l'importance des détails, et cela se reflète dans nos tissus durables et notre processus méticuleux de contrôle 
                        qualité. Commandez dès maintenant des échantillons gratuits parmi notre vaste choix de plus de 150 tissus, et soyez assuré de porter un vêtement intemporel.</p>
                    <a href="#!" class="btn btn-primary">Commandez des echantillions</a>
                    </div>
                    {{-- Col image à droite (ordre 2 desktop) --}}
                    <div class="col-md-6 order-md-2 order-1">
                    <img src="{{ asset('assets/images/home/ecologi2.jpg') }}" alt="Tenue Image" class="img-fluid rounded shadow">
                    </div>
                </div>
        </div>
    </section>

<div class="mt-4">
<div class="container"> 

<!-- Breadcrumb -->
<div class="row">
<div class="col-12">
<nav aria-label="breadcrumb">
<ol class="breadcrumb mb-0">
<li class="breadcrumb-item"><a href="{{ route('welcome.index') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('shop.grid') }}">Shop</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $collection->nom }}</li>
</ol>
</nav>
</div>
</div>

<!-- Page header -->
<div class="row">
<div class="col-lg-12">
<div class="card mb-4 bg-light border-0">
<div class="card-body p-9">
<h2 class="mb-0 fs-1">{{ $collection->nom }}</h2>
<p>{{ $collection->description }}</p>
</div>
</div>
</div>
</div>

<!-- Products list -->
<div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3 mt-2">
@foreach ($collection->produits as $produit)
    <div class="col">
        <div class="card card-product">
            <div class="card-body">
                <div class="text-center position-relative">
                    <a href="{{ route('products.show', ['product' => $produit->id]) }}">
                        <img src="{{ asset('storage/' . $produit->image_produit) }}" alt="{{ $produit->nom }}" class="mb-3 img-fluid" style="height:250px; width:175px;">
                    </a>
                </div>
                
                <h2 class="fs-6">
                    <a href="{{ route('products.show', ['product' => $produit->id]) }}" class="text-inherit text-decoration-none">{{ $produit->nom }}</a>
                </h2>
            
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <span class="text-dark">{{ number_format($produit->prix_base ?? 0, 2, ',', ' ') }} €</span>
                        @if(!empty($produit->prix_ancien) && $produit->prix_ancien > $produit->prix_base)
                            <span class="text-decoration-line-through text-muted">{{ number_format($produit->prix_ancien, 2, ',', ' ') }} €</span>
                        @endif
                    </div>
                    <div>
                        @if($produit->personnalisable)
                            <a href="{{ route('produits.personnalisation', ['product' => $produit->id]) }}" class="btn btn-primary">
                                Personnaliser 
                            </a>
                        @else

                        <a href="{{ route('products.show', ['product' => $produit->id]) }}" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>

</div>
</div>
@endsection 