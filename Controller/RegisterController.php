<?php

require '../Config/Database.php';
require '../Model/Register.php';


class RegisterController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function hr() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $prenom = $_POST["firstname"];
            $nom = $_POST["lastname"];
            $username = $_POST["username"];
            $ville = $_POST["city"];
            $pays = $_POST["country"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $genre = $_POST["genre"];
            $anniversaire = $_POST["birthdate"]; 

            // Vérification des entrées
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Adresse e-mail invalide.");
            }

            $user = new Register($this->conn, $nom, $prenom,$username, $email, $genre, $password, $anniversaire, $pays, $ville);
            if ($user->ru()) {
                header("Location: ../index.php");
                exit();
            } else {
                die("Erreur d'inscription.");
            }
        }
    }
}

$rc = new RegisterController($conn);
$rc->hr();
?>
