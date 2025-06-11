<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Views/style/style.css">
    <link rel="stylesheet" href="../Views/style/darkmode.css">
    <title>AIRMESS</title>
</head>
<header>
            <img class="logo" src="/Views/imgs/hermes.png" alt="">
            <h1 class="nom_site">AIRMESS</h1>
</header>
<button class="toggle-btn" onclick="toggleDarkMode()">Dark Mode</button>
<body>
    <div class="wrapper">
        <p class="form-title">Créez votre profil</p>
        <form action="../Controller/RegisterController.php" method="POST">
        <div class="input-box">
            <input required type="text" placeholder="Prénom" name="firstname" id="firstname" maxlength="50" pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+">
        </div>
        <div class="input-box">
            <input required type="text" placeholder="Nom" name="lastname" id="lastname" maxlength="50" pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+">
        </div>
        <div class="input-box">
            <input required type="text" placeholder="Pseudo" name="username" id="username" maxlength="50" pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+">
        </div>
        <div class="input-box">
            <input required type="date" name="birthdate" id="birthdate" min="1900-01-01" max="2006-12-31">
        </div>
        <div class="input-box">
            <select name="genre" id="genre" required>
                <option value="" disabled selected>Genre</option>
                <option for="Femme" id="femme" value="1">Femme</option>
                <option for="Homme" id="homme" value="2">Homme</option>
                <option for="Autres" id="autre" value="3">Non spécifié</option>
            </select>
        </div>
    <div class="input-box">
        <label for="country"></label>
        <select id="country" name="country">
            <option value="afghanistan">Afghanistan</option>
            <option value="afrique-du-sud">Afrique du Sud</option>
            <option value="albanie">Albanie</option>
            <option value="algerie">Algérie</option>
            <option value="allemagne">Allemagne</option>
            <option value="andorre">Andorre</option>
            <option value="angola">Angola</option>
            <option value="antigua-et-barbuda">Antigua-et-Barbuda</option>
            <option value="arabie-saoudite">Arabie Saoudite</option>
            <option value="argentine">Argentine</option>
            <option value="armenie">Arménie</option>
            <option value="australie">Australie</option>
            <option value="autriche">Autriche</option>
            <option value="azerbaidjan">Azerbaïdjan</option>
            <option value="bahamas">Bahamas</option>
            <option value="bahrein">Bahreïn</option>
            <option value="bangladesh">Bangladesh</option>
            <option value="barbade">Barbade</option>
            <option value="belgique">Belgique</option>
            <option value="belize">Belize</option>
            <option value="benin">Bénin</option>
            <option value="bhoutan">Bhoutan</option>
            <option value="bolivie">Bolivie</option>
            <option value="bosnie-herzegovine">Bosnie-Herzégovine</option>
            <option value="botswana">Botswana</option>
            <option value="bresil">Brésil</option>
            <option value="brunei">Brunei</option>
            <option value="bulgarie">Bulgarie</option>
            <option value="burkina-faso">Burkina Faso</option>
            <option value="burundi">Burundi</option>
            <option value="cambodge">Cambodge</option>
            <option value="cameroun">Cameroun</option>
            <option value="canada">Canada</option>
            <option value="cap-vert">Cap-Vert</option>
            <option value="chili">Chili</option>
            <option value="chine">Chine</option>
            <option value="colombie">Colombie</option>
            <option value="comores">Comores</option>
            <option value="congo">Congo</option>
            <option value="coree-du-nord">Corée du Nord</option>
            <option value="coree-du-sud">Corée du Sud</option>
            <option value="costa-rica">Costa Rica</option>
            <option value="cote-divoire">Côte d'Ivoire</option>
            <option value="croatie">Croatie</option>
            <option value="cuba">Cuba</option>
            <option value="danemark">Danemark</option>
            <option value="djibouti">Djibouti</option>
            <option value="dominique">Dominique</option>
            <option value="egypte">Égypte</option>
            <option value="emirats-arabes-unis">Émirats Arabes Unis</option>
            <option value="equateur">Équateur</option>
            <option value="erythree">Érythrée</option>
            <option value="espagne">Espagne</option>
            <option value="estonie">Estonie</option>
            <option value="etats-unis">États-Unis</option>
            <option value="ethiopie">Éthiopie</option>
            <option value="fidji">Fidji</option>
            <option value="finlande">Finlande</option>
            <option value="france">France</option>
            <option value="gabon">Gabon</option>
            <option value="gambie">Gambie</option>
            <option value="georgie">Géorgie</option>
            <option value="ghana">Ghana</option>
            <option value="grece">Grèce</option>
            <option value="guatemala">Guatemala</option>
            <option value="guinee">Guinée</option>
            <option value="guinee-bissau">Guinée-Bissau</option>
            <option value="guinee-equatoriale">Guinée équatoriale</option>
            <option value="guyana">Guyana</option>
            <option value="haiti">Haïti</option>
            <option value="honduras">Honduras</option>
            <option value="hongrie">Hongrie</option>
            <option value="inde">Inde</option>
            <option value="indonesie">Indonésie</option>
            <option value="irak">Irak</option>
            <option value="iran">Iran</option>
            <option value="irlande">Irlande</option>
            <option value="islande">Islande</option>
            <option value="israel">Israël</option>
            <option value="italie">Italie</option>
            <option value="jamaique">Jamaïque</option>
            <option value="japon">Japon</option>
            <option value="jordanie">Jordanie</option>
            <option value="kazakhstan">Kazakhstan</option>
            <option value="kenya">Kenya</option>
            <option value="kirghizistan">Kirghizistan</option>
            <option value="kiribati">Kiribati</option>
            <option value="koweit">Koweït</option>
            <option value="laos">Laos</option>
            <option value="lettonie">Lettonie</option>
            <option value="liban">Liban</option>
            <option value="liberia">Libéria</option>
            <option value="libye">Libye</option>
            <option value="liechtenstein">Liechtenstein</option>
            <option value="lituanie">Lituanie</option>
            <option value="luxembourg">Luxembourg</option>
        </select>
    </div>
    <div class="input-box">
        <input required type="text" placeholder="Ville" name="city" id="city">
    </div>
    <div class="input-box">
        <input required type="text" placeholder="E-Mail" name="email" id="email">
    </div>
    <div class="input-box">
        <input required type="password" placeholder="Mot de passe" name="password" id="password">
    </div>

    <button class="btn" type="submit">S'inscrire</button>
    <div class="register-link">
        <p>Déjà un compte ? <a href="../Views/LoginView.php" id="LL">Se connecter</a></p>
    </div>
    </form>
</div>

    <script src="../Views/js/darkmode.js"></script>
</body>
</html>