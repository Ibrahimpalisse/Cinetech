<!-- Affichage du fond d'écran en arrière-plan -->
<main 
    class="container" 
    style="background-image: url('https://image.tmdb.org/t/p/w1280<?= htmlspecialchars($details['backdrop_path'] ?? '') ?>');">
    

        <img 
            src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($details['poster_path'] ?? '') ?>" 
            alt="<?= htmlspecialchars($details['title'] ?? 'Affiche non disponible') ?>" 
            style="border-radius: 10px; max-width: 100%; height: auto;">
 

    <!-- Titre et autres informations -->
    <h1><?= htmlspecialchars($details['title'] ?? 'Titre non disponible') ?></h1>
    <p><strong>Date de sortie :</strong> <?= htmlspecialchars($details['release_date'] ?? 'Non disponible') ?></p>
    <p><strong>Résumé :</strong> <?= htmlspecialchars($details['overview'] ?? 'Résumé non disponible') ?></p>
    <p><strong>Note moyenne :</strong> <?= htmlspecialchars($details['vote_average'] ?? 'Non noté') ?>/10</p>
    <p><strong>Durée :</strong> <?= htmlspecialchars($details['runtime'] ?? 'Non disponible') ?> minutes</p>

    <!-- Genres -->
    <h2>Genres</h2>
    <ul>
        <?php if (!empty($details['genres'])): ?>
            <?php foreach ($details['genres'] as $genre): ?>
                <li><?= htmlspecialchars($genre['name']) ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucun genre disponible.</li>
        <?php endif; ?>
    </ul>

    <!-- Réalisateurs -->
    <h2>Réalisateur(s)</h2>
    <ul>
        <?php if (!empty($crew)): ?>
            <?php foreach ($crew as $member): ?>
                <?php if ($member['job'] === 'Director'): ?>
                    <li><?= htmlspecialchars($member['name']) ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucun réalisateur trouvé pour ce film.</li>
        <?php endif; ?>
    </ul>

    <!-- Production -->
    <h2>Production</h2>
    <ul>
        <?php if (!empty($details['production_companies'])): ?>
            <?php foreach ($details['production_companies'] as $company): ?>
                <li>
                    <strong><?= htmlspecialchars($company['name']) ?></strong>
                    (<?= htmlspecialchars($company['origin_country'] ?? 'Pays inconnu') ?>)
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucune information sur la production.</li>
        <?php endif; ?>
    </ul>

    <!-- Acteurs -->
    <h2>Acteurs Principaux</h2>
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
