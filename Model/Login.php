<?php
require '../Config/Database.php';

class Login {
    private $conn;
    private $email;
    private $password;
    private $userId;

    
    public function __construct($conn, $email, $password) {
        $this->conn = $conn;
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->password = $password;
    }

    public function LU() {
        try {
            $sql = 'SELECT id, password FROM user WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":email", $this->email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Suppression des echo pour éviter l'erreur de header
                if ($this->password === $user['password']) {
                    $this->userId = $user['id'];
                    return true;
                } else {
                    // Mot de passe incorrect
                }
            } else {
                // Utilisateur non trouvé
            }

            return false;
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }
    public function getUserId() {
        return $this->userId;
    }
}
?>