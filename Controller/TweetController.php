<?php
require_once '../Config/Database.php';
require_once '../Model/Tweet.php';

class TweetController {
    public function postTweet() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AIR'])) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                die("Vous devez être connecté pour tweeter.");
            }

            $user_id = $_SESSION['user_id'];
            $content = htmlspecialchars($_POST['AIR']);
            $mediaPaths = [];

            // Vérifier si des fichiers ont été envoyés
            if (!empty($_FILES['media']['name'][0])) {
                $uploadDir = "../Views/Uploads/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Crée le dossier s'il n'existe pas
                }

                foreach ($_FILES['media']['tmp_name'] as $key => $tmpName) {
                    if ($_FILES['media']['error'][$key] === UPLOAD_ERR_OK) {
                        $fileName = time() . "_" . basename($_FILES['media']['name'][$key]); // Ajout d'un timestamp pour éviter les doublons
                        $uploadPath = $uploadDir . $fileName;

                        if (move_uploaded_file($tmpName, $uploadPath)) {
                            $mediaPaths[] = $fileName;
                        } else {
                            die("Erreur lors de l'upload du fichier : " . $_FILES['media']['name'][$key]);
                        }
                    } else {
                        die("Erreur avec le fichier : " . $_FILES['media']['name'][$key] . " Code d'erreur : " . $_FILES['media']['error'][$key]);
                    }
                }
            }

            // Enregistrer le tweet
            $tweet = new Tweet();
            $tweet->createTweet($user_id, $content, $mediaPaths);

            header("Location: ../Views/AccountView.php");
            exit();
        }
    }
}

// Exécuter la méthode
$controller = new TweetController();
$controller->postTweet();
?>