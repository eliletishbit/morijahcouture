@extends('layouts.backendapp')

@section('content')


<main class="main-content-wrapper container" style="width:90%;">
  <section class="container px-0">

    <!-- Bannière de bienvenue utilisateur -->
    <div class="row mb-8">
      <div class="col-md-12">
        <div class="card bg-light border-0 rounded-4 overflow-hidden"
             style="background: linear-gradient(105deg, #ffffff 0%, #f9fef2 100%); border-left: 8px solid #8cc63f;">
          <div class="card-body p-lg-5 p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
              <div>
                <h1 class="display-6 fw-bold" style="color: #2c5a1a;">Bonjour, <span class="text-primary" style="color: #8cc63f;">{{ $user->name ?? 'Client' }}</span></h1>
                <p class="text-muted mb-3 fs-5">Bienvenue sur votre espace personnel. Commandez des vêtements et costumes sur mesure ou standards, personnalisez-les selon vos envies.</p>
                {{-- <a href="{{ route('shop.grid') }}"  class="btn btn-primary shadow-sm"><i class="fas fa-shopping-cart me-2"></i>Découvrir les produits</a> --}}
                <a href="#mes-commandes" class="btn shadow-sm ms-2" style="border-color: #8cc63f; color: #4a7729;"><i class="fas fa-truck me-2"></i>Mes commandes</a>
              </div>
              <div class="mt-3 mt-md-0">
                <i class="fas fa-user-astronaut fa-3x" style="color: #d1e6b0;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Cartes statistiques client -->
    <div class="table-responsive-xl mb-6 mb-lg-0">
      <div class="row flex-nowrap pb-3 pb-lg-0 g-4">
        <!-- Mes commandes -->
        <div class="col-lg-4 col-12">
          <div class="card h-100 card-lg border-0">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div><h4 class="mb-0 fs-5 fw-semibold">Mes commandes</h4></div>
                <div class="icon-shape" style="background: #eaf6e1; color: #6b9c2a;">
                  <i class="bi bi-bag-check fs-4"></i>
                </div>
              </div>
              <div class="lh-1">
                <h1 class="mb-2 fw-bold fs-1" style="color: #3a6b1f;">{{ $stats['total_commandes'] ?? 0 }}</h1>
                <span class="text-secondary"><i class="fas fa-check-circle me-1 text-success"></i> {{ $stats['commandes_livrees'] ?? 0 }} commandes livrées</span>
              </div>
            </div>
          </div>
        </div>

        <!-- En cours / personnalisation -->
        <div class="col-lg-4 col-12">
          <div class="card h-100 card-lg border-0">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div><h4 class="mb-0 fs-5 fw-semibold">Personnalisations</h4></div>
                <div class="icon-shape" style="background: #fff0db; color: #e67e22;">
                  <i class="bi bi-palette fs-4"></i>
                </div>
              </div>
              <div class="lh-1">
                <h1 class="mb-2 fw-bold fs-1" style="color: #b1560f;">{{ $stats['commandes_en_cours'] ?? 0 }}</h1>
                <span><span class="fw-semibold me-1 text-dark">{{ $mesuresRecentes->count() ?? 0 }}</span> mesures récentes</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Total dépensé / fidélité -->
        <div class="col-lg-4 col-12">
          <div class="card h-100 card-lg border-0">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div><h4 class="mb-0 fs-5 fw-semibold">Total dépensé</h4></div>
                <div class="icon-shape" style="background: #e1f5fe; color: #0288d1;">
                  <i class="bi bi-coin fs-4"></i>
                </div>
              </div>
              <div class="lh-1">
                <h1 class="mb-2 fw-bold fs-1" style="color: #146b3a;">{{ number_format($stats['total_depenses'] ?? 0, 0, ',', ' ') }} €</h1>
                <span><span class="fw-semibold me-1">{{ $stats['total_commandes'] ?? 0 }}</span> commandes passées</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Catalogue produits (aperçu) -->
    <div class="row mb-6 mt-4" id="produits">
      <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
          <h2 class="fs-2 fw-bold" style="color: #2c5a1a;"><i class="fas fa-tshirt me-2 text-primary"></i>Nos créations</h2>
          {{-- <a href="{{ route('shop.grid') }}" class="btn btn-sm btn-outline-primary rounded-pill">Voir tout <i class="fas fa-arrow-right ms-1"></i></a> --}}
        </div>
      </div>

      <!-- Produit 1 - Costume personnalisable -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 product-card">
          <img src="https://placehold.co/600x400/e9f5df/6b9c2a?text=Costume+sur+mesure" class="card-img-top rounded-top-4" alt="Costume sur mesure" style="height: 220px; object-fit: cover;">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="fw-bold">Costume cérémonie</h5>
              <span class="badge bg-light-primary text-dark-primary">Personnalisable</span>
            </div>
            <p class="text-muted small">Tissu au choix, doublure personnalisée, broderie possible.</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="fs-4 fw-bold text-success">249,00 €</span>
              {{-- <a href="{{ route('produits.personnalisation', 1) }}" class="btn btn-sm btn-primary rounded-pill"><i class="fas fa-sliders-h me-1"></i>Personnaliser</a> --}}
            </div>
          </div>
        </div>
      </div>

      <!-- Produit 2 - Robe personnalisable -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 border-0 shadow-sm rounded-4">
          <img src="https://placehold.co/600x400/fef5e7/e67e22?text=Robe+sur+mesure" class="card-img-top rounded-top-4" alt="Robe personnalisable" style="height: 220px; object-fit: cover;">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="fw-bold">Robe chic sur mesure</h5>
              <span class="badge bg-light-warning text-dark-warning">Sur devis</span>
            </div>
            <p class="text-muted small">Choix de la coupe, dentelle, couleur Pantone. Délai 15j.</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="fs-4 fw-bold text-success">189,00 €</span>
              {{-- <a href="{{ route('produits.personnalisation', 2) }}" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fas fa-pen-ruler me-1"></i>Configurer</a> --}}
            </div>
          </div>
        </div>
      </div>

      <!-- Produit 3 - Costume standard -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 border-0 shadow-sm rounded-4">
          <img src="https://placehold.co/600x400/f0f7e8/8cc63f?text=Blazer+Premium" class="card-img-top rounded-top-4" alt="Blazer" style="height: 220px; object-fit: cover;">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="fw-bold">Blazer élégant</h5>
              <span class="badge bg-light-info text-dark-info">Prêt-à-porter</span>
            </div>
            <p class="text-muted small">Taille standard S à XXL, livraison rapide 3-5j.</p>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <span class="fs-4 fw-bold text-success">129,00 €</span>
              <a href="#" class="btn btn-sm btn-success rounded-pill"><i class="fas fa-shopping-bag me-1"></i>Acheter</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Section des dernières commandes -->
    <div class="row" id="mes-commandes">
      <div class="col-xl-12 col-lg-12">
        <div class="card h-100 card-lg border-0">
          <div class="p-5 pb-2">
            <h3 class="mb-0 fs-5 fw-semibold"><i class="bi bi-truck me-2 text-primary"></i>Mes dernières commandes</h3>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead class="bg-light" style="background-color: #f9fcf5;">
                  <tr class="text-muted">
                    <th scope="col" class="ps-4">N° commande</th>
                    <th scope="col">Produit / Personnalisation</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total</th>
                    <th scope="col" class="pe-4">Statut</th>
                    <th scope="col" class="pe-4">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($commandesRecentes as $commande)
                  <tr>
                    <td class="ps-4 fw-semibold">{{ $commande->numero_commande }}</td>
                    <td>
                      {{ $commande->produits->first()->nom ?? 'Produit' }}
                      @if($commande->personnalisation_data)
                        <small class="text-muted d-block">(personnalisé)</small>
                      @endif
                    </td>
                    <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($commande->total, 2, ',', ' ') }} €</td>
                    <td class="pe-4">
                      @php
                        $badgeClass = match($commande->statut) {
                          'en cours' => 'bg-light-warning text-dark-warning',
                          'livrée' => 'bg-light-success text-dark-success',
                          'annulée' => 'bg-light-danger text-dark-danger',
                          default => 'bg-light-secondary text-dark-secondary'
                        };
                      @endphp
                      <span class="badge {{ $badgeClass }}">{{ ucfirst($commande->statut) }}</span>
                    </td>
                    <td class="pe-4">
                      <a href="{{ route('commandes.show', $commande) }}" class="link-info">Détails</a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                      <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                      Aucune commande pour le moment.<br>
                      <a href="{{ route('shop.grid') }}" class="btn btn-sm btn-primary mt-2">Découvrir nos produits</a>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          @if($commandesRecentes->count() > 0)
          <div class="card-footer bg-transparent border-0 pt-2 pb-4 px-5 text-end">
            {{-- <a href="{{ route('commandes.index') }}" class="btn btn-sm rounded-pill" style="border-color: #8cc63f; color: #4a7729;">Historique complet <i class="fas fa-arrow-right ms-1"></i></a> --}}
          </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Notifications récentes (seulement si pas vides) -->
    @if($notifications && $notifications->count())
    <div class="row mt-5">
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
          <div class="card-header bg-white border-0 pt-4">
            <h5 class="mb-0 fw-semibold"><i class="bi bi-bell me-2 text-primary"></i>Notifications récentes</h5>
          </div>
          <div class="card-body">
            @foreach($notifications as $notif)
              <div class="alert alert-light border rounded-3 mb-2">
                {{ $notif->message ?? 'Notification' }}
                <small class="text-muted d-block">{{ $notif->created_at->diffForHumans() }}</small>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endif

    <!-- Offres (toujours visible, mais avec condition sur le contenu) -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="alert alert-success bg-light-primary border-0 rounded-4 d-flex align-items-center justify-content-between flex-wrap" role="alert">
          <div>
            <i class="fas fa-gift fa-2x me-3 text-primary"></i>
            <span class="fw-semibold">Profitez de nos offres sur les costumes personnalisés !</span>
          </div>
          {{-- <a href="{{ route('shop.grid') }}" class="btn btn-sm btn-primary rounded-pill mt-2 mt-sm-0">Explorer les offres</a> --}}
        </div>
      </div>
    </div>

  </section>
</main>

@endsection