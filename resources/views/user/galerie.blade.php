
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Galerie - EHPHASNAOUI</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet"  href="../assets/css/theme.css">
  <link rel="stylesheet" href="../assets/css/globals.css">

  <header>
        @include('user.topbar')
        <!-- Keep your existing navbar code -->
       @include('user.navbar')
    </header>
    <body>
      
   
    <div class="row" style="text-align: center;">
					<div class="col-lg-12 mt-4">
						<div class="section-title">
							<h2>Galerie :</h2>
							<center><img src="../assets/img/section-img.png" className="mb-3" alt="#"/></center>
 						</div>
					</div>
				</div>
   @include('user.galeriee')
    
    @include('user.footer')

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="../assets/vendor/wow/wow.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>