<?php
namespace App\Controllers;
use App\Models\Favoris;
use App\Views\View;

class FavorisControleur {

    public function favoris() {
        // Initialisation de la classe Favoris
        $favoris = new Favoris();

        // Vérification de l'utilisateur connecté
        $userId = $favoris->getUserId($_SESSION);

        if (!is_numeric($userId)) {
            // Si l'utilisateur n'est pas connecté, afficher un message et retourner
            setcookie('favoris_message', "Vous n'êtes pas connecté.", time() + 3600, '/');
            return;
        }

        // Récupération des données du formulaire
        $mediaId = $_POST['id'] ?? null;
        $mediaType = $_POST['type'] ?? null;

        if ($mediaId && $mediaType) {
            // Vérifier si le média est déjà dans les favoris
            $checkMessage = $favoris->checkMediaInFavoris($userId, $mediaId, $mediaType);

            if ($checkMessage === "Le média n'est pas dans les favoris.") {
                // Ajouter le média aux favoris
                $addMessage = $favoris->addMediaToFavoris($userId, $mediaId, $mediaType);
                setcookie('favoris_message', $addMessage, time() + 3600, '/');
            } else {
                setcookie('favoris_message', $checkMessage, time() + 3600, '/');
            }
        } else {
            setcookie('favoris_message', "Données de média invalides.", time() + 3600, '/');
        }
    }
}
