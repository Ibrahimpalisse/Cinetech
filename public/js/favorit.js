document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-to-favorites').forEach(function (button) {
        button.addEventListener('click', function () {
            const mediaId = this.getAttribute('data-id');
            const mediaType = this.getAttribute('data-type');

            const url = `http://localhost/cinetech/favoris?id=${mediaId}&type=${mediaType}`;

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur réseau : ${response.status} - ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                const modalBody = document.getElementById('messageModalBody');
                modalBody.textContent = data.message;

                const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                messageModal.show();
            })
            .catch(error => {
                console.error('Erreur lors de l\'ajout aux favoris :', error);

                const modalBody = document.getElementById('messageModalBody');
                modalBody.textContent = 'Une erreur est survenue lors de l’ajout aux favoris. Veuillez réessayer.';

                const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                messageModal.show();
            });
        });
    });
});
