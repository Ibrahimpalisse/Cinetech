<?php

namespace App\Controllers;

use App\Views\View;
use App\Models\Login;

class LoginControleur
{
    public function login()
    {
       
        $errors = [
            'identifiant' => '',
        ];

    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));
            $password = $_POST['password'] ?? '';

        
            $loginModel = new Login();
            $result = $loginModel->login($email, $password);

            if ($result === true) { 
                header('Location: http://localhost/cinetech/'); 
                exit;
            } else {
             
                $errors['identifiant'] = "Email ou mot de passe incorrect.";
            }
        }

        // Rendu de la vue avec les erreurs
        $view = new View();
        $view->render('login', ['errors' => $errors]);
    }
}
