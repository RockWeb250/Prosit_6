<?php
// cookies.php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lebonplan - Cookies</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <header>
        <div class="text-center">
            <img src="../Images/BonPlan.png" alt="Le Bon Plan" class="logo">
        </div>
        <nav class="navbar">
            <a href="home.php">Accueil</a>
            <a href="a-propos.php">À Propos</a>
            <a href="inscription.php">Inscription</a>
            <a href="offre.php">Offres</a>
            <a href="connexion.php">Connexion</a>
            <a href="avis.php">Avis</a>
            <a href="contact.php">Contact</a>
            <a href="cookies.php" class="active" aria-current="page">Cookies</a>
        </nav>
    </header>

    <main class="content-container">
        <h2 class="page-title">Gestion des Cookies</h2>

        <div class="cookie-box">
            <p><strong>Ce site utilise des cookies pour améliorer votre expérience.</strong></p>
            <p>Acceptez-vous les cookies ?</p>

            <form id="cookies-form">
                <fieldset class="cookie-options">
                    <label>
                        Oui
                        <input type="radio" name="cookies" value="yes">
                    </label>
                    <label>
                        Non
                        <input type="radio" name="cookies" value="no">
                    </label>
                </fieldset>
                <br>
                <button type="submit" class="submit-btn">Valider</button>
            </form>
        </div>
    </main>

    <script src="../js/cookies.js"></script>
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