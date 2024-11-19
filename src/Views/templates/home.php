<?php 

    if (isset($movies) && is_array($movies)): ?>
        <h1 class="title_movie">Films Populaires</h1>
        <div class="cadr">
            <?php foreach ($movies as $movie): ?>
                <div class="card_movie">
                <a href="<?= URL ?>details?id=<?= (int)$movie['id']?>&type=movie">
                        <img class="img_movie" src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                    </a>
                    <h2 class="title_name"><?= htmlspecialchars($movie['title']) ?></h2>
                    <p class="note">Note : <?= htmlspecialchars($movie['vote_average']) ?></p>
                      
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-bookmark-fill list-icon" viewBox="0 0 16 16">
                           <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill favoris-icon" viewBox="0 0 16 16">
                           <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                        </svg>  
              </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($tvs) && is_array($tvs)): ?>
        <h1 class="title_movie">Séries Populaires</h1>
        <div class="cadr">
            <?php foreach ($tvs as $serie): ?>
                <div class="card_movie">
                <a href="<?= URL ?>details?id=<?= (int)$serie['id'] ?>&type=tv">                        <img class="img_movie" src="https://image.tmdb.org/t/p/w500<?= htmlspecialchars($serie['poster_path']) ?>" alt="<?= htmlspecialchars($serie['name']) ?>">
                    </a>
                    <h2 class="title_name"><?= htmlspecialchars($serie['name']) ?></h2>
                    <p class="note">Note : <?= htmlspecialchars($serie['vote_average']) ?></p>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-bookmark-fill list-icon" viewBox="0 0 16 16">
                           <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill favoris-icon" viewBox="0 0 16 16">
                           <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                        </svg>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

