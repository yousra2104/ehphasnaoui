<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Gynécologie - EHPHASNAOUI</title>
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
                            <h2>Unité de Gynécologie et Obstétrique</h2>
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
        <p>L'Unité de Gynécologie et Obstétrique de notre établissement est dédiée à l'accompagnement médical des femmes à chaque étape de leur parcours de santé, de la prévention des pathologies gynécologiques à la gestion de la grossesse, de l'accouchement et du post-partum. Notre équipe pluridisciplinaire, composée de gynécologues, obstétriciens, sages-femmes et personnel soignant, est engagée à offrir des soins personnalisés et de haute qualité dans un environnement sécurisé et respectueux. Nous mettons à votre disposition une large gamme de services médicaux et chirurgicaux, adaptés aux besoins spécifiques des femmes, allant de la prise en charge des troubles gynécologiques aux soins obstétricaux, tout en garantissant une approche préventive, thérapeutique et éducative.</p>
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
                title: "Suivi prénatal",
                description: `Nous offrons un suivi médical complet tout au long de la grossesse, incluant des consultations régulières, des échographies, des tests de dépistage et des bilans de santé pour assurer la sécurité de la mère et de l’enfant. Nos obstétriciens et sages-femmes vous accompagnent tout au long de cette période cruciale.`,
                logo: "../assets/img/main.png"
            },
            {
                title: "Préparation à l’accouchement",
                description: `Nos séances de préparation à l'accouchement sont conçues pour vous fournir les outils nécessaires afin de vivre cet événement en toute sérénité. Nous proposons des cours adaptés à chaque situation (préparation à l'accouchement classique, gestion de la douleur, relaxation, préparation à la césarienne, etc.).`,
                logo: "../assets/img/main.png"
            },
            {
                title: "Accouchement et soins postnataux",
                description: `Nous garantissons un accompagnement médical pendant l'accouchement, qu’il soit naturel ou par césarienne, en assurant la sécurité de la mère et de l’enfant. Après l’accouchement, notre équipe prend en charge la mère et le bébé pour des soins postnataux, y compris des conseils sur l’allaitement, la récupération post-partum et le suivi du bien-être de l’enfant.`,
                logo: "../assets/img/main.png"
            },
            {
                title: "Chirurgie gynécologique",
                description: `Nous proposons une prise en charge chirurgicale des pathologies gynécologiques bénignes et malignes, telles que les fibromes, les kystes ovariens, les infections pelviennes, ainsi que des interventions pour les troubles de la fertilité. Nos interventions sont réalisées avec des techniques chirurgicales modernes et dans le respect des normes de sécurité les plus strictes.`,
                logo: "../assets/img/main.png"
            },
            {
                title: "Gynécologie préventive",
                description: `Nous assurons des consultations préventives, incluant des bilans de santé, des dépistages de cancers gynécologiques (cancer du sein, du col de l’utérus), des conseils sur la contraception, ainsi que des traitements pour les troubles hormonaux. La prévention reste une priorité pour préserver la santé des femmes à chaque étape de la vie.`,
                logo: "../assets/img/main.png"
            },
            {
                title: "Fertilité et assistance médicale à la procréation (AMP)",
                description: `Nous proposons une prise en charge de la fertilité pour les couples ayant des difficultés à concevoir. Nous offrons des traitements de fertilité personnalisés, tels que la stimulation ovarienne, l’insémination intra-utérine (IIU) et la fécondation in vitro (FIV), pour accompagner nos patientes dans leur parcours de conception.`,
                logo: "../assets/img/main.png"
            },
            {
                title: "Prise en charge de la ménopause",
                description: `Notre unité accompagne les femmes dans la gestion de la ménopause, avec un suivi personnalisé pour traiter les symptômes hormonaux et proposer des traitements adaptés (thérapie hormonale et non hormonale). Nous offrons également des conseils nutritionnels et psychologiques pour une prise en charge globale.`,
                logo: "../assets/img/main.png"
            },
            {
                title: "Troubles menstruels",
                description: `Nous intervenons pour traiter les troubles menstruels, qu'il s'agisse de règles irrégulières, de douleurs menstruelles sévères ou de saignements anormaux. Nous proposons des solutions médicales adaptées pour soulager ces symptômes et améliorer la qualité de vie de nos patientes.`,
                logo: "../assets/img/main.png"
            },
            {
                title: "Échographie obstétricale et gynécologique",
                description: `Nos échographes réalisent des échographies prénatales (échographie de datation, échographie morphologique, suivi de la croissance fœtale) et des échographies gynécologiques pour l'évaluation de la santé de l'utérus, des ovaires et des organes reproducteurs.`,
                logo: "../assets/img/main.png"
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
                question: "Quand devrais-je commencer mon suivi prénatal ?",
                answer: `Il est recommandé de commencer le suivi prénatal dès le début de la grossesse, idéalement dès la confirmation de la grossesse. Un suivi précoce permet de réaliser les tests nécessaires et de garantir la santé de la mère et de l’enfant.`
            },
            {
                question: "Quelles sont les options pour la gestion de la douleur pendant l’accouchement ?",
                answer: `Nous proposons diverses options pour la gestion de la douleur lors de l'accouchement, incluant des méthodes non médicamenteuses (relaxation, hypnobirthing) ainsi que des options médicamenteuses comme la péridurale. Nous discuterons avec vous de la méthode la plus adaptée à vos attentes et à votre situation médicale.`
            },
            {
                question: "La césarienne est-elle systématiquement recommandée ?",
                answer: `Non, la césarienne est pratiquée uniquement lorsque cela est médicalement nécessaire, par exemple en cas de complications pendant la grossesse ou de difficultés durant l’accouchement. Nous privilégions toujours un accouchement par voie basse, sauf si la sécurité de la mère ou de l’enfant l'exige.`
            },
            {
                question: "Quand consulter un gynécologue pour un bilan de santé ?",
                answer: `Il est conseillé de consulter un gynécologue pour un premier bilan de santé à partir de 18 ans, ou plus tôt si vous êtes sexuellement active ou présentez des symptômes spécifiques. Des bilans de santé réguliers sont également recommandés à partir de la trentaine.`
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