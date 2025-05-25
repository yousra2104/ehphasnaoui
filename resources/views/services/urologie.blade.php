<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="MACode ID, https://macodeid.com/">
    <title>Urologie - EHPHASNAOUI</title>
    <link rel="icon" href="../assets/img/logozoom.PNG" />
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../assets/css/BreadcumbsVisite.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/icofont@1.0.0/dist/icofont.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/globals.css">
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
            text-align: left !important;
            padding-left: 15px;
        }

        .accordion {
            background-color: #e5eafb;
            color: black;
            margin-bottom: 10px;
            border-radius: 4px;
            overflow: hidden;
            text-align: left !important;
        }

        .accordion-header {
            padding: 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left !important;
        }

        .accordion-content {
            padding: 0 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            text-align: left !important;
        }

        .accordion-content p {
            text-align: left !important;
            margin: 0;
            color: black !important; /* Ensure answer text is black */
        }

        .accordion-content.active {
            padding: 15px;
            max-height: 500px;
            color: black;
            background-color: #e5eafb;
            text-align: left !important;
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
                            <h2>Service Urologie</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Presentation Part -->
    <div class="presentation">
        <h2>L'Urologie : Spécialité médicale dédiée à la santé urinaire et reproductive</h2>
        <img src="../assets/img/section-img.png" alt="section img">
        <p>L'urologie est une spécialité chirurgicale et médicale qui s'intéresse au diagnostic, au traitement et à la prévention des maladies affectant le système urinaire chez les hommes et les femmes, ainsi que le système reproducteur masculin. Cette discipline couvre une large gamme de pathologies, allant des infections urinaires bénignes aux troubles plus complexes, comme les cancers urologiques ou les dysfonctionnements sexuels. Les organes concernés par l'urologie sont les reins, la vessie, l'urètre, ainsi que les organes reproducteurs masculins, tels que les testicules, la prostate et le pénis. L'urologue prend en charge une variété de pathologies, et son rôle est essentiel pour améliorer la qualité de vie des patients en leur offrant des solutions thérapeutiques adaptées.</p>
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
                title: "Chirurgie de la Prostate",
                description: `Nous proposons plusieurs techniques de prise en charge pour l'hypertrophie bénigne de la prostate (HBP), adaptées à chaque patient. Selon l’indication et l'état de santé du patient, nos options vont de la chirurgie classique à la chirurgie endoscopique mini-invasive. Nous utilisons également des technologies avancées pour offrir une solution rapide et moins invasive.\n <br/>• Prostatectomie totale : Traitement du cancer de la prostate, avec une approche chirurgicale qui permet une résection complète de la glande prostatique.\n• Biopsie prostatique : Un examen essentiel pour poser un diagnostic de cancer prostatique, effectué sous anesthésie locale ou générale, selon le cas.`,
                logo: "../assets/img/chirurgie__i.png"
            },
            {
                title: "Lithiases Urinaires",
                description: `Pour le traitement des calculs urinaires, nous disposons d'un plateau technique complet permettant une prise en charge mini-invasive. Grâce à notre technologie de pointe, notamment le laser Holmium YAG puissant, nous pouvons détruire les calculs rénaux ou urinaires de manière précise et efficace, tout en préservant les tissus sains.\nLes techniques que nous utilisons incluent :\n• Lithotripsie (fragmentation des calculs).\n• Urétéroscopie et néphroscopie pour accéder et retirer les calculs en utilisant des instruments miniaturisés.`,
                logo: "../assets/img/chirurgie__i.png"
            },
            {
                title: "Prise en Charge des Pathologies Tumorales de l'Appareil Urogénital",
                description: `Nous offrons une prise en charge complète des tumeurs de l’appareil urogénital, incluant le rein, la vessie, la prostate et les testicules. Nos techniques incluent :\n• Chirurgie ouverte ou laparoscopique pour les tumeurs rénales ou vésicales.\n• Traitements ciblés et suivi multidisciplinaire pour les cancers avancés.`,
                logo: "../assets/img/chirurgie__i.png"
            },
            {
                title: "Urologie Fonctionnelle",
                description: `L'incontinence urinaire et les prolapsus des organes pelviens sont des pathologies courantes qui peuvent impacter gravement la qualité de vie. Nous offrons une prise en charge globale et personnalisée, incluant :\n• Rééducation périnéale : pour renforcer les muscles du plancher pelvien et améliorer la continence.\n• Chirurgie des prolapsus : correction des descentes d’organes pelviens par voie chirurgicale ou par techniques mini-invasives.`,
                logo: "../assets/img/chirurgie__i.png"
            },
            {
                title: "Chirurgie de Varicocèle",
                description: `La varicocèle est une dilatation des veines du scrotum qui peut affecter la fertilité. Nous proposons deux approches chirurgicales :\n• Chirurgie par laparotomie pour les cas plus complexes.\n• Chirurgie laparoscopique et microscopique, moins invasive et offrant une meilleure récupération post-opératoire.`,
                logo: "../assets/img/chirurgie__i.png"
            },
            {
                title: "Consultations Spécialisées",
                description: `Nos consultations spécialisées couvrent tous les domaines de l’urologie, qu’il s’agisse de suivi, de diagnostic ou de traitement. Nos urologues sont à l'écoute de vos besoins pour vous orienter vers la meilleure prise en charge possible.\n• Consultations de prévention et dépistage : pour surveiller la santé urologique (cancer de la prostate, infections urinaires, etc.).\n• Suivi personnalisé : pour les patients ayant subi une chirurgie urologique ou pour ceux nécessitant des traitements à long terme.`,
                logo: "../assets/img/chirurgie__i.png"
            },
            {
                title: "Chirurgie des Malformations Urogénitales",
                description: `Nous intervenons sur les pathologies malformatives de l’appareil urogénital, tant chez l’adulte que chez l’enfant. Que ce soit pour des malformations congénitales ou acquises, nous proposons des traitements chirurgicaux adaptés, utilisant des techniques de laparotomie, laparoscopie ou chirurgie ouverte selon la nature et la gravité de la malformation.`,
                logo: "../assets/img/chirurgie__i.png"
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
                question: "Quand consulter un urologue ?",
                answer: `Il est conseillé de consulter un urologue si vous présentez des symptômes tels que :<br>
• Douleur ou difficulté à uriner.<br>
• Présence de sang dans les urines (hématurie).<br>
• Infections urinaires récurrentes.<br>
• Problèmes de continence (incontinence urinaire).<br>
• Troubles de la fonction sexuelle (dysfonction érectile, éjaculation précoce).<br>
Si vous avez plus de 50 ans, un bilan de santé urologique régulier est aussi recommandé, notamment pour surveiller la prostate.`
            },
            {
                question: "Quels sont les traitements pour l'incontinence urinaire ?",
                answer: `Le traitement de l'incontinence urinaire dépend de sa cause. Les options incluent :<br>
• Des exercices de rééducation du périnée (renforcer les muscles du plancher pelvien).<br>
• Des médicaments pour réduire les envies pressantes ou améliorer la capacité de la vessie.<br>
• Des dispositifs médicaux comme des pessaires ou des cathéters.<br>
• Dans certains cas, une intervention chirurgicale, comme l'implantation de bandelettes sous-urétrales.<br>
Votre urologue pourra vous recommander le traitement le plus adapté à votre situation`
            },
            {
                question: "Le cancer de la prostate est-il fréquent ?",
                answer: `Le cancer de la prostate est le cancer le plus courant chez les hommes, surtout après 50 ans. Il évolue souvent lentement et peut être asymptomatique au début. Des tests de dépistage comme le dosage du PSA (antigène prostatique spécifique) et un toucher rectal sont recommandés pour détecter les anomalies. Si vous avez un antécédent familial de cancer de la prostate, il est recommandé de commencer les bilans de dépistage plus tôt.`
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