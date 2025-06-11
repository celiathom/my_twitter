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
                // Debugging output
                echo "Entered password: " . $this->password . "<br>";
                echo "Stored password: " . $user['password'] . "<br>";

                // Direct string comparison since passwords are stored in plain text
                if ($this->password === $user['password']) {
                    $this->userId = $user['id'];
                    return true;
                } else {
                    echo "Password does not match.<br>";
                }
            } else {
                echo "User not found.<br>";
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