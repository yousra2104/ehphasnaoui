<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Cardio-Vasculaire - EHPHASNAOUI</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/BreadcumbsVisite.css">
    <link rel="stylesheet" href="../assets/css/services.css">
    <link rel="stylesheet" href="../assets/css/globals.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .row {
            /* Add any specific row styles if needed */
        }

        .presentation {
            text-align: center;
        }

        .description {
            font-size: 1.09rem;
            line-height: 1.5;
            color: black;
            text-align: justify;
        }

        .toggle-btn {
            background: none;
            border: none;
            cursor: pointer;
            position: absolute;
            bottom: 15px;
            right: 15px;
        }

        .service-img {
            max-height: 40px;
            object-fit: contain;
        }

        /* FAQ Accordion Styles */
        h2 {
            text-align: center;
            color: #333;
        }

        #faq-container {
            text-align: left !important; /* Force left alignment */
            padding-left: 15px; /* Slight indent for better spacing */
        }

        .accordion {
            background-color: #e5eafb;
            color: black;
            margin-bottom: 10px;
            border-radius: 4px;
            overflow: hidden;
            text-align: left !important; /* Force left alignment */
        }

        .accordion-header {
            padding: 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left !important; /* Left-align header text */
        }

        .accordion-header span {
            font-family: inherit; /* Match document default or external CSS */
            font-size: 1rem; /* Standard size, adjust if external CSS specifies otherwise */
            font-weight: normal; /* Match typical question styling */
            color: black;
        }

        .accordion-content {
            padding: 0 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            text-align: left !important; /* Left-align content */
        }

        .accordion-content p {
            text-align: left !important; /* Explicitly left-align paragraph text */
            margin: 0;
            color: black !important; /* Ensure answer text is black */
            font-family: inherit; /* Match question font */
            font-size: 1rem; /* Match question font size */
            font-weight: normal; /* Match question font weight */
        }

        .accordion-content.active {
            padding: 15px;
            max-height: 500px; /* Adjust as needed */
            color: black;
            background-color: #e5eafb;
            text-align: left !important; /* Ensure active content is left-aligned */
        }

        .icon {
            font-size: 21px;
            width: 30px;
            height: 30px;
            color: blue;
            border-color: blue;
        }
    </style>
