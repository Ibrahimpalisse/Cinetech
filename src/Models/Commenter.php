<?php
namespace App\Models;

use PDO;
use PDOException;

class Commenter
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

    public function addComment($userId, $mediaId, $commentText)
    {
        $sql = "INSERT INTO comments (user_id, media_id, comment_text, added_at) 
                VALUES (:user_id, :media_id, :comment_text, :added_at)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $userId,
                ':media_id' => $mediaId,
                ':comment_text' => $commentText,
                ':added_at' => date('Y-m-d H:i:s')
            ]);
            return true;
        } catch (PDOException $e) {
            throw new \Exception("Erreur lors de l'insertion du commentaire : " . $e->getMessage());
        }
    }
 

}
