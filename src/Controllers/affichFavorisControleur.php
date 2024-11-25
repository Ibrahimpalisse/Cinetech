<?php
namespace App\Controllers;

session_start();

use App\Models\FavoriRecupe;
use App\Models\Favoris;
use App\Views\View;

class affichFavorisControleur
{
    /**
     * Gère l'affichage et la suppression des favoris.
     */
    public function affichFavoris()
    {
        try {
            $favoriModel = new FavoriRecupe();
            $favorisModel = new Favoris();

            // Vérifier que l'utilisateur est connecté
            $userId = $_SESSION['user_id'] ?? null;

            if (!$userId) {
                throw new \Exception("Utilisateur non connecté.");
            }

            // Vérifier si un ID de favori est envoyé pour suppression
            $favoriteId = $_GET['id'] ?? null;

            if ($favoriteId) {
                // Validation de l'ID du favori
                if (!filter_var($favoriteId, FILTER_VALIDATE_INT)) {
                    throw new \Exception("ID du favori invalide.");
                }

                // Supprimer le favori
                if ($favorisModel->deleteFavori($favoriteId)) {
                    header("Location: " . URL . "affichFavoris");
                    exit;
                } else {
                    throw new \Exception("Erreur lors de la suppression du favori.");
                }
            }

            // Récupérer les favoris de l'utilisateur
            $favoris = $favoriModel->getFavorisFromDB($userId);

            // Récupérer les détails des favoris depuis TMDB
            $favorisDetails = [];
            foreach ($favoris as $favori) {
                $details = $favoriModel->getDetailsFromTMDB($favori['media_type'], $favori['media_id'], $favori['added_at']);
                $details['favorite_id'] = $favori['id']; // Inclure l'ID de la table `favorites`
                $favorisDetails[] = $details;
            }

            // Passer les données à la vue
            $view = new View();
            $view->render('affichFavoris', [
                'favoris' => $favorisDetails,
            ]);

        } catch (\Exception $e) {
            // Afficher une vue d'erreur en cas de problème
            $view = new View();
            $view->render('error', ['message' => $e->getMessage()]);
        }
    }
}
