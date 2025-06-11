<?php

require '../Config/Database.php';

class Register {
    private $conn;
    private $nom;
    private $prenom;
    private $username;
    private $email;
    private $genre;
    private $password;
    private $anniversaire;
    private $pays;
    private $ville;

    public function __construct($conn, $nom, $prenom, $username, $email, $genre, $password, $anniversaire, $pays, $ville){

        $this->conn = $conn;
        $this->nom = htmlspecialchars($nom);
        $this->prenom = htmlspecialchars($prenom);
        $this->username = htmlspecialchars($username);
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->genre = $genre;
        $this->password = htmlspecialchars($password,);
        $this->anniversaire = $anniversaire;
        $this->pays = htmlspecialchars($pays);
        $this->ville = htmlspecialchars($ville);
    }

    public function ru() {
        try {
            $sql = "INSERT INTO user (firstname, lastname, username, genre, birthdate, country, city, email, password) 
                    VALUES (:firstname, :lastname, :username, :genre, :birthdate, :country, :city, :email, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':firstname', $this->prenom);
            $stmt->bindParam(':lastname', $this->nom);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':genre', $this->genre);
            $stmt->bindParam(':birthdate', $this->anniversaire);
            $stmt->bindParam(':country', $this->pays);
            $stmt->bindParam(':city', $this->ville);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur lors de l'inscription : " . $e->getMessage());
        }
    }
}
?>