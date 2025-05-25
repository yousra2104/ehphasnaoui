<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Chirurgie - EHPHASNAOUI</title>
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
                            <h2>Chirurgie Générale et Cœlioscopique</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Presentation Part -->
    <div class="presentation">
        <h2>Présentation du Service de Chirurgie Générale et Cœlioscopique</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <p>La chirurgie générale et cœlioscopique à l'Établissement Hospitalier Privé Hasnaoui est conçue pour offrir des soins chirurgicaux de la plus haute qualité en alliant expertise médicale, technologie de pointe et environnement sécurisé. Notre équipe de chirurgiens spécialisés possède une grande expérience dans la réalisation de procédures complexes, garantissant une prise en charge optimale et personnalisée de chaque patient. Grâce à l'utilisation d'équipements modernes, notamment pour la cœlioscopie, nous sommes en mesure de réaliser des interventions minimales invasives, ce qui réduit la douleur post-opératoire et accélère la récupération.</p>
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
                title: "Chirurgie Endocrinienne",
                description: `Nous offrons des interventions spécialisées pour les pathologies de la thyroïde et des glandes parathyroïdes. Nos procédures sont conçues pour gérer les troubles hormonaux et les anomalies glandulaires, visant à restaurer l'équilibre hormonal et améliorer la qualité de vie des patients.`,
                logo: "../assets/img/chirurgieg.png"
            },
            {
                title: "Chirurgie de la Paroi",
                description: `Nos chirurgiens interviennent dans la réparation des hernies abdominales, une condition pouvant causer douleur et complications. Grâce à des techniques avancées, nous assurons une correction efficace des défauts de la paroi abdominale, réduisant les risques de récidive et favorisant une récupération rapide.`,
                logo: "../assets/img/chirurgieg.png"
            },
            {
                title: "Chirurgie Oncologique",
                description: `Nous proposons des traitements spécialisés pour les cancers, utilisant des approches chirurgicales adaptées à chaque type de cancer. Notre objectif est d'éliminer les tumeurs tout en préservant la fonction organique et en maximisant le confort du patient pendant le traitement.`,
                logo: "../assets/img/chirurgieg.png"
            },
            {
                title: "Chirurgie Proctologique",
                description: `Nous traitons les affections de l'anus et du rectum, telles que les hémorroïdes, les fissures et les fistules, en utilisant des techniques modernes. Nos interventions visent à soulager les symptômes, corriger les troubles et améliorer la qualité de vie de nos patients de manière efficace et délicate.`,
                logo: "../assets/img/chirurgieg.png"
            },
            {
                title: "Chirurgie Digestive",
                description: `Nous intervenons sur l'appareil digestif pour traiter diverses pathologies, des maladies inflammatoires aux troubles fonctionnels. Notre approche est centrée sur la restauration de la fonction digestive et le soulagement des symptômes, avec des techniques adaptées et des soins personnalisés.`,
                logo: "../assets/img/chirurgieg.png"
            },
            {
                title: "Chirurgie Métabolique et de l'Obésité",
                description: `Nous proposons des solutions chirurgicales pour la gestion de l'obésité et la perte de poids, comme la gastrectomie verticale ou le by-pass gastrique. Ces interventions aident nos patients à atteindre et maintenir un poids corporel sain, tout en améliorant leur bien-être général et leur qualité de vie.`,
                logo: "../assets/img/chirurgieg.png"
            },
            {
                title: "Chirurgie Laparoscopique",
                description: `Nous utilisons des techniques mini-invasives pour réaliser diverses interventions chirurgicales. La chirurgie laparoscopique permet de pratiquer des procédures avec de petites incisions, réduisant la douleur post-opératoire, le risque d'infection et le temps de récupération, tout en offrant des résultats optimaux.`,
                logo: "../assets/img/chirurgieg.png"
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
                question: "Quels sont les avantages de la chirurgie mini-invasive ?",
                answer: `Elle réduit les douleurs, les risques d'infection, et permet une récupération rapide.`
            },
            {
                question: "Comment puis-je préparer ma chirurgie ?",
                answer: `Une consultation pré-opératoire et des tests diagnostiques seront effectués pour garantir une préparation optimale.`
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