<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">
  <title>A Propos - EHPHASNAOUI</title>
  <link rel="icon" href="../assets/img/logozoom.PNG" />
  <link rel="stylesheet" href="../assets/css/maicons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <link rel="stylesheet" href="../assets/css/breadcrumbsapropos.css">
  <link rel="stylesheet" href="../assets/css/aproposinfo.css">
  <link rel="stylesheet" href="../assets/css/apropos_card.css">
  <link rel="stylesheet" href="../assets/css/hybrid.css">
  <link rel="stylesheet" href="../assets/css/whyehph.css">
  <link rel="stylesheet" href="../assets/css/medecin.css">
  <link rel="stylesheet" href="../assets/css/globals.css">
  <link rel="stylesheet" href="../assets/css/back-to-top.css"> <!-- Added -->
  <link href="https://cdn.jsdelivr.net/npm/icofont@1.0.0/dist/icofont.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Added -->
</head>
<body>
  <!-- Back to top button -->
  <div class="back-to-top">
    <i class="fas fa-angle-up"></i>
  </div>

  <header>
    @include('user.topbar')
    @include('user.navbar')
  </header>

  <div>
    <div class="breadcrumbs_apropos overlay mb-4">
      <div class="container">
        <div class="bread-inner">
          <div class="row">
            <div class="col-12 position-relative">
              <h2>A propos</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('user.aproposinfo')
  <div class="container my-4">
    <div class="row gg">
      <div class="col-lg-4 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
        <div class="serviceBox">
          <div class="service-icon">
            <span><i class="icofont-briefcase-1" style="color:'white',fontSize:'40px'"></i></span>
          </div>
          <h3 class="title text-uppercase">Éthique :</h3>
          <p class="description">
            <i class="icofont-check text-primary"></i> Notre hôpital s'engage à respecter les normes élevées d'éthique et d'intégrité. Nous traitons chaque individu avec compassion et garantissons des soins de qualité pour tous.
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 wow fadeIn" data-wow-delay="0.4s">
        <div class="serviceBox orange">
          <div class="service-icon">
            <span><i class="icofont-eye-alt" style="color:white;fontSize:'40px'"></i></span>
          </div>
          <h3 class="title text-uppercase">Respect :</h3>
          <p class="description mb-3">
            <i class="icofont-check text-primary"></i> Nous mettons un point d'honneur à promouvoir une culture du respect au sein de notre établissement, qui guide nos interactions au quotidien.
          </p><br/>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 wow fadeIn" data-wow-delay="0.6s">
        <div class="serviceBox">
          <div class="service-icon">
            <span><i class="icofont-badge" style="color:'white',fontSize:'40px'"></i></span>
          </div>
          <h3 class="title">Empathie :</h3>
          <p class="description">
            <i class="icofont-check text-primary"></i> Nous valorisons l'empathie dans nos relations avec les patients, les familles et les membres du personnel en offrant un soutien chaleureux et attentif à tous les niveaux de soins.
          </p>
        </div>
      </div>
    </div>
  </div>

  @include('user.chiffrecles')
  @include('user.hybrid')
  @include('user.whyehph')
  @include('user.medecin')
  @include('user.footer')

  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
  <script src="../assets/vendor/wow/wow.min.js"></script>
  <script src="../assets/js/theme.js"></script>
  <script src="../assets/js/back-to-top.js"></script> <!-- Added -->
</body>
</html>