<?php
namespace App\Controllers;
session_start();

use App\Views\View;

class registerController {
    
    public function register() {
    
        

     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register']) &&
         !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) &&
          !empty($_POST['confirm_password'])) 
          {
            $nom = htmlspecialchars(trim($_POST['username']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            $nomRegex = "/^[A-Z][a-zà-öø-ÿ-]+$/";
            $emailRegex = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            $passwordRegex = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/";

            if(empty($nom) || !preg_match($nomRegex , $nom)) {
                echo "Le nom doit commencer par une majuscule, ne contenir que des lettres.";
            }else {
                $_SESSION['username'] = $nom;            
            }
            if(empty($email) || !preg_match($emailRegex , $email)) {
                echo "Veuillez entrer un email valide.";
            }else {
                $_SESSION['email'] = $email;            
            }
            if(empty($password) || !preg_match($passwordRegex , $password)) {
                echo "Le mot de passe doit contenir au moins 8 caractères, 1 majuscule, 1 chiffre et 1 caractère spécial.";
            }else {
                $_SESSION['password'] = $password;            
            }
            if($password !== $confirm_password) {
                echo "Les mots de passe ne correspondent pas.";
            }



          }else{
              echo "Veuillez remplir tous les champs.";
          }
        $view = new View();
        $view->render('register');

        session_unset(); 
    }
}
