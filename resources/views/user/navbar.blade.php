
<style>
  /* Navbar styling */
  .navbar {
    text-align: center;
    width: 100%;
    padding: 10px 0;
    height: 89.6px; /* Adjusted height for visibility */
    background-color: #fff; /* Opaque background */
    position: relative; /* Positioning context */
    z-index: 1000; /* Ensure navbar is above other elements */
  }

  /* Logo size adjustments */
  .navbar-logo {
    width: 200px; /* Default size */
    height: auto;
  }

  /* Responsive logo size */
  @media (max-width: 768px) {
    .navbar-logo {
      width: 150px; /* Smaller logo on mobile */
    }
  }

  /* Hamburger menu styling */
  .navbar-toggler {
    border: none;
    padding: 10px;
    cursor: pointer;
    z-index: 1002; /* Ensure toggler is above other elements */
    margin-right: 20px; /* Align to the right */
  }

  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 0, 0, 0.5)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    width: 30px;
    height: 30px;
  }

  /* Navbar collapse styling */
  .navbar-collapse {
    z-index: 1001; /* Ensure mobile menu is above other elements */
    background-color: #fff; /* Opaque background for mobile menu */
    transition: all 0.3s ease-in-out; /* Smooth transition for collapse */
  }

  /* Dropdown menu styling */
  .dropdown-menu {
    border-top: 2px solid #23b6ea;
    border-radius: 0;
    width: max-content;
    position: absolute;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1001; /* Ensure dropdowns are above other content */
  }

  /* Specific styling for Contacts et réclamations dropdown */
  .contacts-dropdown .dropdown-menu {
    left: 0; /* Align with the left edge of the toggle button */
    right: auto; /* Ensure it doesn't stretch to the right */
    width: max-content; /* Adjust width to content */
    min-width: 200px; /* Minimum width for consistency */
  }

  /* Responsive adjustments for mobile */
  @media (max-width: 992px) {
    .navbar-nav {
      text-align: center;
      background-color: #fff; /* Opaque background for mobile menu */
      padding: 15px;
      width: 100%;
      z-index: 1001; /* Ensure mobile menu is above other elements */
    }
    .nav-item {
      margin: 10px 0;
    }
    .nav-link {
      font-size: 1.1rem;
      padding: 10px;
      color: #333 !important; /* Ensure text is visible */
    }
    /* Adjust dropdown for mobile */
    .dropdown-menu {
      position: static;
      width: 100%;
      left: 0 !important;
      right: 0 !important;
      box-shadow: none;
      border: none;
      background-color: #f8f9fa; /* Slightly different background for hierarchy */
      z-index: 1001; /* Ensure dropdowns are above other content */
    }
    .contacts-dropdown .dropdown-menu {
      position: static;
      width: 100%;
      min-width: auto; /* Reset min-width for mobile */
    }
    .dropdown-menu .row {
      flex-direction: column;
    }
    .dropdown-menu .col-md-4 {
      width: 100%;
      margin-bottom: 10px;
    }
  }

  /* Ensure dropdown items are clickable */
.list-group-item {
  width: 100%;
  padding: 10px 15px;
  font-size: 1rem;
  text-decoration: none;
  color: #333;
  display: flex;
  align-items: center;
}



/* Ne pas désactiver pointer-events sur icône et span */

  /* Hover effect for links */
  .nav-link:hover
   {
    background-color: #e9ecef;
    transition: background-color 0.2s;
    cursor: pointer; /* Ensure cursor indicates clickability */
  }


  /* Ensure images or background elements don’t overlap */
  img,
  .hero-image,
  .background-image {
    z-index: 1; /* Low z-index for background images */
  }

  /* Content sections */
  .container,
  .content-section {
    position: relative;
    z-index: 10; /* Below navbar but above background */
  }

  .fa-exclamation-circle, .fa-envelope {
    width: 30px;
    height: 30px;
    margin-right: 8px; /* Match me-2 spacing */
    vertical-align: middle;
    font-size: 24px; /* Ensure icon is visible */
    color: #66DED4;
  }

  /* Ensure link and icon behave as a single unit */

  
