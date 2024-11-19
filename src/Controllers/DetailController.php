<?php
namespace App\Controllers;

use App\Views\View;
use App\Models\Details;

class DetailController
{
    public function detail() {
        // Vérifie si un ID et un type sont passés via l'URL
        if (
            isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) &&
            isset($_GET['type']) && in_array($_GET['type'], ['movie', 'tv'])
        ) {
            $id = $_GET['id'];
            $type = $_GET['type']; // Peut être "movie" ou "tv"

            $detailsModel = new Details();

            if ($type === 'movie') {
                // Récupère les détails du film
                $details = $detailsModel->getDetailsMovies($id);
            } else {
                // Récupère les détails de la série
                $details = $detailsModel->getDetailsTvs($id);
            }

            if ($details && isset($details['details'])) {
                $view = new View();

                // Passe les données à la vue
                $view->render('details', [
                    'details' => $details['details'],
                    'actors' => $details['actors'] ?? [],
                    'videos' => $details['videos'] ?? []
                ]);
            } else {
                // Affiche un message d'erreur si aucune donnée n'est trouvée
                $view = new View();
                $view->render('error', ['message' => 'Détails introuvables.']);
            }
        } else {
            // Affiche un message d'erreur si l'ID ou le type est invalide
            $view = new View();
            $view->render('error', ['message' => 'ID ou type invalide ou manquant.']);
        }
    }
}
