
<?php if (isset($movies) && is_array($movies)): ?>
<h1 class="title_movie">Films Populaires</h1>
<div class="carousel">
    <div class="carousel-track">
        <?php foreach ($movies as $movie): ?>
            <div class="card_movie">
                <a href="<?= URL ?>details?id=<?= (int)$movie['id'] ?>&type=<?= htmlspecialchars($movie['type']) ?>">
                    <img class="img_movie" src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                    <div class="hover-text">
                        <h2 class="title_name"><?= htmlspecialchars($movie['title']) ?></h2>
                        <p class="note">Note : <?= htmlspecialchars($movie['vote_average']) ?>/10</p>
                        <p class="note">Genres : <?= htmlspecialchars(implode(', ', $movie['genres'])) ?></p>
                    </div>
                </a>
                <button type="button" class="btn btn-warning add-to-favorites" data-id="<?= htmlspecialchars($movie['id']) ?>" data-type="<?= htmlspecialchars($movie['type']) ?>">
                       Ajouter au favoris
                 </button>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-btn carousel-btn-left">&#10094;</button>
    <button class="carousel-btn carousel-btn-right">&#10095;</button>
</div>
<?php endif; ?>


<?php if (isset($tvs) && is_array($tvs)): ?>
    <h1 class="title_movie">Séries Populaires</h1>
    <div class="carousel">
        <div class="carousel-track">
            <?php foreach ($tvs as $serie): ?>
                <div class="card_movie">
                    <a href="<?= URL ?>details?id=<?= (int)$serie['id'] ?>&type=<?= htmlspecialchars($serie['type']) ?>">
                        <img class="img_movie" src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($serie['poster_path']) ?>" alt="<?= htmlspecialchars($serie['name']) ?>">
                        <div class="hover-text">
                            <h3 class="title_name"><?= htmlspecialchars($serie['name']) ?></h3>
                            <p class="note">Note : <?= htmlspecialchars($serie['vote_average']) ?>/10</p>
                            <p class="note">Genres : <?= htmlspecialchars(implode(', ', $serie['genres'])) ?></p>
                        </div>
                    </a>
                    <button type="button" class="btn btn-warning add-to-favorites" data-id="<?= htmlspecialchars($serie['id']) ?>" data-type="<?= htmlspecialchars($serie['type']) ?>">
                            Ajouter au favoris
                    </button>

                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-btn carousel-btn-left">&#10094;</button>
        <button class="carousel-btn carousel-btn-right">&#10095;</button>
    </div>
<?php endif; ?>