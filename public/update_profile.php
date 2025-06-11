<?php

// Activer l'affichage des erreurs pour le debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifier si la session est déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclure le fichier Database.php
require __DIR__ . '/../Config/Database.php';

// Inclure le fichier AccountController.php
require __DIR__ . '/../Controller/AccountController.php';

// Instancier le contrôleur
$accountController = new AccountController($conn);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur
$user = $accountController->getUserInfo($user_id);

// Vérifier si on a récupéré un utilisateur et stocker dans la session
if ($user) {
    $_SESSION['user_data'] = $user;
} else {
    die("Erreur : Impossible de récupérer les informations de l'utilisateur.");
}

$errors = []; // Tableau pour stocker les erreurs
$success = false; // Variable pour indiquer si la mise à jour a réussi


// Traitement du formulaire si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $biography = trim($_POST['biography']);

    // Validation des données
    if (empty($firstname)) {
        $errors[] = "Le prénom est obligatoire.";
    } elseif (strlen($firstname) > 50) {
        $errors[] = "Le prénom ne doit pas dépasser 50 caractères.";
    }

    if (empty($lastname)) {
        $errors[] = "Le nom est obligatoire.";
    } elseif (strlen($lastname) > 50) {
        $errors[] = "Le nom ne doit pas dépasser 50 caractères.";
    }

    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur est obligatoire.";
    } elseif (strlen($username) > 50) {
        $errors[] = "Le nom d'utilisateur ne doit pas dépasser 50 caractères.";
    }

    if (empty($email)) {
        $errors[] = "L'email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    } elseif (strlen($email) > 100) {
        $errors[] = "L'email ne doit pas dépasser 100 caractères.";
    }

    if (strlen($biography) > 255) {
        $errors[] = "La biographie ne doit pas dépasser 255 caractères.";
    }



    $bannerPath = $user['header']; // Récupère l'ancienne valeur si aucun fichier n'est uploadé
    $profilePicturePath = $user['picture']; // Récupère l'ancienne valeur si aucun fichier n'est uploadé

    $uploadDir = __DIR__ . '/../Views/Uploads/'; // Répertoire de stockage des images

    // Vérifier et traiter l'upload de la bannière
    if (!empty($_FILES['banner']['name']) && $_FILES['banner']['error'] == 0) {
        $bannerFilename = uniqid('banner_') . '.' . pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
        $bannerPath = "Views/Uploads/" . $bannerFilename;
    
        if (move_uploaded_file($_FILES['banner']['tmp_name'], $uploadDir . $bannerFilename)) {
            // Supprimer l'ancienne bannière seulement si elle est différente de la nouvelle
            $oldBannerPath = __DIR__ . '/../' . $user['header'];
            if (!empty($user['header']) && file_exists($oldBannerPath) && $user['header'] !== $bannerPath) {
                unlink($oldBannerPath);
            }
        } else {
            $errors[] = "Erreur lors de l'upload de la bannière.";
        }
    }
    

    // Vérifier et traiter l'upload de la photo de profil
    if (!empty($_FILES['profile_picture']['name']) && $_FILES['profile_picture']['error'] == 0) {
        $profileFilename = uniqid('profile_') . '.' . pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        $profilePicturePath = "Views/Uploads/" . $profileFilename;
    
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadDir . $profileFilename)) {
            // Supprimer l'ancienne photo de profil seulement si elle est différente de la nouvelle
            $oldProfilePath = __DIR__ . '/../' . $user['picture'];
            if (!empty($user['picture']) && file_exists($oldProfilePath) && $user['picture'] !== $profilePicturePath) {
                unlink($oldProfilePath);
            }
        } else {
            $errors[] = "Erreur lors de l'upload de la photo de profil.";
        }
    }
    


    // Si aucune erreur, mettre à jour l'utilisateur
    if (empty($errors)) {
    $updateSuccess = $accountController->updateUserInfo($user_id, $firstname, $lastname, $username, $email, $biography, $bannerPath, $profilePicturePath);

    if ($updateSuccess) {
        // Mettre à jour la session avec les nouvelles valeurs
        $_SESSION['user_data']['firstname'] = $firstname;
        $_SESSION['user_data']['lastname'] = $lastname;
        $_SESSION['user_data']['username'] = $username;
        $_SESSION['user_data']['email'] = $email;
        $_SESSION['user_data']['biography'] = $biography;
        $_SESSION['user_data']['header'] = $bannerPath;
        $_SESSION['user_data']['picture'] = $profilePicturePath;

        $success = true;
        $user = $_SESSION['user_data']; // Mettre à jour la variable $user avec les nouvelles données
    } else {
        $errors[] = "Erreur lors de la mise à jour du profil.";
    }
}

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Profil</title>
    <link rel="stylesheet" href="../Views/style/session.css">
</head>
<body>
    <div class="container">
        <h2>Modifier votre profil</h2>

        <?php if ($success): ?>
            <div class="success">Profil mis à jour avec succès !</div>
            <?php header("Refresh: 2; url=AccountView.php"); // Redirection après 2 secondes ?>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
            <label>Prénom :</label>
            <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>

            <label>Nom :</label>
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>

            <label>Nom d'utilisateur :</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label>Email :</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label>Biographie :</label>
            <textarea name="biography"><?php echo htmlspecialchars($user['biography'] ?? ''); ?></textarea>

            <label>Bannière :</label>
            <input type="file" name="banner">

            <label>Photo de profil :</label>
            <input type="file" name="profile_picture">

            <button type="submit">Sauvegarder</button>
        </form>
    </div>
</body>
</html>
