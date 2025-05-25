<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Imagerie Médicale - EHPHASNAOUI</title>
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
                            <h2>Imagerie Médicale</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Presentation Part -->
    <div class="presentation">
        <h2>Imagerie Médicale</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <p>L’imagerie médicale joue un rôle essentiel dans le diagnostic précis et le suivi des pathologies. À l’Établissement Hospitalier Privé Hasnaoui, nous disposons de technologies de pointe et d’une équipe d’experts dédiés pour fournir des examens d’imagerie fiables et efficaces. Notre objectif est d’offrir des résultats clairs et détaillés pour aider nos médecins à établir les meilleurs plans de traitement pour nos patients.</p>
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
                title: "Radiologie Conventionnelle",
                description: `Nous utilisons des équipements modernes pour réaliser des radiographies conventionnelles, qui permettent de visualiser les structures osseuses et organiques afin de détecter les anomalies telles que fractures, infections et autres pathologies.`,
                logo: "../assets/img/imagerie-thermique.png"
            },
            {
                title: "Scanner (CT)",
                description: `Notre scanner haute résolution fournit des images détaillées en coupe transversale, offrant une vue précise des structures internes du corps. Cet examen est crucial pour le diagnostic des maladies complexes et le suivi post-traitement.`,
                logo: "../assets/img/imagerie-thermique.png"
            },
            {
                title: "Imagerie par Résonance Magnétique (IRM)",
                description: `L’IRM utilise des champs magnétiques puissants et des ondes radio pour obtenir des images très détaillées des tissus mous et des organes. Elle est particulièrement utile pour évaluer les tissus neurologiques, musculaires et articulaires.`,
                logo: "../assets/img/imagerie-thermique.png"
            },
            {
                title: "Échographie",
                description: `Cette technique non invasive utilise des ondes sonores pour produire des images en temps réel des organes internes, des tissus mous et des structures corporelles. L’échographie est souvent utilisée pour surveiller la grossesse, diagnostiquer des troubles abdominaux et guider les procédures médicales.`,
                logo: "../assets/img/imagerie-thermique.png"
            },
            {
                title: "Mammographie",
                description: `Spécialisée dans le dépistage et le diagnostic des anomalies mammaires, la mammographie utilise des rayons X pour examiner les tissus mammaires et détecter les signes précoces de cancer du sein.`,
                logo: "../assets/img/imagerie-thermique.png"
            },
            {
                title: "Densitométrie Osseuse (DME)",
                description: `La DME mesure la densité minérale osseuse pour évaluer le risque d'ostéoporose et d'autres troubles osseux. Cet examen est essentiel pour le diagnostic précoce et le suivi des maladies osseuses.`,
                logo: "../assets/img/imagerie-thermique.png"
            },
            {
                title: "Radiographie Panoramique",
                description: `Utilisée principalement en dentisterie, la radiographie panoramique fournit une vue d'ensemble complète des structures dentaires et maxillaires. Elle est essentielle pour le diagnostic des pathologies dentaires, des malformations et des fractures.`,
                logo: "../assets/img/imagerie-thermique.png"
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
                question: "Quels sont les préparatifs nécessaires avant un examen d’imagerie ?",
                answer: `Les préparatifs varient en fonction du type d'examen. Pour certains examens, comme le scanner ou l'IRM, vous pourriez être invité à jeûner ou à éviter certains aliments. Notre équipe vous fournira des instructions précises avant l'examen.`
            },
            {
                question: "Les examens d’imagerie sont-ils douloureux ?",
                answer: `Les examens d’imagerie sont généralement non invasifs et ne causent pas de douleur. Vous pourriez ressentir un léger inconfort pendant certains examens, comme l’injection d’un produit de contraste, mais cela est temporaire.`
            },
            {
                question: "Combien de temps dure un examen d’imagerie ?",
                answer: `La durée des examens varie en fonction de la procédure. Une radiographie peut prendre quelques minutes, tandis qu’une IRM ou un scanner peut durer de 15 à 45 minutes, selon la complexité de l'examen.`
            },
            {
                question: "Comment puis-je obtenir les résultats de mon examen ?",
                answer: `Les résultats de l'examen seront examinés par notre radiologue, qui rédigera un rapport détaillé. Votre médecin vous communiquera ces résultats et discutera des prochaines étapes du traitement.`
            },
            {
                question: "Les examens d’imagerie sont-ils couverts par les assurances ?",
                answer: `La couverture des examens d’imagerie peut varier en fonction de votre assurance. Nous vous conseillons de vérifier auprès de votre assureur pour connaître les détails de votre couverture.`
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