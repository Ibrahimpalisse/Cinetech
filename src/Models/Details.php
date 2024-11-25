<?php
namespace App\Models;

require_once __DIR__ . '/../../config/key_api.php';

use PDO;

class Details
{
    private $api_key;
    private $bas_url;
    private $pdo;

    public function __construct() {
        $this->api_key = API_KEY;
        $this->bas_url = BASE_URL;

        $host = 'localhost';
        $dbname = 'cinetech';
        $username = 'root';
        $password = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    private function fetchApiData($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            curl_close($curl);
            return null; // Gérer les erreurs cURL
        }
        curl_close($curl);
        return json_decode($response, true);
    }

    public function getDetailsMovies($id) {
        $details = $this->fetchApiData($this->bas_url . "/movie/{$id}?api_key={$this->api_key}&language=fr-FR");
        $credits = $this->fetchApiData($this->bas_url . "/movie/{$id}/credits?api_key={$this->api_key}&language=fr-FR");
        $videos = $this->fetchApiData($this->bas_url . "/movie/{$id}/videos?api_key={$this->api_key}&language=fr-FR");

        $actors = $credits['cast'] ?? [];
        $actors = array_slice($actors, 0, 5);

        return [
            'details' => $details,
            'actors' => $actors,
            'videos' => $videos['results'] ?? [],
            'type' => 'movie'
        ];
    }

    public function getDetailsTvs($id) {
        $details = $this->fetchApiData($this->bas_url . "/tv/{$id}?api_key={$this->api_key}&language=fr-FR");
        $credits = $this->fetchApiData($this->bas_url . "/tv/{$id}/credits?api_key={$this->api_key}&language=fr-FR");
        $videos = $this->fetchApiData($this->bas_url . "/tv/{$id}/videos?api_key={$this->api_key}&language=fr-FR");

        $actors = $credits['cast'] ?? [];
        $actors = array_slice($actors, 0, 5);

        return [
            'details' => $details,
            'actors' => $actors,
            'videos' => $videos['results'] ?? [],
            'type' => 'tv'
        ];
    }

    /**
     * Récupère les commentaires par media_id et user_id.
     *
     * @param int $mediaId ID du média.
     * @param int $userId ID de l'utilisateur.
     * @return array Liste des commentaires avec les noms d'utilisateur.
     */
    public function getCommentsByMediaIdAndUser($mediaId) {
        $sql = "
                SELECT c.comment_text, u.username, c.added_at 
                FROM comments c 
                INNER JOIN users u ON c.user_id = u.id 
                WHERE c.media_id = :media_id 
                ORDER BY c.added_at DESC
                ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':media_id' => $mediaId,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
