<!-- Modal -->
<!-- Modal -->
<section class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="messageModalBody">
                <!-- Le message sera inséré ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</section>


<!-- Section principale -->
<section class="container" style="background-image: url('https://image.tmdb.org/t/p/w1280<?= htmlspecialchars($details['backdrop_path'] ?? 'Non disponible') ?>');">
    <div class="movie-details">
        <img class="img_movie" src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($details['poster_path']) ?>" alt="<?= htmlspecialchars($details['title'] ?? 'Image non disponible') ?>">
        <h1><?= htmlspecialchars($details['title'] ?? 'Titre non disponible') ?></h1>
        <p><strong>Résumé :</strong> <?= htmlspecialchars($details['overview'] ?? 'Résumé non disponible') ?></p>
        <div class="movie-stats">
            <span><strong>Note :</strong> <?= htmlspecialchars($details['vote_average'] ?? 'Non noté') ?>/10</span>
            <span><strong>Durée :</strong> <?= htmlspecialchars($details['runtime'] ?? 'Non disponible') ?> minutes</span>
            <span><strong>Date de sortie :</strong> <?= htmlspecialchars($details['release_date'] ?? 'Date inconnue') ?></span>
            <span><strong>Langue originale :</strong> <?= htmlspecialchars($details['original_language'] ?? 'Non disponible') ?></span>
                <button type="button" class="btn btn-warning add-to-favorites" data-id="<?= htmlspecialchars($details['id']) ?>" data-type="<?= htmlspecialchars($type) ?>">
                    Ajouter aux favoris
                </button>
    
        </div>
    </div>
</section>

<!-- Genres -->
<h1 class="actors-title">Genres</h1>
<ul class="genres-list">
    <?php if (!empty($details['genres'])): ?>
        <?php foreach ($details['genres'] as $genre): ?>
            <li class="genre-item"><?= htmlspecialchars($genre['name']) ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Aucun genre disponible.</li>
    <?php endif; ?>
</ul>

<!-- Réalisateurs -->
<h2 class="actors-title">Réalisateur(s)</h2>
<ul class="genres-list">
    <?php if (!empty($crew)): ?>
        <?php foreach ($crew as $member): ?>
            <?php if ($member['job'] === 'Director'): ?>
                <li class="genre-item"><?= htmlspecialchars($member['name']) ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Aucun réalisateur trouvé pour ce film.</li>
    <?php endif; ?>
</ul>

<!-- Production -->
<h3 class="actors-title">Production</h3>
<ul class="genres-list">
    <?php if (!empty($details['production_companies'])): ?>
        <?php foreach ($details['production_companies'] as $company): ?>
            <li class="genre-item">
                <strong><?= htmlspecialchars($company['name']) ?></strong>
                (<?= htmlspecialchars($company['origin_country'] ?? 'Pays inconnu') ?>)
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>Aucune information sur la production.</li>
    <?php endif; ?>
</ul>

<!-- Acteurs -->
<h4 class="actors-title">Acteurs Principaux</h4>
<?php if (!empty($actors)): ?>
    <div class="actors-container">
        <?php foreach ($actors as $actor): ?>
            <div class="actor-card">
                <img 
                    src="<?= !empty($actor['profile_path']) ? 'https://image.tmdb.org/t/p/w185' . htmlspecialchars($actor['profile_path']) : URL . 'assets/images/default-actor.jpg' ?>" 
                    alt="<?= htmlspecialchars($actor['name']) ?>" 
                    class="actor-image">
                <p><strong><?= htmlspecialchars($actor['name']) ?></strong></p>
                <p>Rôle : <?= htmlspecialchars($actor['character'] ?? 'Non spécifié') ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun acteur trouvé pour ce film.</p>
<?php endif; ?>

<!-- Vidéos -->
<h5 class="actors-title">Vidéos</h5>
<?php if (!empty($videos)): ?>
    <div class="videos-container">
        <?php foreach ($videos as $video): ?>
            <div class="video">
                <iframe 
                    width="100%" 
                    height="315" 
                    src="https://www.youtube.com/embed/<?= htmlspecialchars($video['key']) ?>" 
                    frameborder="0" 
                    allowfullscreen>
                </iframe>
                <p><?= htmlspecialchars($video['name'] ?? 'Vidéo') ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucune vidéo disponible pour ce film.</p>
<?php endif; ?>
<!-- Formulaire supplémentaire -->
<div class="form-container">
    <div class="form-group">
        <label for="commentTextarea"><h6 class="actors-title">Ajouter un commentaire</h6></label>
        <textarea class="form-control" id="commentTextarea" rows="3"></textarea>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary mt-3" id="sendButton">Envoyer</button>
    </div>
    <p class="comments">
        
    </p>
</div>
<script>
 
  document.addEventListener('DOMContentLoaded', function() {
        const commentsContainer = document.querySelector('.comments');
        const comments = <?= json_encode($comments ?? []) ?>;

        if (comments.length > 0) {
            comments.forEach(comment => {
                const commentElement = document.createElement('div');
                commentElement.innerHTML = `
                    <p><strong class="nom_auteur">${comment.username} :</strong></p>
                    <p>${comment.comment_text}</p>
                  <small class="date">Posté le : ${new Date(comment.added_at).toLocaleString()}</small>

                `;
                commentsContainer.appendChild(commentElement);
            });
        } else {
            commentsContainer.innerHTML = '<p>Aucun commentaire disponible pour ce média.</p>';
        }
    });
document.getElementById('sendButton').addEventListener('click', function() {
    const commentText = document.getElementById('commentTextarea').value.trim();
    const mediaId = <?= json_encode($details['id']) ?>; // Assurez-vous que $details['id'] est défini côté serveur

    if (commentText === '') {
        displayMessage('Le commentaire ne peut pas être vide.');
        return;
    }

    const data = {
        media_id: mediaId,
        comment_text: commentText
    };

    fetch('http://localhost/cinetech/commentaire', { // Remplacez '/votre-endpoint' par l'URL de votre contrôleur qui gère les commentaires
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Une erreur est survenue lors de l\'envoi du commentaire.');
        }
        return response.json();
    })
    .then(result => {
        if (result.success) {
         //   displayMessage('Votre commentaire a été ajouté avec succès.');
            document.getElementById('commentTextarea').value = ''; // Réinitialise le champ de texte
        } else {
            displayMessage(result.message || 'Une erreur est survenue.');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        displayMessage('Une erreur est survenue lors de l\'envoi du commentaire.');
    });
});

function displayMessage(message) {
    const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
    document.getElementById('messageModalBody').textContent = message;
    messageModal.show();
}


</script>
