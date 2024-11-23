<div class="response-message">
    <?php if (isset($_COOKIE['favoris_message'])): ?>
        <div class="alert alert-success" id="message-container">
            <?= htmlspecialchars($_COOKIE['favoris_message']) ?>
            <button type="button" class="close-button">X</button>
        </div>
        <?php
        // Supprimer le cookie après affichage
        setcookie('favoris_message', '', time() - 3600, '/');
        ?>
    <?php endif; ?>
</div>
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
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($movie['id']) ?>">
                    <input type="hidden" name="type" value="<?= htmlspecialchars($movie['type']) ?>">
                    <button name="favoris" type="submit" class="btn btn-warning">Ajouter au favoris</button>
                </form>
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
                    <a href="<?= URL ?>details?id=<?= (int)$serie['id'] ?>&type=<?= htmlspecialchars($serie['type']) ?>">
                        <img class="img_movie" src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($serie['poster_path']) ?>" alt="<?= htmlspecialchars($serie['name']) ?>">
                        <div class="hover-text">
                            <h3 class="title_name"><?= htmlspecialchars($serie['name']) ?></h3>
                            <p class="note">Note : <?= htmlspecialchars($serie['vote_average']) ?>/10</p>
                            <p class="note">Genres : <?= htmlspecialchars(implode(', ', $serie['genres'])) ?></p>
                        </div>
                    </a>
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= (int)$serie['id'] ?>">
                        <input type="hidden" name="type" value="<?= htmlspecialchars($serie['type']) ?>">
                        <button name="favoris" type="submit" class="btn btn-warning">Ajouter au favoris</button>
                    </form>

                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-btn carousel-btn-left">&#10094;</button>
        <button class="carousel-btn carousel-btn-right">&#10095;</button>
    </div>
<?php endif; ?>