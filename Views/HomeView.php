<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../Config/session.php';
require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Controller/AccountController.php';
require_once __DIR__ . '/../Controller/ProfilController.php';
require_once __DIR__ . '/../Model/Tweet.php';



$tweetModel = new Tweet();
$tweets = $tweetModel->getAllTweets();

// Vérifier si la session est déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Instancier le contrôleur
$accountController = new AccountController($conn);

// Vérifier si les données utilisateur existent dans la session
if (!isset($_SESSION['user_data'])) {
    header("Location: login.php"); 
    exit();
}

$user = $_SESSION['user_data']; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIRMESS</title>

    <link rel="stylesheet" href="../Views/style/session.css">
    <link rel="stylesheet" href="../Views/style/skeleton.css">
    <link rel="stylesheet" href="../Views/style/darkmode.css">
</head>
<body>
    <div class="skeleton-loader">
        <div class="skeleton-container">
            <!-- Colonne 1 (Navigation) -->
            <div class="skeleton-column skeleton-col1">
                <ul>
                    <div class="skeleton-btn"></div>
                    <div class="skeleton-btn"></div>
                    <div class="skeleton-btn"></div>
                    <div class="skeleton-btn"></div>
                    <div class="skeleton-btn"></div>
                </ul>
            </div>

            <!-- Colonne 2 (Profil) -->
            <div class="skeleton-column skeleton-col2">
                <div class="skeleton-banner"></div>
                <div class="skeleton-avatar"></div>
                <div class="skeleton-text"></div>
                <div class="skeleton-bio"></div>
                <div class="skeleton-bio"></div>
            </div>

            <!-- Colonne 3 (Recherche) -->
            <div class="skeleton-column skeleton-col3">
                <div class="skeleton-search"></div>
            </div>
        </div>
    </div>

    <div class="real-content">
        <div class="container">
            <div class="column col1">
                <ul>
                    <li><a class="btn-live" href="../Views/HomeView.php"><img src="../Views/imgs/maison.png"> Home</a></li>
                    <li><a class="btn-nolive"><img src="../Views/imgs/hashtag.png"> Explore</a></li>
                    <li><a class="btn-nolive"><img src="../Views/imgs/notifs.png"> Notifications</a></li>
                    <li><a class="btn-nolive"><img src="../Views/imgs/message.png"> Messages</a></li>
                    <li><a class="btn-nolive"><img src="../Views/imgs/list.png"> Lists</a></li>
                    <li><a class="btn-nolive" href="../Views/AccountView.php"><img src="../Views/imgs/profile.png"> Profile</a></li>
                    <li><a class="btn-nolive" href="../Views/LoginView.php"><img src="../Views/imgs/logout.png"> Dissconnection</a></li>
                    <li><a class="btn-tweet" href="#">AIRS</a></li> 
                </ul>
            </div>
            <div class="column col2">
                <h2>Fil d'actualités</h2><br><br>
                <div class="tweets-container">
                    <?php if (!empty($tweets)): ?>
                        <?php foreach ($tweets as $tweet): ?>
                            <div class="tweet-embed">
                                <div class="tweet-header">
                                    <span class="tweet-username">
                                        @<?= !empty($tweet['username']) ? htmlspecialchars($tweet['username']) : 'Utilisateur inconnu' ?>
                                    </span>
                                    <span class="tweet-date"> <?= date("d M Y H:i", strtotime($tweet['creation_date'])) ?> </span>
                                    <span class="tweet-close">&times;</span>
                                </div>
                                <div class="tweet-content">
                                    <p><?= !empty($tweet['content']) ? nl2br(htmlspecialchars($tweet['content'])) : "Pas de texte" ?></p>
                                </div>
                                <?php if (!empty($tweet['media1'])): ?>
                                    <div class="tweet-media">
                                        <img src="../Views/Uploads/<?= htmlspecialchars($tweet['media1']) ?>" alt="Tweet media">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun tweet à afficher.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="column col3">
                <button class="toggle-btn" onclick="toggleDarkMode()">Dark Mode</button>
                <input type="text" id="search" name="search" placeholder="Search Tweet">
            </div>
        </div>


        <!-- Fenêtre popup -->
        <div id="tweetPopup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Créer un AIR</h2>
            <form action="../Controller/TweetController.php" method="POST" enctype="multipart/form-data">
                <textarea id="message" name="AIR" placeholder="Fill me up" maxlength="140" required></textarea>
                <input type="file" name="media[]" id="mediaInput" accept="image/*,video/*" multiple>
                <div class="counter-container">
                <input readonly maxlength="3" size="3" value="140" id="counter">
                </div>
                <button type="submit">AIR</button>
                <div id="preview"></div>
            </form>
        </div>
    </div> 

    <script src="../Views/js/darkmode.js"></script>
    <script src="../Views/js/skeleton.js"></script>
    <script src="../Views/js/counterarea.js"></script>
    <script src="../Views/js/popup.js"></script>

</body>
</html>
