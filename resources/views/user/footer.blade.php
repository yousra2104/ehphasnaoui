<?php
// footer.php
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/css/footer.css">
    <!-- Include Bootstrap CSS for the grid system -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        #downloadBtn {
    display: flex;
    align-items: center; /* Centre verticalement */
    justify-content: center; /* Centre horizontalement */
}
    </style>
</head>
<body>
    <footer id="footer" class="footer mt-4">
        <div class="container p-4">
            <div class="row">
                <!-- Info Section -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-footer">
                        <div class="d-flex flex-row align-items-center">
                            <span class="icon d-flex align-items-center justify-content-center">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <h2>INFO :</h2>
                        </div>
                        <p>L’établissement Hospitalier Privé Hasnaoui vise à développer de vrais pôles d’excellence en s’appuyant sur des valeurs fortes. Il concourt à être parmi les meilleurs établissements de référence pluridisciplinaire.</p>
                        <div class="d-flex flex-row gap-3 align-items-center">
                            
                            <i class="fas fa-map-marker-alt"></i>
                            <a  href="https://www.google.com/maps/place/Etablissement+Hospitalier+Priv%C3%A9+HASNAOUI/@35.1791377,-0.6318223,15z/data=!4m2!3m1!1s0x0:0x23bae99ee4007340?sa=X&ved=1t:2428&ictx=111"-->   <p>Bloc J05 MakamEl Chahid Sidi Bel Abbes</p></a>
                        </div>
                        <div class="d-flex flex-row gap-3 align-items-center mt-2">
                            <i class="fas fa-phone"></i>
                            <p><a href="tel:048771441">048 77 14 41 </a>/ <a href="tel:0560602829">05 60 60 28 29</a></p>
                        </div>
                        <div class="d-flex flex-row gap-3 align-items-center mt-2">
                            <i class="fas fa-envelope"></i>
                           <a href="mailto:info@ehp-hasnaoui.com"><p>info@ehp-hasnaoui.com</p></a>
                        </div>
                    </div>
                </div>

                <!-- Services Section -->
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="single-footer">
                        <div class="d-flex flex-row align-items-center">
                            <span class="icon d-flex align-items-center justify-content-center">
                                <i class="fas fa-medkit"></i>
                            </span>
                            <h2>NOS SERVICES :</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <a href="/urologie"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Urologie</p></div></a>
                                <a href="/pediaterie"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Pédiatrie-Neonatalogie</p></div></a>
                                <a href="/traumatologie"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Traumatologie-Orthopédie</p></div></a>
                                <a href="/gastro"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Hepato-Gastro-Entérologie</p></div></a>
                                <a href="/cardiologie"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Cardiologie Clinique</p></div></a>
                                <a href="/gynecologie"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Gynécologie Obstétrique</p></div></a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <a href="/reanimation"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Réanimation-Anesthésie</p></div></a>
                                <a href="/imagerie"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Imagerie</p></div></a>
                                <a href="/cardiovasculaire"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Chirurgie Cardio-Vasculaire</p></div></a>
                                <a href="/labo"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Laboratoire d’analyses</p></div></a>
                                <a href="/consultation"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Consultation Générale</p></div></a>
                                <a href="/chirugie"><div class="d-flex flex-row gap-2"><i class="fas fa-angle-double-right"></i><p>Chirurgie Générale & Viscérale</p></div></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Follow Us Section -->
                <div class="col-lg-3 col-md-12 col-12">
                    <div class="single-footer">
                        <div class="d-flex flex-row align-items-center">
                            <span class="icon d-flex align-items-center justify-content-center">
                                <i class="fas fa-th"></i>
                            </span>
                            <h2>SUIVEZ-NOUS :</h2>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-3">
                        <a href="https://www.facebook.com/p/Hasnaoui-Private-Hospital-61551679854551/" class="mx-2" target="_blank">
                                <img src="../assets/img/facebook.png" width="40px" height="40px" alt="Facebook">
                            </a>
                            <a href="https://www.instagram.com/hasnaoui_private_hospital/" target="_blank" class="mx-2">
                                <img src="../assets/img/instegram.png" width="40px" height="40px" alt="Instagram">
                            </a>
                            <a href="https://www.linkedin.com/company/hasnaoui-private-hospital/" target="_blank" class="mx-2">
                                <img src="../assets/img/linkedin.png" width="40px" height="40px" alt="LinkedIn">
                            </a>
                            <a href="https://twitter.com/EHPH_HASNAOUI" target="_blank" class="mx-2">
                                <img src="../assets/img/tewitter.png" width="40px" height="40px" alt="Twitter">
                            </a>
                            <a href="https://vm.tiktok.com/ZMMqc5cpA/" target="_blank" class="mx-2">
                                <img src="../assets/img/tiktok.png" width="40px" height="40px" alt="TikTok">
                            </a>
                            <a href="https://www.youtube.com/@EHP-HASNAOUI" target="_blank" class="mx-2">
                                <img src="../assets/img/youtube.png" width="40px" height="40px" alt="YouTube">
                            </a>
                        </div>
                        <div class="mt-4">
                            <!--a href="/rendez-vous"><button class="btn btn-primary">Prendre Rendez-vous</button></a-->
                            <button id="downloadBtn" class="btn btn-outline-light mt-3">
                                <i  class="fas fa-cloud-download-alt"></i> Notre politique QUALITÉ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="copyright-content">
                            <p>Copyright © 2024 Groupe des Sociétés HASNAOUI. All Rights Reserved-Designed by GSH 
                              
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Contact Button -->
    <div class="floating-contact">
        <a href="tel:0560602829" class="contact-btn">
            <i class="fas fa-phone"></i>
        </a>
    </div>

    <script src="../assets/js/footer.js"></script>
</body>
</html>