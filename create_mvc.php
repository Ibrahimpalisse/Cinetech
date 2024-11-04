<?php
// Fonction pour créer un dossier s'il n'existe pas déjà
function createDirectory($path) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
        echo "Dossier créé : $path\n";
    } else {
        echo "Le dossier existe déjà : $path\n";
    }
}

// Fonction pour créer un fichier avec du contenu
function createFile($path, $content) {
    if (!file_exists($path)) {
        file_put_contents($path, $content);
        echo "Fichier créé : $path\n";
    } else {
        echo "Le fichier existe déjà : $path\n";
    }
}

// Créer les dossiers de base pour le projet
createDirectory('mvc_project/src/Controllers');
createDirectory('mvc_project/src/Models');
createDirectory('mvc_project/src/Views/templates');
createDirectory('mvc_project/public');

// Contenu du fichier index.php
$indexContent = <<<'EOD'
<?php
require __DIR__ . '/vendor/autoload.php';

use App\Controllers\HomeController;

$controller = new HomeController();
$controller->index();
EOD;
createFile('mvc_project/index.php', $indexContent);

// Contenu du fichier composer.json pour l'autoloading
$composerJsonContent = <<<'EOD'
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
EOD;
createFile('mvc_project/composer.json', $composerJsonContent);

// Contenu du contrôleur HomeController.php
$homeControllerContent = <<<'EOD'
<?php
namespace App\Controllers;

use App\Views\View;

class HomeController {
    public function index() {
        $view = new View();
        $view->render('home', ['title' => 'Bienvenue sur mon site MVC !']);
    }
}
EOD;
createFile('mvc_project/src/Controllers/HomeController.php', $homeControllerContent);

// Contenu de la classe View.php
$viewContent = <<<'EOD'
<?php
namespace App\Views;

class View {
    public function render($viewName, $data = []) {
        extract($data);
        include __DIR__ . "/templates/$viewName.php";
    }
}
EOD;
createFile('mvc_project/src/Views/View.php', $viewContent);

// Contenu du modèle Model.php (vide, prêt pour des extensions futures)
$modelContent = <<<'EOD'
<?php
namespace App\Models;

class Model {
    // Modèle de base pour des fonctionnalités futures
}
EOD;
createFile('mvc_project/src/Models/Model.php', $modelContent);

// Contenu du template home.php
$homeTemplateContent = <<<'EOD'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <p>Bienvenue sur votre première page MVC !</p>
</body>
</html>
EOD;
createFile('mvc_project/src/Views/templates/home.php', $homeTemplateContent);

// Contenu du fichier CSS
$cssContent = <<<'EOD'
body {
    font-family: Arial, sans-serif;
    text-align: center;
    padding-top: 50px;
}
h1 {
    color: #333;
}
EOD;
createFile('mvc_project/public/style.css', $cssContent);

// Instructions pour finaliser l'installation avec Composer
echo "\nStructure MVC créée avec succès !";
echo "\nPour finaliser, accédez au dossier 'mvc_project' et lancez la commande suivante pour installer Composer:\n";
echo "\ncomposer install\n";
echo "\nEnsuite, vous pouvez démarrer le serveur PHP intégré avec :\n";
echo "\nphp -S localhost:8000\n";
echo "\nPuis visitez http://localhost:8000 dans votre navigateur.\n";
