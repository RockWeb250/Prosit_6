<?php
// inscription.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div style="text-align: center;">
        <img src="../Images/BonPlan.png" alt="Le Bon Plan" class="logo">
    </div>

    <nav class="navbar">
        <a href="../index.php">Accueil</a>
        <a href="a-propos.php">À Propos</a>
        <a href="inscription.php" class="active" aria-current="page">Inscription</a>
        <a href="offre.php">Offres</a>
        <a href="connexion.php">Connexion</a>
        <a href="avis.php">Avis</a>
        <a href="contact.php">Contact</a>
        <a href="cookies.php">Cookies</a>
    </nav>

    <h1 class="page-title"> Créez un compte </h1>
    <div class="form-container">
        <form action="#" method="post" onsubmit="return false;">
            <label for="civilite">Civilité :</label>
            <select id="civilite" name="civilite">
                <option value="madame">Madame</option>
                <option value="monsieur">Monsieur</option>
            </select>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="email">Courriel :</label>
            <input type="email" id="email" name="email" required>

            <hr>

            <label for="password">Mot de Passe (au moins 8 caractères): </label>
            <input type="password" id="password" name="password" minlength="8" required>

            <label for="confirm_password">Confirmation du Mot de Passe: </label>
            <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>

            <button type="submit" class="submit-btn">Postuler</button>
            <button type="reset" class="reset-btn">Réinitialiser</button>
        </form>
    </div>

    <script src="../js/inscription.js"></script>
    <script src="../js/interaction.js"></script>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Mentions Légales</h4>
                <p>&copy; 2025 - Tous droits réservés</p>
                <p>Hébergeur : CESI</p>
                <p>Adresse : 80 avenue Edmund Halley Rouen Madrillet Innovation, 76800 Saint-Étienne-du-Rouvray</p>
                <p>Tél : 02 32 81 85 60</p>
                <p>Raison Sociale : Entreprise de services informatiques</p>
            </div>
            <hr>
            <div class="footer-column">
                <p><a href="politique-confidentialite.php" class="footer-link">Politique de confidentialité</a></p>
            </div>
        </div>
    </footer>

</body>
</html>
