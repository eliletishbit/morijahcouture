@extends('layouts.backendapp')

@section('content')

@php
    // Fallback pour toutes les variables (évite les erreurs Undefined variable)
    $stats = $stats ?? [
        'total_commandes' => 0,
        'commandes_en_cours' => 0,
        'commandes_livrees' => 0,
        'commandes_annulees' => 0,
        'chiffre_affaires' => 0,
        'total_users' => 0,
        'nouveaux_users_mois' => 0,
        'total_produits' => 0,
        'produits_personnalisables' => 0,
        'produits_en_stock' => 0,
        'paiements_en_attente' => 0,
        'paiements_valides' => 0,
        'notifications_non_lues' => 0,
    ];
    $dernieresCommandes = $dernieresCommandes ?? collect();
    $derniersUtilisateurs = $derniersUtilisateurs ?? collect();
    $derniersProduits = $derniersProduits ?? collect();
    $derniersPaiements = $derniersPaiements ?? collect();
    $caParMois = $caParMois ?? [];
    $statutsCommandes = $statutsCommandes ?? [];
@endphp

<main class="main-content-wrapper container" style="width:90%;">
  <section class="container px-0">

    <!-- Bannière de bienvenue admin -->
    <div class="row mb-8">
      <div class="col-md-12">
        <div class="card bg-light border-0 rounded-4 overflow-hidden"
             style="background: linear-gradient(105deg, #ffffff 0%, #f9fef2 100%); border-left: 8px solid #8cc63f;">
          <div class="card-body p-lg-5 p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
              <div>
                <h1 class="display-6 fw-bold" style="color: #2c5a1a;">Bonjour, <span class="text-primary" style="color: #8cc63f;">{{ $admin->name ?? 'Admin' }}</span></h1>
                <p class="text-muted mb-3 fs-5">Bienvenue sur votre espace d'administration. Gérez vos commandes, produits et utilisateurs en un clin d'œil.</p>
                @if(Route::has('admin.products.create'))
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow-sm"><i class="fas fa-plus-circle me-2"></i>Créer un produit</a>
                @endif
              </div>
              <div class="mt-3 mt-md-0">
                <i class="fas fa-chart-line fa-3x" style="color: #d1e6b0;"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Cartes statistiques -->
    <div class="table-responsive-xl mb-6 mb-lg-0">
      <div class="row flex-nowrap pb-3 pb-lg-0 g-4">
        <!-- Revenus -->
        <div class="col-lg-4 col-12">
          <div class="card h-100 card-lg border-0">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div><h4 class="mb-0 fs-5 fw-semibold">Chiffre d'affaires</h4></div>
                <div class="icon-shape" style="background: #eaf6e1; color: #6b9c2a;">
                  <i class="bi bi-currency-dollar fs-4"></i>
                </div>
              </div>
              <div class="lh-1">
                <h1 class="mb-2 fw-bold fs-1" style="color: #3a6b1f;">{{ number_format($stats['chiffre_affaires'] ?? 0, 2, ',', ' ') }} €</h1>
                <span class="text-secondary"><i class="fas fa-shopping-cart me-1 text-success"></i> {{ $stats['total_commandes'] ?? 0 }} commandes au total</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Commandes -->
        <div class="col-lg-4 col-12">
          <div class="card h-100 card-lg border-0">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div><h4 class="mb-0 fs-5 fw-semibold">Commandes</h4></div>
                <div class="icon-shape" style="background: #fff0db; color: #e67e22;">
                  <i class="bi bi-cart fs-4"></i>
                </div>
              </div>
              <div class="lh-1">
                <h1 class="mb-2 fw-bold fs-1" style="color: #b1560f;">{{ $stats['total_commandes'] ?? 0 }}</h1>
                <span><span class="fw-semibold me-1 text-dark">{{ $stats['commandes_en_cours'] ?? 0 }}</span> en cours, <span class="fw-semibold me-1 text-dark">{{ $stats['commandes_livrees'] ?? 0 }}</span> livrées</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Clients -->
        <div class="col-lg-4 col-12">
          <div class="card h-100 card-lg border-0">
            <div class="card-body p-5">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div><h4 class="mb-0 fs-5 fw-semibold">Utilisateurs</h4></div>
                <div class="icon-shape" style="background: #e1f5fe; color: #0288d1;">
                  <i class="bi bi-people fs-4"></i>
                </div>
              </div>
              <div class="lh-1">
                <h1 class="mb-2 fw-bold fs-1" style="color: #146b3a;">{{ $stats['total_users'] ?? 0 }}</h1>
                <span><span class="fw-semibold me-1">{{ $stats['nouveaux_users_mois'] ?? 0 }}</span> nouveaux ce mois-ci</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Graphique revenus + Donut des ventes -->
    <div class="row g-5 mb-6 mt-4">
      <div class="col-xl-8 col-lg-6 col-md-12">
        <div class="card h-100 card-lg border-0">
          <div class="card-body p-5">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
              <div>
                <h3 class="mb-1 fs-4 fw-semibold">Aperçu des revenus</h3>
                <small class="text-success"><i class="fas fa-chart-line me-1"></i> Évolution mensuelle</small>
              </div>
            </div>
            <div id="revenueChart" class="mt-4"></div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-6 col-md-12">
        <div class="card h-100 card-lg border-0">
          <div class="card-body p-5">
            <h3 class="mb-3 fs-5 fw-semibold">Statut des commandes</h3>
            <div id="totalSale" class="mt-2 d-flex justify-content-center"></div>
            <div class="mt-4 pt-2">
              <ul class="list-unstyled mb-0">
                <li class="mb-2 d-flex align-items-center"><i class="fas fa-circle me-2" style="color: #f9b23f;"></i> <span class="text-dark">En cours</span> <span class="ms-auto text-muted">{{ $stats['commandes_en_cours'] ?? 0 }}</span></li>
                <li class="mb-2 d-flex align-items-center"><i class="fas fa-circle me-2" style="color: #8cc63f;"></i> <span class="text-dark">Livrées</span> <span class="ms-auto text-muted">{{ $stats['commandes_livrees'] ?? 0 }}</span></li>
                <li class="mb-2 d-flex align-items-center"><i class="fas fa-circle me-2" style="color: #e46d5d;"></i> <span class="text-dark">Annulées</span> <span class="ms-auto text-muted">{{ $stats['commandes_annulees'] ?? 0 }}</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Indicateurs supplémentaires + Notifications -->
    <div class="row g-5 mb-6">
      <div class="col-xl-6 col-lg-6 col-md-12">
        <div class="card h-100 card-lg border-0">
          <div class="card-body p-5">
            <h3 class="mb-4 fs-5 fw-semibold">Aperçu des produits</h3>
            <div class="mt-2">
              <div class="mb-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span>Produits personnalisables</span>
                  <span class="fw-semibold">{{ $stats['produits_personnalisables'] ?? 0 }} / {{ $stats['total_produits'] ?? 0 }}</span>
                </div>
                <div class="progress bg-light-primary rounded-pill" style="height: 8px;">
                  <div class="progress-bar bg-primary rounded-pill" style="width: {{ ($stats['total_produits'] ?? 0) > 0 ? (($stats['produits_personnalisables'] ?? 0) / ($stats['total_produits'] ?? 1)) * 100 : 0 }}%; background-color: #8cc63f !important;"></div>
                </div>
              </div>
              <div>
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span>Produits en stock</span>
                  <span class="fw-semibold">{{ $stats['produits_en_stock'] ?? 0 }} / {{ $stats['total_produits'] ?? 0 }}</span>
                </div>
                <div class="progress bg-light-primary rounded-pill" style="height: 8px;">
                  <div class="progress-bar bg-info rounded-pill" style="width: {{ ($stats['total_produits'] ?? 0) > 0 ? (($stats['produits_en_stock'] ?? 0) / ($stats['total_produits'] ?? 1)) * 100 : 0 }}%; background-color: #50b5e0;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-12">
        <div class="d-flex flex-column gap-4 h-100">
          <div class="card card-lg border-0 flex-grow-1">
            <div class="card-body px-5 py-4 d-flex align-items-center">
              <div class="flex-shrink-0">
                <i class="fas fa-bell fa-2x" style="color: #f9b23f;"></i>
              </div>
              <div class="ms-4">
                <h5 class="mb-1 fw-semibold">Notifications non lues</h5>
                <p class="mb-0">Vous avez <strong>{{ $stats['notifications_non_lues'] ?? 0 }}</strong> notification(s) en attente</p>
              </div>
            </div>
          </div>
          <div class="card card-lg border-0 flex-grow-1">
            <div class="card-body px-5 py-4 d-flex align-items-center">
              <div class="flex-shrink-0">
                <i class="fas fa-credit-card fa-2x text-success" style="color: #8cc63f;"></i>
              </div>
              <div class="ms-4">
                <h5 class="mb-1 fw-semibold">Paiements</h5>
                <p class="mb-0"><strong>{{ $stats['paiements_en_attente'] ?? 0 }}</strong> en attente, <strong>{{ $stats['paiements_valides'] ?? 0 }}</strong> validés</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tableau des commandes récentes -->
    <div class="row">
      <div class="col-xl-12 col-lg-12">
        <div class="card h-100 card-lg border-0">
          <div class="p-5 pb-2 d-flex justify-content-between align-items-center">
            <h3 class="mb-0 fs-5 fw-semibold"><i class="bi bi-clock-history me-2 text-primary"></i>Commandes récentes</h3>
            @if(Route::has('admin.commandes.index'))
                <a href="{{ route('admin.commandes.index') }}" class="btn btn-sm btn-outline-primary rounded-pill" style="border-color: #8cc63f; color: #4a7729;">Voir toutes</a>
            @endif
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead class="bg-light" style="background-color: #f9fcf5;">
                  <tr class="text-muted">
                    <th scope="col" class="ps-4">N° commande</th>
                    <th scope="col">Client</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total</th>
                    <th scope="col" class="pe-4">Statut</th>
                    <th scope="col" class="pe-4">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($dernieresCommandes as $commande)
                  <tr>
                    <td class="ps-4 fw-semibold">{{ $commande->numero_commande }}</td>
                    <td>{{ $commande->user->name ?? 'N/A' }}</td>
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
                      <a href="{{ route('admin.commandes.show', $commande->id) }}" class="link-info">Détails</a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                      <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                      Aucune commande récente
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</main>

