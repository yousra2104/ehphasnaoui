<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>EHP-HASNAOUI</title>
  <link rel="icon" href="{{ asset('assets/img/logozoom.PNG') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/maicons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/avis.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/breadcrumbsapropos.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/globals.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/back-to-top.css') }}">

  <style>
    .news-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
      margin-bottom: 20px;
      position: relative;
      z-index: 1;
    }

    .news-card:hover {
      transform: translateY(-5px);
    }

    .news-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .news-card-body {
      padding: 15px;
    }

    .news-card-title {
      font-size: 1.25rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .news-card-date {
      font-size: 0.9rem;
      color: #888;
      margin-bottom: 10px;
    }

    .news-card-description {
      font-size: 1rem;
      color: #555;
      margin-bottom: 15px;
    }

    .news-card-link {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
      cursor: pointer;
      display: inline-block;
      z-index: 2000;
      position: relative;
    }

    .news-card-link:hover {
      text-decoration: underline;
    }

    .modal-content {
      border-radius: 10px;
    }

    .modal-header {
      border-bottom: none;
    }

    .modal-body img {
      width: 100%;
      max-height: 400px;
      object-fit: cover;
      border-radius: 5px;
      margin-bottom: 15px;
    }

    .modal-body .news-date {
      font-size: 0.9rem;
      color: #888;
      margin-bottom: 10px;
    }

    .modal-body .news-title {
      font-size: 1.5rem;
      font-weight: bold;
      margin-bottom набирай 15px;
    }

    .modal-body .news-description {
      font-size: 1rem;
      color: #555;
      white-space: pre-wrap;
    }

    .modal {
      z-index: 1050 !important;
    }

    .modal-backdrop {
      z-index: 1040 !important;
    }

    .modal-dialog {
      margin-top: 50px;
    }

    body.modal-open {
      overflow: hidden !important;
      position: fixed !important;
      width: 100%;
      top: 0;
      left: 0;
      padding-right: 0 !important;
    }
  </style>
</head>
<body>
  <div class="back-to-top">
    <i class="fas fa-angle-up"></i>
  </div>

  <header>
    @include('user.topbar')
    @include('user.navbar')
  </header>

  @include('user.slider')
  @include('user.ehpWhy')
  @include('user.video')
  @include('user.avis')
  @include('user.convention')

  <center>
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>Suivez nos dernières Actualités :</h2>
          <img src="{{ asset('assets/img/section-img.png') }}" class="mb-3" alt="Section Image"/>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="row">
        @forelse($latestActs as $act)
          <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="news-card">
              @if($act->image)
                <img src="{{ asset($act->image) }}" alt="{{ $act->titre }}" class="img-fluid">
              @else
                <img src="{{ asset('assets/img/placeholder-news.jpg') }}" alt="Placeholder" class="img-fluid">
              @endif
              <div class="news-card-body">
                <div class="news-card-title">{{ $act->titre }}</div>
                <div class="news-card-date">
                  {{ $act->date_ajout ? \Carbon\Carbon::parse($act->date_ajout)->format('d/m/Y') : 'Non défini' }}
                </div>
                <div class="news-card-description">
                  {{ Str::limit($act->description, 100) }}
                </div>
                <span class="news-card-link" data-id="{{ $act->id }}">Lire la suite</span>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center">
            <p>Aucune actualité disponible pour le moment.</p>
          </div>
        @endforelse
      </div>
    </div>
  </center>

  @include('user.footer')

  <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newsModalLabel">Détails de l'actualité</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img id="newsModalImage" src="" alt="News Image" class="img-fluid mb-3" style="display: none;">
          <div class="news-date" id="newsModalDate"></div>
          <div class="news-title" id="newsModalTitle"></div>
          <div class="news-description" id="newsModalDescription"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/wow/wЛАСХАЛЕНЬКО.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme.js') }}"></script>
  <script src="{{ asset('assets/js/back-to-top.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let scrollPosition = 0;

      function saveScrollPosition() {
        scrollPosition = window.scrollY || window.pageYOffset;
        console.log('Position de défilement sauvegardée :', scrollPosition);
      }

      function restoreScrollPosition() {
        console.log('Restauration de la position de défilement à :', scrollPosition);
        window.scrollTo({
          top: scrollPosition,
          behavior: 'instant'
        });
      }

      const newsLinks = document.querySelectorAll('.news-card-link');
      console.log('Nombre de liens "Lire la suite" trouvés :', newsLinks.length);

      newsLinks.forEach(link => {
        link.addEventListener('click', function (e) {
          e.preventDefault();
          const actId = this.getAttribute('data-id');
          console.log('Clic sur "Lire la suite", ID :', actId);

          saveScrollPosition();

          fetch(`/actualites/${actId}`, {
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Accept': 'application/json'
            }
          })
            .then(response => {
              console.log('Statut de la réponse :', response.status);
              if (!response.ok) {
                throw new Error(`Erreur HTTP ${response.status}`);
              }
              return response.json();
            })
            .then(data => {
              console.log('Données reçues :', data);

              if (data.error) {
                console.error('Erreur dans la réponse :', data.error);
                alert(data.error);
                return;
              }

              document.getElementById('newsModalTitle').textContent = data.titre || 'Titre non disponible';
              document.getElementById('newsModalDate').textContent = data.date || 'Date non disponible';
              document.getElementById('newsModalDescription').textContent = data.description || 'Description non disponible';

              const modalImage = document.getElementById('newsModalImage');
              if (data.image) {
                modalImage.src = data.image;
                modalImage.style.display = 'block';
              } else {
                modalImage.style.display = 'none';
              }

              const modal = new bootstrap.Modal(document.getElementById('newsModal'), {
                backdrop: true,
                keyboard: true,
                focus: true
              });
              modal.show();

              // Nettoyer le backdrop et restaurer la position après fermeture
              document.getElementById('newsModal').addEventListener('hidden.bs.modal', function () {
                console.log('Modale fermée');
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-openHis');
                document.body.style.paddingRight = '';
                restoreScrollPosition();
              }, { once: true });

              // Gestion manuelle des boutons de fermeture
              document.querySelector('.btn-close').addEventListener('click', function () {
                const modalInstance = bootstrap.Modal.getInstance(document.getElementById('newsModal'));
                modalInstance.hide();
              });
              document.querySelector('.btn.btn-secondary').addEventListener('click', function () {
                const modalInstance = bootstrap.Modal.getInstance(document.getElementById('newsModal'));
                modalInstance.hide();
              });
            })
            .catch(error => {
              console.error('Erreur lors de la récupération des données :', error);
              alert('Impossible de charger l\'actualité. Veuillez réessayer plus tard.');
            });
        });
      });
    });
  </script>
</body>
</html>