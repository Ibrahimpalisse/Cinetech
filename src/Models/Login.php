<?php

namespace App\Models;

use PDO;
use PDOException;

class Login
{
    private $id;
    private $email;
    private $password;
    private $pdo;

    public function __construct()
    {
        // Informations de connexion à la base de données
        $host = 'localhost'; // Remplacez par votre hôte
        $dbname = 'cinetech'; // Remplacez par le nom de votre base de données
        $username = 'root'; // Nom d'utilisateur de la base
        $password = ''; // Mot de passe de la base

        try {
            // Connexion à la base de données
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function login($email, $password)
    {
        // Validation des entrées
        if (empty($email) || empty($password)) {
            return "Veuillez remplir tous les champs.";
        }
    
        try {
            // Préparer une requête pour récupérer l'utilisateur avec son email
            $stmt = $this->pdo->prepare("SELECT id, username, password FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
    
            // Vérifier si un utilisateur existe avec cet email
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch();
    
                // Vérifier si le mot de passe fourni correspond au mot de passe haché
                if (password_verify($password, $user['password'])) {
                    // Enregistrer l'utilisateur dans la session
                    session_start();
                    $_SESSION['user_id'] = intval($user['id']);
                    $_SESSION['username'] = $user['username']; // Stocker le nom d'utilisateur
                    return true; // Authentification réussie
                } else {
                    return "Mot de passe incorrect.";
                }
            } else {
                return "Aucun utilisateur trouvé avec cet email.";
            }
        } catch (PDOException $e) {
            return "Erreur SQL : " . $e->getMessage();
        }
    }
}    