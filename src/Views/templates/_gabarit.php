<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="./public/css/nav.css?<?php echo time(); ?>" rel="stylesheet" />
    <link href="./public/css/details.css?<?php echo time(); ?>" rel="stylesheet" />
    <link href="./public/css/home.css?<?php echo time(); ?>" rel="stylesheet" />
    <link href="./public/css/register.css?<?php echo time(); ?>" rel="stylesheet" />

    <title>Accueil</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">TV</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="<?= URL ?>">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= URL ?>tv">
                            Series
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?= URL ?>movies">
                            Films
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white me-auto" href="<?= URL ?>affichFavoris">
                            Favoris

                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="fill: rgba(255, 99, 71, 1);" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="userDropdown">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <!-- L'utilisateur est connecté -->
                                <li>
                                    <a class="dropdown-item" href="<?= URL ?>profile">Profil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= URL ?>logout">Se déconnecter</a>
                                </li>
                            <?php else: ?>
                                <!-- L'utilisateur n'est pas connecté -->
                                <li>
                                    <a class="dropdown-item" href="<?= URL ?>login">Se connecter</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= URL ?>register">S'inscrire</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <h1 class="bienvenue">Bienvenue <?= (isset($_SESSION['username'])) ? $_SESSION['username'] : 'Inconnu' ?> </h1>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <input
                        type="text"
                        id="searchInput"
                        class="form-control me-2"
                        placeholder="Rechercher un film ou une série..."
                        aria-label="Search"
                        autocomplete="off">
                    <div id="autocompleteResult" class="autocomplete-results"></div>
                </form>
            </div>
        </div>
    </nav>
    <main>
        <section class="modal fade modal-success" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
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

        <?= $content ?>
    </main>
    <footer>
        <p>&copy; 2024 Mon Application</p>
    </footer>
    <script src="./public/js/carouselle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./public/js/favorit.js"></script>
    <script src="./public/js/commenter.js"></script>

</body>

</html>