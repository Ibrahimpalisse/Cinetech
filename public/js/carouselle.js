/**
 * Fonction pour déplacer le carrousel horizontalement
 * @param {string} carouselId - L'identifiant du carrousel à déplacer
 * @param {number} direction - La direction du mouvement (-1 pour gauche, 1 pour droite)
 */
function moveCarousel(carouselId, direction) {
    // Récupérer le conteneur du carrousel par son ID
    const carousel = document.getElementById(carouselId);
    if (!carousel) {
        console.error(`Carousel with ID "${carouselId}" not found.`);
        return;
    }

    // Récupérer l'intérieur du carrousel
    const carouselInner = carousel.querySelector('.carousel_inner');
    if (!carouselInner) {
        console.error(`Carousel inner not found for carousel ID "${carouselId}".`);
        return;
    }

    // Calculer la largeur d'une carte (inclure la marge entre les cartes)
    const card = carouselInner.querySelector('.card_movie');
    if (!card) {
        console.error(`No cards found in carousel with ID "${carouselId}".`);
        return;
    }

    const cardWidth = card.offsetWidth + 16; // Largeur de la carte + marge (ajustez en fonction de votre CSS)

    // Position actuelle de défilement
    const currentScroll = carouselInner.scrollLeft;

    // Calculer la nouvelle position de défilement
    const newScrollPosition = currentScroll + direction * cardWidth;

    // Appliquer le défilement
    carouselInner.scrollTo({
        left: newScrollPosition,
        behavior: 'smooth',
    });

    // Logs pour débogage (optionnels)
    console.log(`Carousel ID: ${carouselId}`);
    console.log(`Direction: ${direction}`);
    console.log(`Card width: ${cardWidth}`);
    console.log(`Current scroll position: ${currentScroll}`);
    console.log(`New scroll position: ${newScrollPosition}`);
}
