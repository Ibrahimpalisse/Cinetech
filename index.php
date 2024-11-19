
<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/chemin.php';

use App\Controllers\HomeController;
use App\Controllers\DetailController;

try {
    // Récupérer l'URL sans le chemin de base
    $url = $_SERVER['REQUEST_URI'];
    $path = str_replace(URL, '', parse_url($url, PHP_URL_PATH));

    // Routeur simples
    if ($path === '' || $path === '/') {
        $controller = new HomeController();
        $controller->index();
    } elseif ($path === 'details') {
        $controller = new DetailController();
        $controller->detail();
    } else {
        http_response_code(404);
        echo "Page not found: " . htmlspecialchars($path);
    }
} catch (\Throwable $e) {
    http_response_code(500);
    echo "Une erreur est survenue : " . $e->getMessage();
}