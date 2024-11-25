<?php
namespace App\Controllers;

use App\Models\Commenter;

class CommentaireControleur
{
    public function ajouterCommentaire()
    {
        session_start();
        $userId = $_SESSION['user_id'] ?? null;

        // Vérifiez si l'utilisateur est connecté
        if (!$userId) {
            $this->envoyerReponse(['success' => false, 'message' => 'Utilisateur non connecté.']);
            return;
        }

        // Récupérer et décoder les données JSON envoyées par le formulaire
        $data = json_decode(file_get_contents('php://input'), true);

        // Vérifier la présence des champs nécessaires
        if (!isset($data['media_id'], $data['comment_text'])) {
            $this->envoyerReponse(['success' => false, 'message' => 'Données manquantes.']);
            return;
        }

        // Filtrer et valider les données
        $mediaId = filter_var($data['media_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $commentText = htmlspecialchars(trim($data['comment_text']), ENT_QUOTES, 'UTF-8');

        // Vérifier les validations
        if (!$mediaId) {
            $this->envoyerReponse(['success' => false, 'message' => 'ID du média invalide.']);
            return;
        }

        if (empty($commentText)) {
            $this->envoyerReponse(['success' => false, 'message' => 'Le commentaire ne peut pas être vide.']);
            return;
        }

        $commenter = new Commenter();

        try {
            // Insérer le commentaire dans la base de données
            $commenter->addComment($userId, $mediaId, $commentText);

            
            $this->envoyerReponse(['success' => true, 'message' => 'Commentaire ajouté avec succès.']);
        } catch (\Exception $e) {
            // Gérer les erreurs lors de l'insertion
            $this->envoyerReponse(['success' => false, 'message' => 'Erreur serveur : ' . $e->getMessage()]);
        }
    }

    private function envoyerReponse($reponse)
    {
        // Envoyer la réponse en JSON
        header('Content-Type: application/json');
        echo json_encode($reponse);
    }
}
