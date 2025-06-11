<?php
// Vérifier si la session est déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclure la connexion à la base de données
$databasePath = __DIR__ . '/../Config/Database.php';
if (!file_exists($databasePath)) {
    die("Erreur : Le fichier database.php est introuvable.");
}
require $databasePath;

class AccountController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserInfo() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../Views/login.php"); // Rediriger si l'utilisateur n'est pas connecté
            exit();
        }

        $user_id = $_SESSION['user_id'];

        try {
            // Récupérer les infos de l'utilisateur
            $stmt = $this->conn->prepare("SELECT id, username, firstname, lastname, email, biography, creation_date, header, picture FROM user WHERE id = :user_id");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return null;
            }

            // Récupérer le nombre de tweets (posts)
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS total_tweets FROM tweet WHERE id_user = :user_id");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $tweets = $stmt->fetch(PDO::FETCH_ASSOC);
            $user['total_tweets'] = $tweets['total_tweets'];

            // Récupérer le nombre de followers
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS total_followers FROM follow WHERE id_user_followed = :user_id");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $followers = $stmt->fetch(PDO::FETCH_ASSOC);
            $user['total_followers'] = $followers['total_followers'];

            // Récupérer le nombre de followings
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS total_following FROM follow WHERE id_user_follow = :user_id");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $following = $stmt->fetch(PDO::FETCH_ASSOC);
            $user['total_following'] = $following['total_following'];

            return $user;
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function updateUserInfo($user_id, $firstname, $lastname, $username, $email, $biography, $bannerPath = null, $profilePicturePath = null) {
        try {
            // Préparer la requête SQL
            $sql = "UPDATE user SET firstname = :firstname, lastname = :lastname, username = :username, email = :email, biography = :biography, header = :header, picture = :picture WHERE id = :user_id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":firstname", $firstname, PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":biography", $biography, PDO::PARAM_STR);
            $stmt->bindParam(":header", $bannerPath, PDO::PARAM_STR);
            $stmt->bindParam(":picture", $profilePicturePath, PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    
            $stmt->execute();
            return true; // Succès
        } catch (PDOException $e) {
            error_log("Erreur SQL lors de la mise à jour du profil : " . $e->getMessage());
            return false; // Échec
        }
    }
    
}

// Instancier le contrôleur
$accountController = new AccountController($conn);
$user = $accountController->getUserInfo();

// Vérifier si on a récupéré un utilisateur et stocker dans la session
if ($user) {
    $_SESSION['user_data'] = $user;
} else {
    die("Erreur : Impossible de récupérer les informations de l'utilisateur.");
}
?>
