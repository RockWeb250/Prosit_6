<?php
// cookies.php

// Démarrer la session si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Définir une constante de timeout si non définie
if (!defined('SESSION_TIMEOUT')) {
    define('SESSION_TIMEOUT', 30);
}

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

// Mettre à jour l'activité de session
$_SESSION['last_activity'] = time();

// Gérer la soumission du formulaire des cookies
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cookies'])) {
    $choix = $_POST['cookies'];

    if ($choix === 'reset') {
        setcookie('consentement_cookies', '', time() - 3600, '/', '', isset($_SERVER['HTTPS']), true);
        unset($_SESSION['consentement_cookies']);
    } elseif (in_array($choix, ['yes', 'no'])) {
        $valeur = $choix === 'yes' ? 'oui' : 'non';
        setcookie('consentement_cookies', $valeur, time() + 365 * 24 * 60 * 60, '/', '', isset($_SERVER['HTTPS']), true);
        $_SESSION['consentement_cookies'] = $valeur;
    }

    header('Location: cookies.php');
    exit;
}


// Préférence actuelle stockée (session prioritaire, sinon cookie)
$consentement = $_SESSION['consentement_cookies'] ?? $_COOKIE['consentement_cookies'] ?? null;

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
            <a href="../index.php">Accueil</a>
            <a href="a-propos.php">À Propos</a>
            <a href="offre.php">Offres</a>
            <a href="avis.php">Avis</a>
            <a href="contact.php">Contact</a>
            <a href="cookies.php" class="active" aria-current="page">Cookies</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="mon-compte.php">Mon Compte</a>
                <form action="deconnexion.php" method="POST" class="logout-form">
                    <button type="submit" class="logout-button">Déconnexion</button>
                </form>
            <?php else: ?>
                <a href="inscription.php">Inscription</a>
                <a href="connexion.php">Connexion</a>
            <?php endif; ?>
        </nav>
    </header>

    <main class="content-container">
        <h2 class="page-title">Gestion des Cookies</h2>

        <div class="cookie-box">
            <p><strong>Ce site utilise des cookies pour améliorer votre expérience.</strong></p>
            <p>Acceptez-vous les cookies ?</p>

            <form id="cookies-form" method="post">
                <fieldset class="cookie-options">
                    <label>
                        Oui
                        <input type="radio" name="cookies" value="yes" <?= $consentement === 'oui' ? 'checked' : '' ?>>
                    </label>
                    <label>
                        Non
                        <input type="radio" name="cookies" value="no" <?= $consentement === 'non' ? 'checked' : '' ?>>
                    </label>
                </fieldset>
                <br>
                <button type="submit" class="submit-btn">Valider</button>
            </form>

            <?php if ($consentement): ?>
                <p style="margin-top: 10px;">
                    Préférence actuelle :
                    <strong>
                        <?= $consentement === 'oui' ? 'Cookies acceptés' : 'Cookies refusés' ?>
                    </strong>
                </p>

                <form method="post" style="margin-top: 10px;">
                    <input type="hidden" name="cookies" value="reset">
                    <button type="submit" class="reset-btn">Réinitialiser le choix</button>
                </form>
            <?php endif; ?>
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