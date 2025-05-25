<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Gastologie - EHPHASNAOUI</title>
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
                            <h2>Service Hépatologie et Gastro-entérologie</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Presentation Part -->
    <div class="presentation">
        <h2>Présentation de service Hépatologie et Gastro-entérologie</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <p>Notre service d'hépatologie et gastro-entérologie propose une prise en charge complète et spécialisée des maladies du foie, du tube digestif et des organes associés. Grâce à notre équipe de spécialistes expérimentés et à un plateau technique de pointe, nous vous offrons des soins adaptés à chaque pathologie, qu’elle soit bénigne ou complexe.</p>
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
                title: "Prise en Charge des Maladies du Foie (Hépatologie)",
                description: `Nous offrons une prise en charge spécialisée des pathologies hépatiques, qu’il s’agisse de maladies bénignes ou chroniques, ainsi que des complications liées aux maladies du foie.\n• Hépatite virale (Hépatite B, C et autres) : Diagnostic, suivi, et traitements antiviraux pour contrôler l’évolution de ces infections.\n• Cirrhose hépatique : Suivi des patients atteints de cirrhose, gestion des complications (comme l'ascite, les varices oesophagiennes, etc.) et prévention de la progression de la maladie.\n• Fibrose hépatique : Evaluation de la fibrose hépatique avec des techniques non invasives (FibroScan) et mise en place de traitements pour ralentir l’évolution de la maladie.\n• Transplantation hépatique : Prise en charge des candidats à la transplantation hépatique, du diagnostic à la préparation à l’intervention.`,
                logo: "../assets/img/gastro-enterologie (2).png"
            },
            {
                title: "Prise en Charge des Pathologies Digestives (Gastro-entérologie)",
                description: `Nous traitons une large gamme de pathologies du système digestif, qu’elles soient inflammatoires, fonctionnelles ou tumorales.\n• Maladies inflammatoires chroniques de l'intestin (MICI) : Suivi et traitement des pathologies telles que la colite ulcéreuse et la maladie de Crohn, avec une approche personnalisée visant à contrôler les poussées et à améliorer la qualité de vie des patients.\n• Syndrome de l’intestin irritable (SII) : Diagnostic et gestion des symptômes fonctionnels comme la douleur abdominale, les ballonnements et les troubles du transit.\n• Gastrite et ulcère gastrique : Traitement des troubles inflammatoires de l’estomac et du duodénum, y compris les infections à Helicobacter pylori et les ulcères associés.\n• Reflux gastro-œsophagien (RGO) : Prise en charge des symptômes liés au reflux acide et des complications associées, comme l’œsophagite ou le cancer de l’œsophage.\n• Cancer gastro-intestinal : Dépistage, diagnostic précoce et traitement des cancers du côlon, de l'estomac, de l'œsophage, du foie, et du pancréas.`,
                logo: "../assets/img/gastro-enterologie (2).png"
            },
            {
                title: "Endoscopie Digestive",
                description: `Notre service dispose des équipements les plus modernes pour réaliser des examens endoscopiques diagnostiques et thérapeutiques, permettant une visualisation directe des organes internes et la réalisation de biopsies ou de traitements ciblés.\n• Gastroscopie : Exploration de l'œsophage, de l’estomac et du duodénum pour diagnostiquer les maladies inflammatoires, les ulcères, les tumeurs et les infections.\n• Coloscopie : Exploration du côlon et du rectum pour dépister et traiter les polypes, les cancers du côlon et d’autres pathologies intestinales.\n• Endoscopie biliaire et pancréatique (CPRE) : Technique utilisée pour examiner les voies biliaires et pancréatiques, traiter les calculs biliaires ou les sténoses des canaux biliaires.\n• Sigmoïdoscopie : Examen de la partie inférieure du côlon pour diagnostiquer les troubles intestinaux.`,
                logo: "../assets/img/gastro-enterologie (2).png"
            },
            {
                title: "Diagnostic et Traitement des Troubles Fonctionnels Digestifs",
                description: `Nos spécialistes prennent en charge les troubles digestifs fonctionnels et les maladies liées au fonctionnement des organes digestifs, y compris :\n• Syndrome du côlon irritable (SII) : Gestion des symptômes comme la douleur abdominale, la constipation ou la diarrhée, avec une approche multidisciplinaire incluant des modifications alimentaires, des traitements médicamenteux et des thérapies comportementales.\n• Dyspepsie fonctionnelle : Traitement des troubles digestifs récurrents comme les douleurs gastriques, les ballonnements et les nausées sans cause organique apparente.\n• Troubles du transit : Prise en charge de la constipation chronique ou de la diarrhée, et optimisation du traitement en fonction des résultats diagnostiques.`,
                logo: "../assets/img/gastro-enterologie (2).png"
            },
            {
                title: "Prise en Charge de l’Obésité et Troubles Métaboliques",
                description: `L'obésité et les troubles associés, comme la stéatose hépatique (foie gras), sont des préoccupations croissantes. Nous proposons des solutions thérapeutiques visant à contrôler l’obésité et à traiter ses complications métaboliques.\n• Bilan métabolique : Evaluation de la fonction hépatique, rénale, et des risques cardiovasculaires associés à l'obésité.\n• Traitements nutritionnels et comportementaux : Accompagnement diététique et soutien psychologique pour aider les patients à perdre du poids et à maintenir une hygiène de vie saine.\n• Chirurgie bariatrique : Pour les cas d’obésité sévère, nous proposons des solutions chirurgicales comme la bypass gastrique ou la sleeve gastrectomie, afin de réduire le poids corporel et prévenir les complications liées à l’obésité.`,
                logo: "../assets/img/gastro-enterologie (2).png"
            },
            {
                title: "Prise en Charge des Pathologies Pancréatiques",
                description: `Les maladies du pancréas, y compris les pancréatites aiguës et chroniques ainsi que les cancers du pancréas, nécessitent une prise en charge spécialisée.\n• Pancréatite aiguë : Diagnostic et traitement des crises aigües, gestion des complications comme l’infection ou la défaillance organique.\n• Pancréatite chronique : Surveillance et traitement des douleurs chroniques, des troubles de la digestion et de l'insuffisance pancréatique.\n• Cancer du pancréas : Dépistage précoce, diagnostic par imagerie et biopsie, traitement chirurgical et suivi post-opératoire.`,
                logo: "../assets/img/gastro-enterologie (2).png"
            },
            {
                title: "Consultations Spécialisées",
                description: `Nos consultations spécialisées permettent une prise en charge complète et personnalisée des patients. Nous proposons des bilans de santé, des dépistages de maladies digestives et hépatiques, ainsi qu'un suivi adapté pour les pathologies chroniques.\n• Consultations de prévention : Pour dépister les troubles hépatiques et gastro-intestinaux, en particulier pour les personnes à risque (antécédents familiaux, hépatite virale, etc.).\n• Suivi des pathologies chroniques : Prise en charge des maladies chroniques du foie (cirrhose, hépatite chronique) et des maladies inflammatoires de l’intestin avec une approche individualisée.`,
                logo: "../assets/img/gastro-enterologie (2).png"
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
                question: "Quand consulter un gastro-entérologue ou un hépatologue ?",
                answer: `Consultez un spécialiste si vous avez des symptômes comme :\n• Douleurs abdominales fréquentes\n• Troubles du transit (diarrhée, constipation)\n• Reflux gastro-œsophagiens\n• Perte d’appétit, nausées, ou selles sanglantes\n• Symptômes de maladie du foie (jaunisse, fatigue intense)`
            },
            {
                question: "Quels traitements pour l’hépatite C et B ?",
                answer: `• Hépatite C : Traitements antiviraux modernes qui permettent souvent une guérison complète.\n• Hépatite B : Antiviraux pour contrôler la maladie, mais pas de guérison complète possible.`
            },
            {
                question: "Comment diagnostiquer un cancer digestif ?",
                answer: `Le diagnostic se fait par :\n• Endoscopie (gastroscopie, coloscopie) pour visualiser et biopsier la tumeur.\n• Imagerie (échographie, scanner, IRM) pour localiser et évaluer le cancer.\n• Tests sanguins pour détecter des marqueurs tumoraux.`
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