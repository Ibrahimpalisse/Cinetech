<!-- Affichage du fond d'écran en arrière-plan -->
<section
    class="container" 
    style="background-image: url('https://image.tmdb.org/t/p/w1280<?= htmlspecialchars($details['backdrop_path'] ?? 'Non disponible') ?>');">
    
    <!-- Contenu principal -->
    <div class="movie-details">
        <img class="img_movie" src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($details['poster_path']) ?>" alt="<?= htmlspecialchars($details['title'] ?? 'Image non disponible') ?>">
        <h1><?= htmlspecialchars($details['title'] ?? 'Titre non disponible') ?></h1>
        <p><strong>Résumé :</strong> <?= htmlspecialchars($details['overview'] ?? 'Résumé non disponible') ?></p>
        <div class="movie-stats">
            <span><strong>Note :</strong> <?= htmlspecialchars($details['vote_average'] ?? 'Non noté') ?>/10</span>
            <span><strong>Durée :</strong> <?= htmlspecialchars($details['runtime'] ?? 'Non disponible') ?> minutes</span>
            <button class="btn btn-warning">ajouter aux favoris</button>
        </div>
    </div>
</section>
    <!-- Genres -->
    <h2 class="actors-title">Genres</h2>
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
    <h2 class="actors-title">Production</h2>
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
    <h2 class="actors-title">Acteurs Principaux</h2>
    <?php if (!empty($actors)): ?>
        <div class="actors-container">
            <?php foreach ($actors as $actor): ?>
                <div class="actor-card">
                    <?php if (!empty($actor['profile_path'])): ?>
                        <img 
                            src="https://image.tmdb.org/t/p/w185<?= htmlspecialchars($actor['profile_path']) ?>" 
                            alt="<?= htmlspecialchars($actor['name']) ?>" 
                            class="actor-image">
                    <?php else: ?>
                        <img 
                            src="<?= URL ?>assets/images/default-actor.jpg" 
                            alt="Image non disponible" 
                            class="actor-image">
                    <?php endif; ?>
                    <p><strong><?= htmlspecialchars($actor['name']) ?></strong></p>
                    <p>Rôle : <?= htmlspecialchars($actor['character'] ?? 'Non spécifié') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun acteur trouvé pour ce film.</p>
    <?php endif; ?>

    <!-- Vidéos -->
    <h2>Vidéos</h2>
    <?php if (!empty($videos)): ?>
        <div class="videos-container">
            <?php foreach ($videos as $video): ?>
                <div class="video">
                    <iframe 
                        width="560" 
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
</main>
