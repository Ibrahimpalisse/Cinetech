<?php
function getGenreNames($genreIds, $allGenres) {
    $genreNames = [];
    foreach ($genreIds as $genreId) {
        foreach ($allGenres as $genre) {
            if ($genre['id'] == $genreId) {
                $genreNames[] = $genre['name'];
            }
        }
    }
    return $genreNames;
}

?>
<?php foreach ($genres as $genre) {
    if ($genre['id'] == $selected_genre) {
        echo '<h2 class="title_movie text-center">Genres/' . htmlspecialchars($genre['name']). '</h2>';
        break;
    }
} ?>

<div class="d-flex justify-content-center mt-4">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Genres
        </button>
        <ul class="dropdown-menu">
            <?php foreach ($genres as $genre): ?>
                <li>
                    <a class="dropdown-item <?= $selected_genre == $genre['id'] ? 'active' : '' ?>" 
                       href="?genre=<?= htmlspecialchars($genre['id']) ?>">
                       <?= htmlspecialchars($genre['name']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

  <div class="cadr">      
    <?php if (!empty($series)): ?>
            <?php foreach ($series as $serie): ?>
                <div class="card_movie"> <!-- Changement de class ici -->
                    <!-- Affiche l'image -->
                    <a href="<?= URL ?>details?id=<?= (int)$serie['id'] ?>&type=tv">
                        <img 
                            src="https://image.tmdb.org/t/p/w300<?= htmlspecialchars($serie['poster_path'] ?? 'aucune image disponible') ?>" 
                            alt="<?= htmlspecialchars($serie['name'] ?? 'Image non disponible') ?>" 
                            class="img_movie">
                    </a>
                    
                    <!-- Affiche le titre -->
                    <h3 class="title_name"><?= htmlspecialchars($serie['name'] ?? 'Titre inconnu') ?></h3>
                    
                    <!-- Affiche la note -->
                    <p class="note">Note : <?= htmlspecialchars($serie['vote_average'] ?? 'Non noté') ?>/10</p>
                   
                    <!-- Affiche les genres -->
                    <p class="note">
                        Genres : 
                        <?php 
                            $genreNames = getGenreNames($serie['genre_ids'], $genres); // Conversion des genre_ids en noms
                            echo htmlspecialchars(implode(', ', $genreNames)); // Affiche les genres séparés par des virgules
                        ?>
                    </p>
                    <button class="btn btn-warning">ajouter aux favoris</button>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucune série trouvée pour ce genre.</p>
    <?php endif; ?>
</div>
<?php if (!empty($pagination)): ?>

<div class="btn-toolbar mb-3 p-3" role="toolbar" aria-label="Toolbar with button groups">

    <div class="btn-group me-3" role="group" aria-label="Pagination">
        <?php for ($i = 1; $i <= min($pagination['total_pages'], 6); $i++): ?>
            <a href="?genre=<?= $selected_genre ?>&page=<?= $i ?>" 
               class="btn btn-outline-secondary <?= $i == $pagination['current_page'] ? 'active' : '' ?> me-2">
               <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

    <div class="input-group ms-auto p-1">
        <form method="get" action="" class="d-flex">
            <input type="hidden" name="genre" value="<?= $selected_genre ?>">
            <div class="input-group-text me-3" id="btnGroupAddon">Page</div>
            <input type="number" name="page" class="form-control me-3" placeholder="Numéro de page" 
                   min="1" max="<?= $pagination['total_pages'] ?>" 
                   value="<?= $pagination['current_page'] ?>" aria-describedby="btnGroupAddon">
            <button type="submit" class="btn btn-primary">Taper</button>
        </form>
    </div>

</div>

<?php endif;?>