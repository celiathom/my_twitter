<?php
$defaultProfilePicture = '../Views/imgs/logouser.jpeg';
$profilePicturePath = isset($_SESSION['user_data']['picture']) && !empty($_SESSION['user_data']['picture']) ? '../' . $_SESSION['user_data']['picture'] : $defaultProfilePicture;

// Vérifier si le fichier existe, sinon afficher l'image par défaut
if (!file_exists(__DIR__ . '/../' . $_SESSION['user_data']['picture'])) {
    $profilePicturePath = $defaultProfilePicture;
}

$defaultBanner = '../Views/imgs/banner.png';
$bannerPath = isset($_SESSION['user_data']['header']) && !empty($_SESSION['user_data']['header']) ? '../' . $_SESSION['user_data']['header'] : $defaultBanner;

// Vérifier si le fichier existe, sinon afficher l'image par défaut
if (!file_exists(__DIR__ . '/../' . $_SESSION['user_data']['header'])) {
    $bannerPath = $defaultBanner;
}
?>