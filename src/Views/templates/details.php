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

<!-- Styles -->
<style>
    .videos-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .video {
        flex: 1 1 calc(33.333% - 20px);
        max-width: calc(33.333% - 20px);
        box-sizing: border-box;
    }
    .video iframe {
        width: 100%;
        height: auto;
    }
    .video p {
        text-align: center;
        font-size: 1rem;
        margin-top: 10px;
    }
    .type-label {
        font-size: 1.2rem;
        color: #fff;
        background-color: #ff9800;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
        margin-bottom: 20px;
    }
    @media (max-width: 768px) {
        .video {
            flex: 1 1 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }
    @media (max-width: 480px) {
        .video {
            flex: 1 1 100%;
            max-width: 100%;
        }
    }
</style>