<script>
  // Graphique Revenus (dynamique avec les données du contrôleur)
  let revenueData = {!! json_encode(array_values($caParMois)) !!};
  let monthsData = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juillet', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
  
  // Compléter les données manquantes (12 mois)
  let fullRevenueData = [];
  for(let i = 1; i <= 12; i++) {
    fullRevenueData.push(revenueData[i] || 0);
  }

  let revenueOptions = {
    series: [{ name: "Revenus", data: fullRevenueData }],
    chart: { height: 320, type: 'area', toolbar: { show: false }, fontFamily: 'Inter, sans-serif', background: 'transparent' },
    colors: ['#8cc63f'],
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.3,
        opacityFrom: 0.4,
        opacityTo: 0.05,
        stops: [0, 100],
        colorStops: [{ offset: 0, color: "#8cc63f", opacity: 0.5 }, { offset: 100, color: "#f9b23f", opacity: 0.05 }]
      }
    },
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 3, colors: ['#6b9c2a'] },
    grid: { borderColor: '#eef2e6', strokeDashArray: 4 },
    xaxis: { categories: monthsData, labels: { style: { colors: '#6f7c6b', fontWeight: 500 } } },
    yaxis: { title: { text: 'Revenus (€)', style: { color: '#5a6b4b' } }, labels: { formatter: (val) => `${val.toLocaleString('fr-FR')} €` } },
    tooltip: { theme: 'light', y: { formatter: (val) => `${val.toLocaleString('fr-FR')} €` } }
  };
  
  let revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
  revenueChart.render();

  // Graphique Donut (statut des commandes)
  let pieOptions = {
    series: [{{ $stats['commandes_en_cours'] ?? 0 }}, {{ $stats['commandes_livrees'] ?? 0 }}, {{ $stats['commandes_annulees'] ?? 0 }}],
    labels: ['En cours', 'Livrées', 'Annulées'],
    chart: { type: 'donut', height: 280, toolbar: { show: false }, background: 'transparent' },
    colors: ['#f9b23f', '#8cc63f', '#e46d5d'],
    legend: { position: 'bottom', fontSize: '12px', labels: { colors: '#2b3b26' } },
    dataLabels: { enabled: false },
    plotOptions: { pie: { donut: { size: '60%', labels: { show: true, total: { show: true, label: 'Commandes', fontSize: '14px', color: '#354e27', formatter: () => '{{ $stats['total_commandes'] ?? 0 }}' } } } } },
    stroke: { width: 0 },
    tooltip: { y: { formatter: (val) => `${val} commandes` } }
  };
  
  let totalSaleChart = new ApexCharts(document.querySelector("#totalSale"), pieOptions);
  totalSaleChart.render();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection