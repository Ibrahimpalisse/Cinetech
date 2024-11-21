<?php
namespace App\Models;
require_once __DIR__ . '/../../config/bdd.php';

class Register{
  
    private $id;
    private $username;
    private $email;
    private $password;
    private $pdo;
    private $created_at;
    private $updated_at;

    public function __construct(){
        $this->id ;
        $this->username ;
        $this->email;
        $this->password;
        $this->pdo;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function register($username, $email, $password){
       
  }
}
?>