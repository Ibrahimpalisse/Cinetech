<?php
namespace App\Controllers;

use App\Models\Favoris;

class FavorisControleur
{
    public function ajouterAuxFavoris()
    {
        try {
            header('Content-Type: application/json');

            $mediaId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $mediaType = filter_input(INPUT_GET, 'type', FILTER_DEFAULT);
            $mediaType = htmlspecialchars($mediaType, ENT_QUOTES, 'UTF-8');

            if (!$mediaId || !$mediaType) {
                echo json_encode(['status' => 'error', 'message' => "Données de média invalides."]);
                return;
            }

            $favoris = new Favoris();
            session_start();

            $userId = $favoris->getUserId($_SESSION);

            if (!is_numeric($userId)) {
                echo json_encode(['status' => 'error', 'message' => "Vous n'êtes pas connecté."]);
                return;
            }

            if ($favoris->isMediaInFavoris($userId, $mediaId, $mediaType)) {
                echo json_encode(['status' => 'info', 'message' => "Le média est déjà dans les favoris."]);
            } else {
                if ($favoris->addMediaToFavoris($userId, $mediaId, $mediaType)) {
                    echo json_encode(['status' => 'success', 'message' => "Le média a été ajouté aux favoris."]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => "Erreur lors de l'ajout du média aux favoris."]);
                }
            }
        } catch (\Exception $e) {
            echo json_encode(['status' => 'error', 'message' => "Erreur interne du serveur : " . $e->getMessage()]);
        }
    }
}
