<nav class="navbar navbar-expand-lg navbar-glass bg-light bg-opacity-50">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">

            <div class="d-flex align-items-center">
                <!-- Bouton offcanvas menu mobile -->
                <a class="text-inherit d-block d-xl-none me-4" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-text-indent-right" viewBox="0 0 16 16">
                        <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm10.646 2.146a.5.5 0 0 1 .708.708L11.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zM2 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </a>

                <!-- Formulaire recherche -->
                <form role="search" class="me-3">
                    <label for="search" class="form-label visually-hidden">Rechercher</label>
                    <input id="search" class="form-control" type="search" placeholder="Recherche" aria-label="Search" />
                </form>
            </div>

            <div>
                <ul class="list-unstyled d-flex align-items-center mb-0 ms-5 ms-lg-0">

                    <!-- Déconnexion -->
                    <li class="me-3">
                        @auth
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Déconnexion" class="text-muted">
                                <i class="fa fa-power-off"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        @endauth
                    </li>

                    <!-- Notifications -->
                    <li class="dropdown-center me-3">
                        <a class="position-relative btn-icon btn-ghost-secondary btn rounded-circle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">
                                2
                                <span class="visually-hidden">messages non lus</span>
                            </span>
                        </a>
                        <!-- Dropdown notifications simplifié / à personnaliser -->
                        <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 300px;">
                            <li class="mb-2">Vous avez 2 messages non lus</li>
                            <li><a href="#" class="dropdown-item">Message 1</a></li>
                            <li><a href="#" class="dropdown-item">Message 2</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="#" class="dropdown-item text-center">Voir tout</a></li>
                        </ul>
                    </li>

                    <!-- Avatar utilisateur connecté -->
                    <li class="dropdown ms-4">
                        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="d-inline-block">
                            @auth
                                <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/default-avatar.png') }}" 
                                     alt="{{ auth()->user()->name }}" class="avatar avatar-md rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                            @else
                                <i class="fas fa-user-circle fa-2x text-secondary"></i>
                            @endauth
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end p-0">
                            <li class="border-bottom p-3">
                                @auth
                                    <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                    <small>{{ auth()->user()->email }}</small>
                                @endauth
                            </li>
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Accueil</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                            {{-- <li><a class="dropdown-item" href="{{ route('settings') }}">Paramètres</a></li> --}}
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">
                                    Déconnexion
                                </a>
                                <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display:none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- CSS Glass Effect -->
<style>
.navbar-glass {
    background-color: rgba(255, 255, 255, 0.6);
    backdrop-filter: saturate(180%) blur(15px);
    -webkit-backdrop-filter: saturate(180%) blur(15px);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
}
</style>

<!-- Inclure Bootstrap 5 CSS & JS CDN et FontAwesome CDN dans votre layout général si ce n’est pas déjà le cas -->

<!-- Exemple balises à placer dans le <head> -->
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<!-- Exemple balises à placer juste avant la fermeture de </body> -->
<!-- Bootstrap 5 JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
