document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper(".mySwiper", {
        watchSlidesProgress: true,
        slidesPerView: 4,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            1200: {
                slidesPerView: 4,
            },
            768: {
                slidesPerView: 3,
            },
            480: {
                slidesPerView: 2,
            },
            0: {
                slidesPerView: 1,
            },
        },
    });
});