</style>

<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container" style="width: 100%;">
    <!-- Logo -->
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="../assets/img/logo.png" class="navbar-logo" alt="Logo" />
    </a>

    <!-- Toggler for mobile -->
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupport"
      aria-controls="navbarSupport"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarSupport">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('apropos') }}">A propos</a>
        </li>
        <!-- Services Dropdown -->
        <li class="nav-item dropdown position-static">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Services
          </a>
          <div class="dropdown-menu">
            <div class="container">
              <div class="row my-4">
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="list-group list-group-flush">
                    <a href="{{ route('urologie') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center text-nowrap">
                        <img src="../assets/img/neurone.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Urologie</span>
                      </div>
                    </a>
                    <a href="{{ route('pediaterie') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center text-nowrap">
                        <img src="../assets/img/pediatrie.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Pédiatrie-Néonatalogie</span>
                      </div>
                    </a>
                    <a href="{{ route('traumatologie') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center text-nowrap">
                        <img src="../assets/img/os.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Traumatologie-Orthopédie</span>
                      </div>
                    </a>
                    <a href="{{ route('gastro') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center text-nowrap">
                        <img src="../assets/img/gastro-enterologie.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Hepato-Gastro-Entérologie</span>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <div class="list-group list-group-flush">
                    <a href="{{ route('cardiologie') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center">
                        <img src="../assets/img/cardiologiee.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Cardiologie Clinique</span>
                      </div>
                    </a>
                    <a href="{{ route('gynecologie') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center">
                        <img src="../assets/img/gynecologie.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Gynécologie Obstétrique</span>
                      </div>
                    </a>
                    <a href="{{ route('reanimation') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center">
                        <img src="../assets/img/reanimateur.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Réanimation-Anesthésie</span>
                      </div>
                    </a>
                    <a href="{{ route('imagerie') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center">
                        <img src="../assets/img/tomodensitometrieee.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Imagerie</span>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="list-group list-group-flush">
                    <a href="{{ route('cardiovasculaire') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center">
                        <img src="../assets/img/cardiologiez.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Chirurgie Cardio-Vasculaire</span>
                      </div>
                    </a>
                    <a href="{{ route('labo') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center">
                        <img src="../assets/img/rapport-scientifique.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Laboratoire d'analyses</span>
                      </div>
                    </a>
                    <a href="{{ route('consultation') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center">
                        <img src="../assets/img/dermatologie.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Consultation Générale</span>
                      </div>
                    </a>
                    <a href="{{ route('chirugie') }}" class="list-group-item list-group-item-action border-0">
                      <div class="d-flex align-items-center">
                        <img src="../assets/img/equipe-medicale.png" alt="" class="me-2" style="width: 30px; height: 30px" />
                        <span>Chirurgie Générale & Viscérale</span>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('visite') }}">Visite virtuelle</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('galerie') }}">Galerie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('actualite') }}">Actualités</a>
        </li>
        <!-- Contacts et réclamations Dropdown -->
        <li class="nav-item dropdown contacts-dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Contacts et réclamations
          </a>
          <div class="dropdown-menu">
            <div class="container">
              <div class="row my-4">
            
                 <div class="list-group list-group-flush">
  <a href="{{ route('contact') }}" class="list-group-item list-group-item-action d-flex align-items-center border-0" style="margin-left:7px;">
    <i class="fas fa-envelope me-2"></i>
    <span>Contact</span>
  </a>

                    <a href="{{ route('reclamations') }}" class="list-group-item list-group-item-action border-0 d-flex align-items-center text-nowrap"style="margin-left:7px;">
                      <i class="fas fa-exclamation-circle me-2"></i>
                      <span>Réclamations</span>
                    </a>
                  </div>
             
              </div>
            </div>
          </div>
        </li>
        <!-- Authenticated User Dropdown -->
        @if (Auth::check())
          <x-app-layout></x-app-layout>
        @endif
      </ul>
    </div> <!-- .navbar-collapse -->
  </div> <!-- .container -->
</nav>
