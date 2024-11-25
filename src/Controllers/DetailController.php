<?php
namespace App\Controllers;

session_start();

use App\Views\View;
use App\Models\Details;

class DetailController
{
    public function detail()
    {
        // Vérification des paramètres GET
        if (
            isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) &&
            isset($_GET['type']) && in_array($_GET['type'], ['movie', 'tv'])
        ) {
            $id = $_GET['id'];
            $type = $_GET['type'];

            // Modèle pour récupérer les détails
            $detailsModel = new Details();

            if ($type === 'movie') {
                $details = $detailsModel->getDetailsMovies($id);
                $episodes = null;
            } else {
                $details = $detailsModel->getDetailsTvs($id);
                $episodes = $details['episodes'] ?? null;
            }

            // Récupérer les commentaires pour ce média et cet utilisateur (si connecté)
            $comments = $detailsModel->getCommentsByMediaIdAndUser($id, $_SESSION['user_id'] ?? null);

            // Si les détails sont trouvés, passer les données à la vue
            if ($details && isset($details['details'])) {
                $view = new View();
                $view->render('details', [
                    'details' => $details['details'],
                    'actors' => $details['actors'] ?? [],
                    'videos' => $details['videos'] ?? [],
                    'episodes' => $episodes,
                    'comments' => $comments, // Passer les commentaires à la vue
                    'type' => $type
                ]);
            } else {
                // Afficher une page d'erreur si les détails sont introuvables
                $this->renderError('Détails introuvables.');
            }
        } else {
            // Afficher une page d'erreur si les paramètres sont invalides ou manquants
            $this->renderError('ID ou type invalide ou manquant.');
        }
    }

    /**
     * Fonction pour afficher une vue d'erreur
     * @param string $message
     */
    private function renderError(string $message)
    {
        $view = new View();
        $view->render('error', ['message' => $message]);
    }
}
