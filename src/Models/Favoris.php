<?php
namespace App\Models;

use PDO;
use PDOException;

class Favoris
{
    private $pdo;

    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'cinetech';
        $username = 'root';
        $password = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getUserId(?array $userSession)
    {
        return $userSession['user_id'] ?? null;
    }

    public function isMediaInFavoris(int $userId, int $mediaId, string $mediaType): bool
    {
        $query = "SELECT COUNT(*) FROM favorites WHERE user_id = :user_id AND media_id = :media_id AND media_type = :media_type";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'user_id' => $userId,
            'media_id' => $mediaId,
            'media_type' => $mediaType
        ]);

        $result = (int) $stmt->fetchColumn();
        error_log("isMediaInFavoris - Résultat: $result");

        return $result > 0;
    }

    public function addMediaToFavoris(int $userId, int $mediaId, string $mediaType): bool
    {
        $query = "INSERT INTO favorites (user_id, media_id, media_type, added_at) VALUES (:user_id, :media_id, :media_type, NOW())";
        $stmt = $this->pdo->prepare($query);

        try {
            $stmt->execute([
                'user_id' => $userId,
                'media_id' => $mediaId,
                'media_type' => $mediaType
            ]);

            if ($stmt->rowCount() > 0) {
                error_log("addMediaToFavoris - Succès");
                return true;
            } else {
                error_log("addMediaToFavoris - Aucune ligne insérée");
                return false;
            }
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout aux favoris : " . $e->getMessage());
            return false;
        }
    }
    public function getFavoris($userId) {
        $query = "SELECT * FROM favorites WHERE user_id = :user_id ORDER BY added_at DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteFavori($favoriteId)
    {
        $db = new \PDO('mysql:host=localhost;dbname=cinetech;charset=utf8', 'root', '');
        $query = "DELETE FROM favorites WHERE id = :id";
        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $favoriteId, \PDO::PARAM_INT);

        return $stmt->execute(); // Retourne true si la suppression réussit
    }

}
