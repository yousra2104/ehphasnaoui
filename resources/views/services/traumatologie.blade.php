<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Traumatologique - EHPHASNAOUI</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/BreadcumbsVisite.css">
    <link rel="stylesheet" href="../assets/css/services.css">
    <link rel="stylesheet" href="../assets/css/globals.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
                            <h2>Chirurgie Orthopédique et Traumatologique</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Presentation Part -->
    <div class="presentation">
        <h2>Présentation de service Chirurgie Orthopédique et Traumatologique</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <p>Nous proposons une prise en charge spécialisée en chirurgie orthopédique et traumatologique, couvrant un large éventail de pathologies musculo-squelettiques. Grâce à une équipe de chirurgiens expérimentés et à des techniques de pointe, nous assurons des traitements adaptés à chaque patient, visant à restaurer la mobilité, soulager la douleur et améliorer la qualité de vie.</p>
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
                title: "Traumatologie",
                description: `Traitement des fractures, luxations et blessures traumatiques, avec une approche personnalisée pour chaque type de traumatisme.`,
                logo: "../assets/img/les-articulations.png"
            },
            {
                title: "Chirurgie Prothétique (PTH, PTG, PTE)",
                description: `Remplacement articulaire pour traiter l'arthrose et les pathologies des articulations majeures, y compris la prothèse totale de hanche (PTH), la prothèse totale de genou (PTG) et la prothèse totale d'épaule (PTE).`,
                logo: "../assets/img/les-articulations.png"
            },
            {
                title: "Chirurgie Arthroscopique du Genou et de l'Épaule",
                description: `Intervention mini-invasive pour traiter les lésions du cartilage, des ligaments et des tendons, offrant des avantages tels qu'une récupération plus rapide et moins de douleur postopératoire.`,
                logo: "../assets/img/les-articulations.png"
            },
            {
                title: "Chirurgie de la Main et Microchirurgie des Nerfs",
                description: `Prise en charge des affections de la main, des tendinites et des fractures, ainsi que des réparations nerveuses avec des techniques de microchirurgie pour une récupération optimale.`,
                logo: "../assets/img/les-articulations.png"
            },
            {
                title: "Chirurgie du Rachis (Colonne Vertébrale)",
                description: `Traitement des pathologies de la colonne vertébrale, telles que les hernies discales, scolioses et douleurs chroniques, avec des techniques modernes et peu invasives.`,
                logo: "../assets/img/les-articulations.png"
            },
            {
                title: "Traumatologie du Sport",
                description: `Soins spécialisés pour les blessures sportives, y compris les fractures, déchirures ligamentaires, tendinites et entorses, avec l'objectif de permettre une reprise rapide des activités physiques.`,
                logo: "../assets/img/les-articulations.png"
            },
            {
                title: "Arthrite et Maladies Articulaires",
                description: `Traitement des pathologies inflammatoires des articulations, telles que l'arthrite rhumatoïde, pour soulager la douleur et améliorer la fonction articulaire.`,
                logo: "../assets/img/les-articulations.png"
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
                question: "Quand consulter un chirurgien orthopédique ?",
                answer: `Il est recommandé de consulter un chirurgien orthopédique si vous présentez des douleurs articulaires persistantes, une perte de mobilité ou après un traumatisme (fracture, entorse, etc.).`
            },
            {
                question: "Qu'est-ce que l'arthroscopie et quels sont ses avantages ?",
                answer: `L'arthroscopie est une intervention chirurgicale mini-invasive qui permet de traiter des affections internes des articulations, avec des avantages tels qu'une réduction des cicatrices, moins de douleur postopératoire et une reprise plus rapide des activités.`
            },
            {
                question: "Quel est le temps de récupération après une chirurgie de remplacement articulaire ?",
                answer: `Le temps de récupération varie selon le type d'intervention et l'état général du patient, mais la rééducation commence généralement dès les premiers jours après l'opération. La reprise des activités normales peut prendre entre 3 et 6 mois, selon chaque patient.`
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