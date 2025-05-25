<style>/* Par défaut, afficher le carousel desktop et masquer le carousel mobile */
.carousel-desktop {
    display: block;
}

.carousel-mobile {
    display: none;
}

/* Sur les écrans mobiles (par exemple, largeur < 768px), afficher le carousel mobile et masquer le carousel desktop */
@media (max-width: 767.98px) {
    .carousel-desktop {
        display: none;
    }

    .carousel-mobile {
        display: block;
    }
}

/* Ajuster les styles pour les cartes des médecins */
.single-pf .team-item {
    margin-bottom: 20px;
}

.team-item img {
    width: 100%;
    height: auto;
    object-position: top; /* Affiche la partie supérieure */

}</style>
<!-- Notre équipe médicale -->
<div class="container">
    <div class="text-center mx-auto mb-2 mt-2 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h2>Notre équipe médicale :</h2>
        <center><img src="{{ asset('assets/img/section-img.png') }}" alt="Section Image" style="max-width: 100%;"></center>  
    </div>

    @if ($doctors->count() <= 4)
        <!-- Affichage statique si 4 médecins ou moins -->
        <div class="row mx-2">
            @foreach ($doctors as $doctor)
                <div class="col-12 col-md-3 single-pf">
                    <div class="team-item position-relative rounded overflow-hidden wow fadeInUp" data-wow-delay="0.1s">
                        <div class="overflow-hidden">
                            <img class="img-fluid" 
                                 src="{{ $doctor->image ? asset($doctor->image) : asset('assets/img/Photos médecins/drabbad.jpg') }}" 
                                 alt="{{ $doctor->name }}">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>{{ $doctor->name }}</h5>
                            <p class="text-primary">{{ $doctor->speciality }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Carousel pour desktop (4 médecins par slide) -->
        <div id="doctorsCarouselDesktop" class="carousel slide carousel-desktop" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @php
                    $chunkedDoctors = $doctors->chunk(4);
                    $isFirst = true;
                @endphp
                @foreach ($chunkedDoctors as $doctorGroup)
                    <div class="carousel-item {{ $isFirst ? 'active' : '' }}">
                        <div class="row mx-2">
                            @foreach ($doctorGroup as $doctor)
                                <div class="col-md-3 single-pf">
                                    <div class="team-item position-relative rounded overflow-hidden wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="overflow-hidden">
                                            <img class="img-fluid" 
                                                 src="{{ $doctor->image ? asset($doctor->image) : asset('assets/img/Photos médecins/drabbad.jpg') }}" 
                                                 alt="{{ $doctor->name }}">
                                        </div>
                                        <div class="team-text bg-light text-center p-4">
                                            <h5>{{ $doctor->name }}</h5>
                                            <p class="text-primary">{{ $doctor->speciality }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @php $isFirst = false; @endphp
                @endforeach
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#doctorsCarouselDesktop" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#doctorsCarouselDesktop" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Carousel pour mobile (1 médecin par slide) -->
        <div id="doctorsCarouselMobile" class="carousel slide carousel-mobile" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @php
                    $isFirst = true;
                @endphp
                @foreach ($doctors as $doctor)
                    <div class="carousel-item {{ $isFirst ? 'active' : '' }}">
                        <div class="row mx-2">
                            <div class="col-12 single-pf">
                                <div class="team-item position-relative rounded overflow-hidden wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="overflow-hidden">
                                        <img class="img-fluid" 
                                             src="{{ $doctor->image ? asset($doctor->image) : asset('assets/img/Photos médecins/drabbad.jpg') }}" 
                                             alt="{{ $doctor->name }}">
                                    </div>
                                    <div class="team-text bg-light text-center p-4">
                                        <h5>{{ $doctor->name }}</h5>
                                        <p class="text-primary">{{ $doctor->speciality }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $isFirst = false; @endphp
                @endforeach
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#doctorsCarouselMobile" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#doctorsCarouselMobile" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif
</div>
<!-- Second Carousel: Médecins conventionnés -->
<div class="container">
    <div class="container">
        <div class="text-center mx-auto mb-2 mt-2 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px; ">
            <h2>Médecins conventionnés :</h2>
            <center><img src="{{ asset('assets/img/section-img.png') }}" alt="Section Image" style="max-width: 100%;" ></center>
        </div>

        <!-- Carousel Start -->
        <div id="doctorsCarousel2" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            @if($conventionedDoctors->isNotEmpty())
                <div class="carousel-inner">
                    @foreach($conventionedDoctors->chunk(4) as $index => $doctorGroup)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row mx-2">
                                @foreach($doctorGroup as $doctor)
                                    <div class="col-md-3 single-pf">
                                        <div class="team-item position-relative rounded overflow-hidden wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="team-text bg-light text-center p-4">
                                                <h5>{{ $doctor->name }}</h5>
                                                <p class="text-primary">{{ ucfirst($doctor->speciality) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#doctorsCarousel2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#doctorsCarousel2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @else
                <div class="text-center p-4">
                    <p>Aucun médecin conventionné disponible pour le moment.</p>
                </div>
            @endif
        </div>
        <!-- Carousel End -->
    </div> 
</div>