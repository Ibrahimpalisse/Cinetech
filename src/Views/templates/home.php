<!-- Films Populaires -->
<?php if (isset($movies) && is_array($movies)): ?>
    <h1 class="title_movie">Films Populaires</h1>
    <div class="carousel">
        <div class="carousel-track">
            <?php foreach ($movies as $movie): ?>
                <div class="card_movie">
                    <a href="<?= URL ?>details?id=<?= (int)$movie['id'] ?>&type=movie">
                        <img class="img_movie" src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                    </a>
                    <h2 class="title_name"><?= htmlspecialchars($movie['title']) ?></h2>
                    <p class="note">Note : <?= htmlspecialchars($movie['vote_average']) ?>/10</p>
                    <p class="note">Genres : <?= htmlspecialchars(implode(', ', $movie['genres'])) ?></p>
                    <button class="btn btn-warning">ajouter aux favoris</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-btn carousel-btn-left">&#10094;</button>
        <button class="carousel-btn carousel-btn-right">&#10095;</button>
    </div>
<?php endif; ?>

<!-- Séries Populaires -->
<?php if (isset($tvs) && is_array($tvs)): ?>
    <h1 class="title_movie">Séries Populaires</h1>
    <div class="carousel">
        <div class="carousel-track">
            <?php foreach ($tvs as $serie): ?>
                <div class="card_movie">
                    <a href="<?= URL ?>details?id=<?= (int)$serie['id'] ?>&type=tv">
                        <img class="img_movie" src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($serie['poster_path']) ?>" alt="<?= htmlspecialchars($serie['name']) ?>">
                    </a>
                    <h2 class="title_name"><?= htmlspecialchars($serie['name']) ?></h2>
                    <p class="note">Note : <?= htmlspecialchars($serie['vote_average']) ?>/10</p>
                    <p class="note">Genres : <?= htmlspecialchars(implode(', ', $serie['genres'])) ?></p>
                    <button class="btn btn-warning">ajouter aux favoris</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-btn carousel-btn-left">&#10094;</button>
        <button class="carousel-btn carousel-btn-right">&#10095;</button>
    </div>
<?php endif; ?>
