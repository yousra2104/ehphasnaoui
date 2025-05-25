<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Pédiatrie - EHPHASNAOUI</title>
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
                            <h2>Service de Pédiatrie et Néonatologie</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Presentation Part -->
    <div class="presentation">
        <h2>Présentation</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <p>Bienvenue dans notre service de pédiatrie et néonatologie, un espace dédié au soin, à l’accompagnement et au suivi de la santé des enfants, des nouveau-nés et des nourrissons. Notre équipe de médecins pédiatres, néonatologistes, infirmiers et spécialistes s’engage à offrir des soins de haute qualité dans un environnement rassurant et bienveillant. Nous mettons à disposition des équipements modernes et des protocoles de soins adaptés aux besoins spécifiques des plus jeunes, en particulier des nouveau-nés, tout en impliquant les familles à chaque étape du parcours de soin.</p>
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
                title: "Consultations pédiatriques",
                description: `Nous proposons des consultations régulières pour les enfants de tous âges, afin de prévenir, diagnostiquer et traiter une variété de conditions médicales. Que ce soit pour des suivis de croissance, des vaccinations ou la gestion de maladies courantes, nos pédiatres sont là pour offrir des soins de qualité adaptés à chaque situation.`,
                logo: "../assets/img/pediatried.png"
            },
            {
                title: "Photothérapie intensive",
                description: `La photothérapie intensive est utilisée dans le traitement de l'hyperbilirubinémie néonatale (jaunisse chez les nouveau-nés). Cette technique, réalisée sous surveillance médicale, permet de réduire efficacement le taux de bilirubine dans le sang des bébés en utilisant des lumières spécifiques.`,
                logo: "../assets/img/pediatried.png"
            },
            {
                title: "Photothérapie conventionnelle",
                description: `En complément de la photothérapie intensive, nous proposons également la photothérapie conventionnelle, qui est utilisée pour traiter les cas moins graves de jaunisse néonatale. Elle permet de normaliser progressivement le taux de bilirubine de façon sécuritaire.`,
                logo: "../assets/img/pediatried.png"
            },
            {
                title: "Couveuse",
                description: `Pour les nourrissons prématurés ou ayant besoin d'un suivi particulier, nous disposons de couveuses modernes permettant de maintenir une température optimale, d’assurer une oxygénation et un soutien vital adapté jusqu’à ce que le bébé soit prêt à être accueilli dans des conditions normales.`,
                logo: "../assets/img/pediatried.png"
            },
            {
                title: "Vaccins à la naissance",
                description: `Afin de protéger les nouveau-nés dès leur arrivée, nous assurons l'administration des premiers vaccins nécessaires. Nos équipes respectent les protocoles sanitaires pour garantir la sécurité et la santé des nourrissons.`,
                logo: "../assets/img/pediatried.png"
            },
            {
                title: "Hospitalisation",
                description: `En cas de pathologies plus complexes, nous offrons des services d’hospitalisation, permettant un suivi médical quotidien et une prise en charge continue dans un environnement adapté aux jeunes patients.`,
                logo: "../assets/img/pediatried.png"
            },
            {
                title: "Bili Check",
                description: `Le BiliCheck est un test non invasif pour mesurer le taux de bilirubine dans la peau du nouveau-né, permettant ainsi de détecter rapidement une jaunisse et de déterminer la nécessité de traitements supplémentaires comme la photothérapie.`,
                logo: "../assets/img/pediatried.png"
            },
            {
                title: "Suivi des maladies chroniques pédiatriques",
                description: `Nous proposons un suivi de qualité pour les enfants souffrant de maladies chroniques, comme l'asthme, le diabète ou d'autres conditions à long terme. Grâce à un suivi personnalisé, nous aidons à la gestion optimale de ces maladies pour améliorer la qualité de vie des jeunes patients.`,
                logo: "../assets/img/pediatried.png"
            },
            {
                title: "CPAP (Pression Positive Continue des Voies Respiratoires)",
                description: `Le CPAP est utilisé pour aider les bébés souffrant de difficultés respiratoires, en particulier ceux nés prématurément. Cet appareil aide à maintenir les voies respiratoires ouvertes en fournissant un flux constant d’air, garantissant ainsi une meilleure oxygénation.`,
                logo: "../assets/img/pediatried.png"
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
                question: "À partir de quel âge un enfant peut-il consulter un pédiatre ?",
                answer: `Les consultations pédiatriques peuvent commencer dès la naissance. Il est important d'effectuer des visites régulières pour surveiller la croissance et la santé de votre enfant, ainsi que pour réaliser les vaccinations nécessaires.`
            },
            {
                question: "Qu'est-ce que la photothérapie et quand est-elle nécessaire ?",
                answer: `La photothérapie est un traitement qui utilise des lumières spécifiques pour traiter la jaunisse néonatale. Elle est utilisée lorsque le taux de bilirubine du bébé est trop élevé, ce qui peut causer des problèmes de santé.`
            },
            {
                question: "Quand faut-il hospitaliser un bébé ?",
                answer: `L'hospitalisation peut être nécessaire si un bébé présente des complications à la naissance, des problèmes respiratoires, ou des maladies nécessitant une surveillance et des soins intensifs. Nos néonatologistes évaluent chaque situation pour déterminer le meilleur plan de soins.`
            },
            {
                question: "Est-ce que la CPAP est utilisée pour tous les nouveau-nés prématurés ?",
                answer: `Non, la CPAP est utilisée uniquement lorsque le bébé présente des difficultés respiratoires et que des méthodes supplémentaires sont nécessaires pour l’aider à respirer correctement. Ce traitement est adapté en fonction de l’état de santé de chaque enfant.`
            },
            {
                question: "Quelles sont les vaccinations administrées à la naissance ?",
                answer: `Les premières vaccinations à la naissance incluent principalement l’hépatite B, et parfois d'autres selon les recommandations locales ou les conditions spécifiques du nourrisson.`
            },
            {
                question: "Est-ce que le BiliCheck est douloureux pour le bébé ?",
                answer: `Non, le BiliCheck est un test totalement non invasif. Il consiste en une simple mesure de la bilirubine en utilisant une sonde sur la peau du bébé, ce qui ne provoque aucune douleur.`
            },
            {
                question: "Comment suivre la santé de mon enfant si une maladie chronique est diagnostiquée ?",
                answer: `Nous offrons un suivi personnalisé et régulier pour les enfants atteints de maladies chroniques. Des consultations périodiques sont prévues pour suivre l’évolution de la maladie et adapter les traitements en fonction de l’évolution de la santé de l’enfant.`
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