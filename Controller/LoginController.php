<?php

session_start(); 

require '../Config/Database.php';
require '../Model/Login.php';

class LoginController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function hl() {
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Invalid email address.");
            }

            $user = new Login($this->conn, $email, $password);
            if ($user->LU()) {
                $_SESSION['user_id'] = $user->getUserId();
                header('Location: ../Views/AccountView.php');
                exit();
            } else {
                echo "Incorrect email or password.";
            }
        }
    }
}

$lc = new LoginController($conn);
$lc->hl();
?>