<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Contact - EHPHASNAOUI</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/BreadcumbsVisite.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/contactform.css">
    <link rel="stylesheet" href="../assets/css/BreadcrumbsVisite.css">
    <link rel="stylesheet" href="../assets/css/globals.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icofont/1.0.1/icofont.min.css">
   
</head>
<body>
    <header>
        @include('user.topbar')
        @include('user.navbar')
    </header>
    <div>
		<div class="breadcrumbs mb-4 overlay">
			<div class="container">
				<div class="bread-inner ">
					<div class="row">
						<div class="col-12 position-relative">
							<div class=""></div>
							<h2 class="text-white position-relative z-index-1">Contactez-nous</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
   <!-- @include('user.Breadcrumbscontact')-->
    @include('user.contactform')
    @include('user.footer')

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="../assets/vendor/wow/wow.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>