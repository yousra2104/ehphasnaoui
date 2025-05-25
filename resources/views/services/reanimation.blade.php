<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Réanimation - EHPHASNAOUI</title>
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
                            <h2>Service de Réanimation et Anesthésie</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Presentation Part -->
    <div class="presentation">
        <h2>Présentation Service de Réanimation et Anesthésie</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <p>Le service de réanimation et anesthésie de notre hôpital est dédié à la prise en charge des patients nécessitant une surveillance intensive et un traitement spécialisé. Nos équipes, composées d'anesthésistes-réanimateurs hautement qualifiés, interviennent lors de situations critiques liées à des interventions chirurgicales complexes ou à des défaillances multiviscérales. La réanimation permet de stabiliser et surveiller les patients en état critique, tandis que l'anesthésie assure un confort optimal et une sécurité maximale avant, pendant et après les actes chirurgicaux. Nous mettons en œuvre des technologies de pointe pour offrir des soins de qualité dans un environnement sécurisant et adapté aux besoins de chaque patient.</p>
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
                title: "Anesthésie générale et loco-régionale",
                description: `• Anesthésie pour interventions chirurgicales programmées ou d'urgence.\n• Anesthésie locale, locorégionale (péridurale, spinale) selon les besoins du patient.`,
                logo: "../assets/img/hopital.png"
            },
            {
                title: "Réanimation polyvalente",
                description: `• Prise en charge des patients en état critique nécessitant des soins intensifs.\n• Surveillance 24/7 dans des unités de soins intensifs équipées des dernières technologies médicales.\n• Réanimation après intervention chirurgicale lourde.`,
                logo: "../assets/img/hopital.png"
            },
            {
                title: "Soins post-opératoires en salle de réveil",
                description: `• Surveillance post-chirurgicale immédiate après une anesthésie générale.\n• Gestion de la douleur postopératoire, incluant des traitements personnalisés pour chaque patient.`,
                logo: "../assets/img/hopital.png"
            },
            {
                title: "Prise en charge des urgences vitales",
                description: `• Réanimation en cas de défaillance cardio-respiratoire aiguë.\n• Soins d’urgence pour des patients dans un état critique, avec une surveillance et une gestion spécifiques.`,
                logo: "../assets/img/hopital.png"
            },
            {
                title: "Anesthésie pour patients à risque",
                description: `• Anesthésie adaptée pour des patients ayant des antécédents médicaux complexes (maladies cardiaques, respiratoires, etc.).\n• Consultation pré-anesthésique pour évaluer les risques et définir un plan de soins personnalisé.`,
                logo: "../assets/img/hopital.png"
            },
            {
                title: "Suivi et réhabilitation post-réanimation",
                description: `• Suivi personnalisé en post-réanimation pour aider à la récupération après une prise en charge intensive.`,
                logo: "../assets/img/hopital.png"
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
                question: "Qu'est-ce que l'anesthésie générale ?",
                answer: `L'anesthésie générale est une procédure qui permet d'endormir totalement le patient pendant une intervention chirurgicale. Cela élimine toute douleur et toute conscience pendant l'opération. Un anesthésiste assure la surveillance de votre état tout au long de l'intervention.`
            },
            {
                question: "Est-ce que je peux être admis en réanimation après une chirurgie ?",
                answer: `Oui, en fonction de la nature de l'opération, il est possible que vous soyez transféré en réanimation ou en soins post-opératoires pour une surveillance étroite. Cela se fait afin de garantir votre sécurité, particulièrement après des interventions complexes.`
            },
            {
                question: "Quelle est la différence entre réanimation et soins intensifs ?",
                answer: `La réanimation se réfère spécifiquement aux soins destinés aux patients dont les fonctions vitales sont gravement altérées et nécessitent des interventions urgentes. Les soins intensifs sont un terme plus général qui inclut également la surveillance et le traitement des patients dans des états graves mais moins critiques.`
            },
            {
                question: "Quels sont les risques associés à l'anesthésie ?",
                answer: `Les risques de l'anesthésie sont généralement faibles, mais dépendent de l'état de santé du patient et du type d'anesthésie administrée. Avant toute intervention, une consultation pré-anesthésique permet d'évaluer ces risques et de prendre les mesures nécessaires pour les minimiser.`
            },
            {
                question: "Comment la douleur est-elle gérée après une chirurgie ?",
                answer: `La gestion de la douleur est une priorité dans notre service. Nous utilisons différentes méthodes, telles que des médicaments antidouleur, des techniques d'anesthésie locale, et des soins personnalisés, pour assurer votre confort après l'intervention.`
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