
<h1 class="title_movie">Vos Favoris</h1>
    <?php if (!empty($favoris)): ?>
        <section>
            <?php foreach ($favoris as $favori): ?>
                <?php if (isset($favori['error'])): ?>
                    <p class="note">Erreur : <?= htmlspecialchars($favori['error']) ?></p>
                <?php else: ?>
                    <div class="card_movie">
                        <a href="<?= URL ?>details?id=<?= (int)$favori['id'] ?>&type=<?= htmlspecialchars($favori['type']) ?>">
                        <img  src="<?= htmlspecialchars($favori['image']) ?>" alt="<?= htmlspecialchars($favori['title']) ?>" width="150">
                        <h3 class="title_name"><?= htmlspecialchars($favori['title']) ?></h3>
                        <p class="note">Genres : <?= htmlspecialchars($favori['genre']) ?></p>
                        <p class="note">Type : <?= htmlspecialchars(ucfirst($favori['type'])) ?></p>
                        <p class="note">Ajouté le : <?= htmlspecialchars($favori['added_at']) ?></p>

                     <form class="delete-form" action="" method="get">
                        <input type="hidden" name="id" value="<?= (int)$favori['favorite_id'] ?>">
                        <button type="submit" class="btn btn-warning">Supprimer</button>
                    </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>
    <?php else: ?>
        <p>Vous n'avez aucun favori enregistré.</p>
    <?php endif; ?>
<!-- 
    <style>
        .title_movie {
            text-align: center;
            color: #ffa500;
            font-family: Arial, sans-serif;
            margin-top: 20px;
        }

        section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card_movie {
            background-color: #282828;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #fff;
            width: 200px;
            padding: 10px;
            transition: transform 0.2s ease;
        }

        .card_movie:hover {
            transform: scale(1.05);
        }

        .card_movie img {
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .title_name {
            font-size: 16px;
            font-weight: bold;
            color: #ffa500;
            margin-bottom: 10px;
        }

        .note {
            font-size: 14px;
            color: #aaa;
            margin-bottom: 5px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <h1 class="title_movie">Vos Favoris</h1>

    <?php if (!empty($favoris)): ?>
        <section>
            <?php foreach ($favoris as $favori): ?>
                <?php if (isset($favori['error'])): ?>
                    <p class="note">Erreur : <?= htmlspecialchars($favori['error']) ?></p>
                <?php else: ?>
                    <div class="card_movie">
                        <a href="<?= URL ?>details?id=<?= (int)$favori['id'] ?>&type=<?= htmlspecialchars($favori['type']) ?>">
                            <img src="<?= htmlspecialchars($favori['image']) ?>" alt="<?= htmlspecialchars($favori['title']) ?>" width="150">
                            <h3 class="title_name"><?= htmlspecialchars($favori['title']) ?></h3>
                        </a>
                        <p class="note">Genres : <?= htmlspecialchars($favori['genre']) ?></p>
                        <p class="note">Type : <?= htmlspecialchars(ucfirst($favori['type'])) ?></p>
                        <p class="note">Ajouté le : <?= htmlspecialchars($favori['added_at']) ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>
    <?php else: ?>
        <p style="text-align: center; color: #fff;">Vous n'avez aucun favori enregistré.</p>
    <?php endif; ?>


     -->