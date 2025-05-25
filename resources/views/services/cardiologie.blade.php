<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Cardiologie Clinique - EHPHASNAOUI</title>
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
                            <h2>Service de Cardiologie Clinique</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Presentation Part -->
    <div class="presentation">
        <h2>Présentation du Service de Cardiologie Clinique</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <p>Le service de cardiologie clinique de notre hôpital est dédié à l'évaluation, au diagnostic et au traitement des maladies cardiovasculaires. Nos cardiologues utilisent des technologies avancées et des examens spécialisés pour détecter, surveiller et traiter les pathologies cardiaques et vasculaires, qu'elles soient aiguës ou chroniques. Nous offrons un large éventail de prestations, allant des bilans cardiaques préventifs aux examens diagnostiques pour des patients présentant des symptômes tels que des douleurs thoraciques, des palpitations ou des problèmes de circulation.</p>
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
                title: "Électrocardiogramme (ECG)",
                description: `Examen rapide et indolore permettant d'enregistrer l'activité électrique du cœur pour détecter des anomalies du rythme cardiaque.`,
                logo: "../assets/img/consultationr.png"
            },
            {
                title: "Échographie Doppler Vasculaire",
                description: `Cet examen non invasif permet d'évaluer la circulation sanguine dans les vaisseaux, notamment pour détecter des obstructions ou des anomalies du flux sanguin.`,
                logo: "../assets/img/consultationr.png"
            },
            {
                title: "Échographie Doppler Cardiaque Adulte",
                description: `Utilisation du Doppler pour visualiser le cœur et évaluer son fonctionnement, en particulier pour diagnostiquer des problèmes des valves cardiaques, de la fonction ventriculaire ou des anomalies du flux sanguin.`,
                logo: "../assets/img/consultationr.png"
            },
            {
                title: "Holter Tensionnel",
                description: `Surveillance ambulatoire de la pression artérielle sur 24 heures pour détecter l'hypertension ou des variations anormales de la pression.`,
                logo: "../assets/img/consultationr.png"
            },
            {
                title: "Holter ECG",
                description: `Enregistrement continu de l'activité électrique du cœur sur 24 à 48 heures pour diagnostiquer des arythmies ou des anomalies du rythme cardiaque qui ne seraient pas détectées lors d'un ECG classique.`,
                logo: "../assets/img/consultationr.png"
            },
            {
                title: "Échographie Doppler Pédiatrique",
                description: `Examen non invasif permettant de suivre l'état des vaisseaux et du cœur chez les enfants, notamment en cas de malformations cardiaques congénitales ou de pathologies vasculaires.`,
                logo: "../assets/img/consultationr.png"
            },
            {
                title: "Épreuve d'Effort",
                description: `Test permettant d'évaluer la réponse du cœur à l'effort physique et de détecter des anomalies cardiaques sous stress, comme l'angine de poitrine ou des troubles du rythme.`,
                logo: "../assets/img/consultationr.png"
            },
            {
                title: "Échographie d'Effort",
                description: `Combinaison d'une épreuve d'effort avec une échographie cardiaque pour analyser le fonctionnement du cœur sous contrainte physique et évaluer la fonction cardiaque en temps réel.`,
                logo: "../assets/img/consultationr.png"
            },
            {
                title: "Échographie Transœsophagienne sous Anesthésie Générale",
                description: `Cet examen permet d’obtenir des images détaillées du cœur en introduisant une sonde par l'œsophage, sous anesthésie générale, pour des indications spécifiques comme la recherche de caillots ou des anomalies des valves cardiaques.`,
                logo: "../assets/img/consultationr.png"
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
                question: "Qu'est-ce qu'un électrocardiogramme (ECG) ?",
                answer: `L'ECG est un examen qui enregistre l'activité électrique de votre cœur. Il permet de détecter des problèmes de rythme cardiaque, des signes d'attaque cardiaque ou d'autres anomalies cardiaques. Il est rapide, non invasif et indolore.`
            },
            {
                question: "Pourquoi ai-je besoin d'un Holter ECG ?",
                answer: `Le Holter ECG est utilisé pour surveiller l’activité électrique de votre cœur pendant 24 à 48 heures. Cela permet de détecter des arythmies ou d'autres anomalies du rythme cardiaque qui peuvent ne pas être présentes lors d'un ECG classique.`
            },
            {
                question: "Qu'est-ce qu'une échographie Doppler cardiaque ?",
                answer: `Une échographie Doppler cardiaque utilise des ondes sonores pour visualiser et évaluer le flux sanguin dans votre cœur. Elle permet de détecter des problèmes liés aux valves cardiaques, aux parois cardiaques, ou aux artères coronaires.`
            },
            {
                question: "À quoi sert l’épreuve d’effort ?",
                answer: `L’épreuve d'effort évalue la réponse de votre cœur lors d’un effort physique contrôlé, souvent sur un tapis roulant ou un vélo ergométrique. Elle permet de détecter des signes de maladies cardiaques, notamment l'angine de poitrine ou les troubles du rythme.`
            },
            {
                question: "Pourquoi dois-je passer une échographie transœsophagienne sous anesthésie générale ?",
                answer: `Cet examen est effectué sous anesthésie générale pour obtenir des images précises de votre cœur en insérant une sonde par l'œsophage, ce qui permet une meilleure visualisation des structures cardiaques, notamment dans le cas de maladies des valves cardiaques ou de la recherche de caillots.`
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