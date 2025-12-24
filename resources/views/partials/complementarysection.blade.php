<section class="  "   >
        <div class="px-4 py-4" style="background-color:#F5F5F5; margin-bottom:30px;">
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
                    <img src="{{ asset('assets/images/home/ecologi1.jpg') }}" alt="Tenue Image" class="img-fluid rounded shadow">
                    </div>
                </div>
        </div>

        
        <div class="coupeparfaite">

        </div>
        <div class="Mentionnéici">

        </div>
    </section>

    