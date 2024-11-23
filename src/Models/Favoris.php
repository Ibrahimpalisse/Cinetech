<?php
namespace App\Models;

use PDO;
use PDOException;

class Favoris
{
    private $pdo;

    public function __construct()
    {
        // Informations de connexion à la base de données
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

    /**
     * Récupère l'ID de l'utilisateur à partir de la session.
     *
     * @param array|null $userSession La session utilisateur.
     * @return int|string L'ID de l'utilisateur ou un message d'erreur.
     */
    public function getUserId(?array $userSession)
    {
        if (isset($userSession['user_id'])) {
            return $userSession['user_id'];
        }
        return "Vous n'êtes pas connecté.";
    }

    /**
     * Vérifie si un média est déjà dans les favoris pour un utilisateur.
     *
     * @param int $userId L'ID de l'utilisateur.
     * @param int $mediaId L'ID du média.
     * @param string $mediaType Le type du média (film ou série).
     * @return string Un message indiquant si le média est dans les favoris ou non.
     */
    public function checkMediaInFavoris(int $userId, int $mediaId, string $mediaType): string
    {
        $query = "SELECT * FROM favorites WHERE user_id = :user_id AND media_id = :media_id AND media_type = :media_type";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            'user_id' => $userId,
            'media_id' => $mediaId,
            'media_type' => $mediaType
        ]);

        if ($stmt->rowCount() > 0) {
            return "Le média est déjà dans les favoris.";
        }
        return "Le média n'est pas dans les favoris.";
    }

    /**
     * Ajoute un média aux favoris.
     *
     * @param int $userId L'ID de l'utilisateur.
     * @param int $mediaId L'ID du média.
     * @param string $mediaType Le type du média (film ou série).
     * @return string Un message d'état indiquant si l'ajout a réussi ou échoué.
     */
    public function addMediaToFavoris(int $userId, int $mediaId, string $mediaType): string
    {
        $query = "INSERT INTO 	favorites (user_id, media_id, media_type, added_at) VALUES (:user_id, :media_id, :media_type, NOW())";
        $stmt = $this->pdo->prepare($query);

        try {
            $stmt->execute([
                'user_id' => $userId,
                'media_id' => $mediaId,
                'media_type' => $mediaType
            ]);
            return "Le média a été ajouté aux favoris.";
        } catch (PDOException $e) {
            return "Erreur lors de l'ajout du média aux favoris : " . $e->getMessage();
        }
    }
}