</head>
<body>
    <header>
        @include('user.topbar')
        @include('user.navbar')
    </header>

    <div>
        <div class="breadcrumbs overlay mb-4">
            <div class="container">
                <div class="bread-inner">
                    <div class="row">
                        <div class="col-12 position-relative">
                            <h2>Service Cardio-Vasculaire</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Presentation Part -->
    <div class="presentation">
        <h2>Présentation du Service Cardio-Vasculaire</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <p>Le service de chirurgie cardio-vasculaire de l'Établissement Hospitalier Privé Hasnaoui est dédié à fournir des soins de pointe, combinant expertise médicale et technologies avancées pour le traitement des maladies cardiovasculaires. Notre objectif est de fournir des soins de qualité supérieure dans un environnement sûr et accueillant, où chaque patient bénéficie d'un suivi personnalisé et attentif.</p>
    </div>

    <!-- Specialties Part -->
    <section class="service-section prelative white p-8">
        <div class="section-padding service-overlay">
            <div class="row justify-content-center text-center presentation">
                <h2 style="color: white; font-weight: bold;">Nos spécialités</h2>
                <br/>
                <div class="container">
                    <div class="row justify-content-center" id="services-container">
                        <!-- Services will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Part -->
    <div class="presentation">
        <h2>FAQ</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <div id="faq-container"></div>
    </div>

    @include('user.footer')

    <!-- JavaScript -->
    <script>
        // Services Data and Rendering
        const servicesData = [
            {
                title: "Cardiologie Interventionnelle",
                description: `• Cathétérisme Cardiaque et Angioplastie Coronaire :\n  - Acquisition par Syngo Angio Package : Le système Syngo Angio permet une visualisation détaillée et précise des artères coronaires, ce qui est crucial pour diagnostiquer et traiter les obstructions. Cette technologie avancée améliore la précision des interventions et réduit le risque de complications.\n  - Mesure FFR par Sensis Vibe : La mesure de la réserve de flux fractionnaire (FFR) aide à déterminer la sévérité des sténoses coronariennes. Cette technique permet aux cardiologues de décider de manière plus précise quand une angioplastie ou un stent est nécessaire, optimisant ainsi les résultats pour les patients.`,
                logo: "../assets/img/cardiologies.png"
            },
            {
                title: "Procédures Hybrides",
                description: `• Procédure TAVI (Remplacement Valvulaire Aortique par Transcathéter) : Cette procédure mini-invasive permet de remplacer une valve aortique défectueuse sans avoir recours à une chirurgie à cœur ouvert. C'est particulièrement bénéfique pour les patients à haut risque chirurgical.\n• Fermeture de l’Auricule Gauche : Pour les patients souffrant de fibrillation auriculaire, cette intervention réduit le risque d'accidents vasculaires cérébraux en fermant l'auricule gauche du cœur, où des caillots sanguins peuvent se former.\n• Procédure MitraClip : Utilisée pour traiter les fuites mitrales sévères, cette technique permet de réparer la valve mitrale par une approche percutanée, réduisant ainsi le besoin de chirurgie ouverte et favorisant une récupération plus rapide.`,
                logo: "../assets/img/cardiologies.png"
            },
            {
                title: "Procédures Endovasculaires",
                description: `• EVAR (Réparation Endovasculaire de l'Aneurysme) :\n  - Fusion d’Image Scannographique : La technologie de fusion d'image permet de superposer des images scannographiques en temps réel, offrant une vue précise et détaillée des structures vasculaires. Cela facilite le placement des endoprothèses avec une grande précision.\n  - Contrôle Après Déploiement : Après la mise en place de l'endoprothèse, un contrôle rigoureux est effectué pour s'assurer que l'anévrisme est correctement exclu de la circulation sanguine, minimisant les risques de complications post-opératoires.`,
                logo: "../assets/img/cardiologies.png"
            }
        ];

        let expandedIndex = null;

        function truncateText(text, limit) {
            return text.length > limit ? text.substring(0, limit) + "..." : text;
        }

        function toggleDescription(index) {
            expandedIndex = expandedIndex === index ? null : index;
            renderServices();
        }

        function renderServices() {
            const container = document.getElementById('services-container');
            container.innerHTML = '';

            servicesData.forEach((service, index) => {
                const serviceDiv = document.createElement('div');
                serviceDiv.className = 'col-lg-2 col-md-6 col-12 d-flex flex-column align-items-center text-center mx-2 p-4 chif my-4';

                serviceDiv.innerHTML = `
                    <div class="chift">
                        <img src="${service.logo}" class="service-img" alt="Service image">
                    </div>
                    <span class="fw-bold mt-4" style="font-size:1.25rem;margin-bottom:10px;color:#23B6EA">${service.title}</span>
                    <p class="description">${
                        expandedIndex === index 
                            ? service.description.replace(/\n/g, "<br />")
                            : truncateText(service.description, 80).replace(/\n/g, "<br />")
                    }</p>
                    <button class="toggle-btn" onclick="toggleDescription(${index})">
                        <i class="far ${expandedIndex === index ? 'fa-square-minus' : 'fa-square-plus'}" 
                        style="color: black; font-size: 30px;"></i>
                    </button>
                `;

                container.appendChild(serviceDiv);
            });
        }

        // Initial render for services
        document.addEventListener('DOMContentLoaded', renderServices);

        // FAQ Data and Rendering
        const faqs = [
            {
                question: "Quels sont les avantages de la cardiologie interventionnelle ?",
                answer: `Les procédures interventionnelles sont moins invasives, ce qui réduit les risques de complications et permet des temps de récupération plus courts. Elles sont souvent réalisées sous anesthésie locale avec sédation, offrant un confort optimal aux patients.`
            },
            {
                question: "Comment se préparer pour une intervention cardio-vasculaire ?",
                answer: `La préparation inclut un bilan pré-opératoire complet, comprenant des examens cliniques et des consultations spécialisées pour évaluer l'état de santé général du patient. Il est important de suivre les instructions spécifiques fournies par l'équipe médicale, telles que les ajustements de médicaments et les restrictions alimentaires.`
            },
            {
                question: "Quelles sont les options de suivi post-opératoire ?",
                answer: `Après l'intervention, un suivi régulier est essentiel pour garantir une récupération optimale. Cela inclut des consultations de contrôle, des examens d'imagerie, et des programmes de rééducation cardiovasculaire. Notre équipe de soins infirmiers spécialisés est disponible pour fournir un soutien continu et répondre à toutes les questions ou préoccupations des patients.`
            }
        ];

        // FAQ Accordion Rendering
        document.addEventListener('DOMContentLoaded', () => {
            const faqContainer = document.getElementById('faq-container');
            faqContainer.innerHTML = '';

            faqs.forEach((faq, index) => {
                const accordionDiv = document.createElement('div');
                accordionDiv.className = 'accordion';

                accordionDiv.innerHTML = `
                    <div class="accordion-header">
                        <span>${faq.question}</span>
                        <i class="fas fa-plus icon"></i>
                    </div>
                    <div class="accordion-content">
                        <p>${faq.answer}</p>
                    </div>
                `;

                faqContainer.appendChild(accordionDiv);
            });

            // Add click event listeners for accordion toggling
            const headers = document.querySelectorAll('.accordion-header');
            headers.forEach(header => {
                header.addEventListener('click', () => {
                    const content = header.nextElementSibling;
                    const icon = header.querySelector('.icon');
                    const isActive = content.classList.contains('active');

                    // Close all other accordions
                    document.querySelectorAll('.accordion-content').forEach(c => {
                        c.classList.remove('active');
                        c.style.maxHeight = null;
                    });
                    document.querySelectorAll('.icon').forEach(i => {
                        i.classList.remove('fa-minus');
                        i.classList.add('fa-plus');
                    });

                    // Toggle the clicked accordion
                    if (!isActive) {
                        content.classList.add('active');
                        content.style.maxHeight = content.scrollHeight + 'px';
                        icon.classList.remove('fa-plus');
                        icon.classList.add('fa-minus');
                    }
                });
            });
        });
    </script>

    <!-- External Scripts -->
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="../assets/vendor/wow/wow.min.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>