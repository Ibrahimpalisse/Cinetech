const carousels = document.querySelectorAll('.carousel');

carousels.forEach((carousel) => {
    const track = carousel.querySelector('.carousel-track');
    const slides = Array.from(track.children);
    const nextButton = carousel.querySelector('.carousel-btn-right');
    const prevButton = carousel.querySelector('.carousel-btn-left');
    let currentIndex = 0;

    // Mise à jour du carrousel
    const updateCarousel = () => {
        const slideWidth = slides[0].getBoundingClientRect().width;
        track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
    };

    // Bouton suivant
    nextButton.addEventListener('click', () => {
        if (currentIndex < slides.length - 1) {
            currentIndex++;
            updateCarousel();
        }
    });

    // Bouton précédent
    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });

    // Ajustement dynamique à la taille de l'écran
    window.addEventListener('resize', () => {
        updateCarousel();
    });

    updateCarousel();
});
