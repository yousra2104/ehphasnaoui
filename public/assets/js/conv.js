document.addEventListener('DOMContentLoaded', () => {
    const qualiteSlider = new Swiper('.conv-slider', {
        loop: true,
        speed: 1500,
        slidesPerView: 4,
        spaceBetween: 20,
        autoplay: {
            delay: 4500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.qu-next',
            prevEl: '.qu-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },
        on: {
            init: function () {
                console.log('Swiper initialized successfully!');
            },
        },
    });
});