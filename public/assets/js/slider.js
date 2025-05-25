document.addEventListener('DOMContentLoaded', () => {
  // Hero Carousel
  const heroSlider = new Swiper('.hero-slider', {
      loop: true,
      speed: 1500,
      slidesPerView: 1,
      spaceBetween: 0,
      autoplay: {
          delay: 4500,
          disableOnInteraction: false,
      },
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      },
  });

  // Qualite Carousel
  const qualiteSlider = new Swiper('.qualite-slider', {
      loop: true,
      speed: 1500,
      slidesPerView: 2,
      spaceBetween: 20,
      autoplay: {
          delay: 4500,
          disableOnInteraction: false,
      },
      navigation: {
          nextEl: '.qualite-next',
          prevEl: '.qualite-prev',
      },
      pagination: {
          el: '.swiper-pagination',
          clickable: true,
      },
      breakpoints: {
          900: { slidesPerView: 2, spaceBetween: 20 },
          768: { slidesPerView: 1, spaceBetween: 10 },
          480: { slidesPerView: 1, spaceBetween: 10 },
          300: { slidesPerView: 1, spaceBetween: 10 },
      },
  });
});