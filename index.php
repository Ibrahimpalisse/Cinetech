<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/chemin.php';

use App\Controllers\HomeController;
use App\Controllers\DetailController;
use App\Controllers\MovieController;
use App\Controllers\TvController;
use App\Controllers\RegisterController;
use App\Controllers\LoginControleur;
use App\Controllers\LogoutControleur;
use App\Controllers\FavorisControleur;  

try {
    // Récupérer l'URL sans le chemin de base
    $url = $_SERVER['REQUEST_URI'];
    $path = trim(str_replace(URL, '', parse_url($url, PHP_URL_PATH)), '/');

    // Routeur simple
    switch ($path) {
        case '':
        case '/':
            $controller = new HomeController();
            $controller->index();
            break;

        case 'details':
            $controller = new DetailController();
            $controller->detail();
            break;

        case 'movies':
            $controller = new MovieController();
            $controller->movies();
            break;

        case 'tv':
            $controller = new TvController();
            $controller->tv();
            break;

        case 'register':
            $controller = new RegisterController();
            $controller->register();
            break;

        case 'login':
            $controller = new LoginControleur();
            $controller->login();
            break;

        case 'logout':
            $controller = new LogoutControleur();
            $controller->logout();
            break;
            
    //   case 'favoris':
    //       $controller = new FavorisControleur();
     //     $controller->favoris();
     //      break;

        default:
            http_response_code(404);
            echo "Page not found: " . htmlspecialchars($path);
            break;
    }
} catch (\Throwable $e) {
    // Gestion des erreurs globales
    http_response_code(500);
    echo "Une erreur est survenue : " . $e->getMessage();
}
