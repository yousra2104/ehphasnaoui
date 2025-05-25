<div class="visite-sections">
    <style>
        .scroll-arrow {
            position: fixed;
            bottom: 100px;
            font-size: 2rem;
            color: #23B6EA; /* Blue color, adjust as needed */
            cursor: pointer;
            z-index: 10;
            animation: bounce 2s infinite;
            transition: opacity 0.3s;
        }
        .scroll-arrow.hidden {
            opacity: 0;
            pointer-events: none;
        }
        .scroll-arrow.left {
            left: 40px;
        }
        .scroll-arrow.right {
            right: 40px;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        .section-container {
            margin-bottom: 40px; /* Space for sections */
            text-align: center;
        }

        img{text-align:center;}
        .visite {
            height: 500px; /* Adjust iframe height as needed */
        }
        @media (max-width: 768px) {
            .scroll-arrow {
                font-size: 1.5rem;
                bottom: 10px;
            }
            .scroll-arrow.left {
                left: 10px;
            }
            .scroll-arrow.right {
                right: 10px;
            }
        }
    </style>

    <div class="section-container">
        <div class="section-title mt-4">
            <h2>Accueil, les urgences, consultation, laboratoire, pharmacie:</h2>
          <center>  <img src="../assets/img/section-img.png"  alt="#" /></center>
        </div>
        <div class="container">
            <iframe width="100%" class="visite" src='https://panoraven.com/fr/embed/0Vjc3YcYoF' frameborder='0' allowfullscreen allow='xr-spatial-tracking'></iframe>
        </div>
    </div>

    <div class="section-container">
        <div class="section-title mt-4">
            <h2>Imagerie :</h2>
            <center><img src="../assets/img/section-img.png" alt="#" /></center>
        </div>
        <div class="container">
            <iframe width="100%" class="visite" src='https://panoraven.com/fr/embed/AzriZMYDOq' frameborder='0' allowfullscreen allow='xr-spatial-tracking'></iframe>
        </div>
    </div>

    <div class="section-container">
        <div class="section-title mt-4">
            <h2>Hébergement :</h2>
           <center><img src="../assets/img/section-img.png" alt="#" /></center> 
        </div>
        <div class="container">
            <iframe width="100%" class="visite" src='https://panoraven.com/fr/embed/dROBrY5FgR' frameborder='0' allowfullscreen allow='xr-spatial-tracking'></iframe>
        </div>
    </div>

    <div class="section-container">
        <div class="section-title mt-4">
            <h2>Salle hybride :</h2>
            <center><img src="../assets/img/section-img.png" alt="#" /></center>
        </div>
        <div class="container">
            <iframe width="100%" class="visite" src='https://panoraven.com/fr/embed/J2RWEELIVM' frameborder='0' allowfullscreen allow='xr-spatial-tracking'></iframe>
        </div>
    </div>

    <div class="section-container">
        <div class="section-title mt-4">
            <h2>Bloc opératoires, salle réveil :</h2>
            <center><img src="../assets/img/section-img.png" alt="#" /></center>
        </div>
        <div class="container">
            <iframe width="100%" class="visite" src='https://panoraven.com/fr/embed/T7Fn3wltB7' frameborder='0' allowfullscreen allow='xr-spatial-tracking'></iframe>
        </div>
    </div>

    <!-- Scroll arrows placed before the last container -->
    <i class="fas fa-chevron-down scroll-arrow left"></i>
    <i class="fas fa-chevron-down scroll-arrow right"></i>

    <div class="section-container" id="last-section">
        <div class="section-title mt-4">
            <h2>Chambre VIP, stérilisation, administration :</h2>
           <center><img src="../assets/img/section-img.png" alt="#" /></center> 
        </div>
        <div class="container">
            <iframe width="100%" class="visite" src='https://panoraven.com/fr/embed/8mBa9kZMaJ' frameborder='0' allowfullscreen allow='xr-spatial-tracking'></iframe>
        </div>
    </div>
</div>

<script>
    // Update arrow direction and behavior based on scroll position
    window.addEventListener('scroll', function() {
        const leftArrow = document.querySelector('.scroll-arrow.left');
        const rightArrow = document.querySelector('.scroll-arrow.right');
        const lastSection = document.getElementById('last-section');
        const lastSectionTop = lastSection.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if (lastSectionTop < windowHeight) {
            // Last section is in view: show upward arrows and set scroll to top
            leftArrow.classList.remove('fa-chevron-down', 'hidden');
            rightArrow.classList.remove('fa-chevron-down', 'hidden');
            leftArrow.classList.add('fa-chevron-up');
            rightArrow.classList.add('fa-chevron-up');
            leftArrow.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
            rightArrow.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            // Not at last section: show downward arrows and set scroll down
            leftArrow.classList.remove('fa-chevron-up', 'hidden');
            rightArrow.classList.remove('fa-chevron-up', 'hidden');
            leftArrow.classList.add('fa-chevron-down');
            rightArrow.classList.add('fa-chevron-down');
            leftArrow.onclick = () => window.scrollBy(0, window.innerHeight);
            rightArrow.onclick = () => window.scrollBy(0, window.innerHeight);
        }
    });

    // Trigger scroll event on load to set initial arrow visibility and direction
    window.dispatchEvent(new Event('scroll'));
</script>