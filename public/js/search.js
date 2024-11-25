document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value.trim();

    if (query.length > 2) {
        const resultsContainer = document.getElementById('searchResults');
        resultsContainer.innerHTML = '<div>Recherche en cours...</div>';
        resultsContainer.style.display = 'block';

        fetch(`http://localhost/cinetech/search?q=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur HTTP : ${response.status}`);
                }
                return response.json();
            })
            .then(results => {
                resultsContainer.innerHTML = ''; // Réinitialise les résultats précédents

                if (Array.isArray(results) && results.length > 0) {
                    results.forEach(item => {
                        const resultElement = document.createElement('div');
                        resultElement.className = 'search-result';

                        // Ajouter un contenu formaté
                        const image = item.poster_path
                            ? `<img src="https://image.tmdb.org/t/p/w92${item.poster_path}" alt="${item.name || item.title}" class="result-image">`
                            : `<img src="https://via.placeholder.com/92x138" alt="Pas d'image disponible" class="result-image">`;

                        const title = item.name || item.title || 'Titre inconnu';
                        const description = item.overview ? item.overview.substring(0, 100) + '...' : 'Aucune description disponible.';

                        resultElement.innerHTML = `
                            <div class="result-item">
                                ${image}
                                <div class="">
                                    <h5 class="title_name">${title}</h5>
                                </div>
                            </div>
                        `;

                        // Redirection vers la page des détails
                        resultElement.addEventListener('click', () => {
                            window.location.href = `http://localhost/cinetech/details?id=${item.id}&type=${item.media_type}`;
                        });

                        resultsContainer.appendChild(resultElement);
                    });
                } else {
                    resultsContainer.innerHTML = '<div>Aucun résultat trouvé.</div>';
                }
            })
            .catch(error => {
                console.error('Erreur lors de la recherche :', error);
                resultsContainer.innerHTML = '<div>Erreur lors de la recherche.</div>';
            });
    } else {
        const resultsContainer = document.getElementById('searchResults');
        resultsContainer.style.display = 'none';
    }
});
