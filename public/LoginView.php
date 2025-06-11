<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Views/style/style.css">
    <link rel="stylesheet" href="../Views/style/darkmode.css">

    <title>AIRMESS</title>
</head>
<body>

    <div class="form-container login-form">
        <header>
            <img class="logo" src="/Views/imgs/hermes.png" alt="">
            <h1 class="nom_site">AIRMESS</h1>
        </header>

        <a href="index.php"></a>
        <button class="toggle-btn" onclick="toggleDarkMode()">Dark Mode</button>


        <div class="wrapper5">
            
            <p class="form-login5 ">Connexion</p>
            <form action="../Controller/LoginController.php" method="POST">
                <div class="input-box5 ">
                    <input required placeholder="E-Mail" type="text" id="email" name="email" />
                </div>
                <div class="input-box5">
                    <input required minlength="8" placeholder="Mot de passe" type="password" id="password" name="password" />
                </div>
                <div class="remember-forgot5 ">
                    <label><input type="checkbox" /> Se souvenir de moi</label>
                    <a class="mdp5" href="#">Mot de passe oublié ?</a>
                </div>
                    <button class="btn5" type="submit">Se connecter</button>
                <div class="register-link5">
                    <p>Pas encore de compte ? <a href="../Views/RegisterView.php" id="RL">S'inscrire</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <script src="../Views/js/darkmode.js"></script>
</body>
</html>