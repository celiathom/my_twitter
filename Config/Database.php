<?php
// Inclure le fichier de configuration
require __DIR__ . '/config.php';

try {
    // Créer une nouvelle connexion PDO
$conn = new PDO("mysql:host=127.0.0.1;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur de PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Logguer l'erreur
    error_log("Erreur de connexion à la base de données : " . $e->getMessage());
}
  ?>
