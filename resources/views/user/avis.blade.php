
<?php
$testimonials = [
    [
        'id' => 1,
        'rating' => "★ ★ ★ ★ ★",
        'text' => "L’établissement hospitalier Hasnaoui offre une expérience médicale de qualité grâce à sa propreté, son personnel attentif et ses délais d’attente raisonnables.",
        'name' => "Samy Ouis",
    ],
    [
        'id' => 2,
        'rating' => "★ ★ ★ ★ ★",
        'text' => "Bonne continuation c’est un plus pour ouest machaallah",
        'name' => "Hichem",
    ],
    [
        'id' => 3,
        'rating' => "★ ★ ★ ★ ★",
        'text' => "Une Famille, un Groupe et une Algérie moderne Félicitations et bonne continuation",
        'name' => "Abdelhak",
    ],
    [
        'id' => 4,
        'rating' => "★ ★ ★ ★ ★",
        'text' => "Un plus pour notre ville. Des médecins engagés et un accueil à la hauteur.",
        'name' => "Redouane Bousmaha",
    ],
];
?>

<style>
    .containerr {
height:400px;
max-width: 1200px; margin: 0 auto;
    }
</style>

    <div class="testimonials-container text-white">
        <div class="containerr py-5">
            <div class="row">
                <!-- Left Section -->
                <div class="col-12 col-md-4 text-center text-md-start mb-4 mb-md-0">
                    <h6 class="text-primary">Témoignages</h6>
                    <h2 class="fw-bold">Ce que disent les gens</h2>
                    <p>Nous nous engageons à fournir des soins de qualité, en veillant au bien-être et à la satisfaction de nos patients.</p>
                    <hr class="w-100" style="height: 1px; background-color: white ; border: none;" />
                    <div class="happy-patients mt-4 d-flex justify-content-center justify-content-md-start align-items-center gap-3">
                        
                        <i style="color:white; font-size: 3em; "class="fas fa-face-smile"></i>
                        <div>
                            <h3 class="text-info fw-bold">+85%</h3>
                            <p>Patients Satisfaits </p>
                        </div>
                    </div>
                </div>

                <!-- Right Section - Testimonials -->
                <div class="col-12 col-md-8">
                    <div class="testimonial-slide d-flex flex-column flex-md-row gap-4 justify-content-center" id="testimonial-slide">
                        <!-- Testimonials will be populated by JavaScript -->
                    </div>
                    <div class="d-flex justify-content-center mt-3" id="indicators">
                        <?php foreach ($testimonials as $index => $testimonial): ?>
                            <span class="indicator" data-slide="<?php echo $index; ?>"></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const testimonials = <?php echo json_encode($testimonials); ?>;
    let currentSlide = 0;

    function renderTestimonials() {
        const slideContainer = document.getElementById('testimonial-slide');
        const isMobile = window.innerWidth <= 576;

        if (isMobile) {
            // Render only one testimonial on mobile
            slideContainer.innerHTML = `
                <div class="testimonial-card p-4 flex-grow-1">
                    <div class="rating mb-3">${testimonials[currentSlide].rating}</div>
                    <p>${testimonials[currentSlide].text}</p>
                    <div class="user-info d-flex align-items-center mt-4">
                        <div class="user-initials me-3">${testimonials[currentSlide].name.charAt(0)}</div>
                        <div>
                            <h6 class="mb-0 text-info fw-bold">${testimonials[currentSlide].name}</h6>
                        </div>
                    </div>
                </div>
            `;
        } else {
            // Render two testimonials on larger screens
            slideContainer.innerHTML = `
                <div class="testimonial-card p-4 flex-grow-1">
                    <div class="rating mb-3">${testimonials[currentSlide].rating}</div>
                    <p>${testimonials[currentSlide].text}</p>
                    <div class="user-info d-flex align-items-center mt-4">
                        <div class="user-initials me-3">${testimonials[currentSlide].name.charAt(0)}</div>
                        <div>
                            <h6 class="mb-0 text-info fw-bold">${testimonials[currentSlide].name}</h6>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card p-4 flex-grow-1">
                    <div class="rating mb-3">${testimonials[(currentSlide + 1) % testimonials.length].rating}</div>
                    <p>${testimonials[(currentSlide + 1) % testimonials.length].text}</p>
                    <div class="user-info d-flex align-items-center mt-4">
                        <div class="user-initials me-3">${testimonials[(currentSlide + 1) % testimonials.length].name.charAt(0)}</div>
                        <div>
                            <h6 class="mb-0 text-info fw-bold">${testimonials[(currentSlide + 1) % testimonials.length].name}</h6>
                        </div>
                    </div>
                </div>
            `;
        }
        updateIndicators();
    }

    function updateIndicators() {
        document.querySelectorAll('.indicator').forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentSlide);
        });
    }

    // Initial render
    renderTestimonials();

    // Auto-slide every 5 seconds
    setInterval(() => {
        currentSlide = (currentSlide + 1) % testimonials.length;
        renderTestimonials();
    }, 5000);

    // Manual slide on indicator click
    document.querySelectorAll('.indicator').forEach(indicator => {
        indicator.addEventListener('click', () => {
            currentSlide = parseInt(indicator.getAttribute('data-slide'));
            renderTestimonials();
        });
    });

    // Re-render on window resize to handle dynamic screen size changes
    window.addEventListener('resize', renderTestimonials);
</script>
