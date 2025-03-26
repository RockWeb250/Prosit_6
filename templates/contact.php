<?php
// contact.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  
  if (!defined('SESSION_TIMEOUT')) {
    define('SESSION_TIMEOUT', 30);
  }
  
  // Vérification de la connexion utilisateur
  if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
  
  }
  
  $_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
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
            <a href="contact.php"  class="active" aria-current="page">Contact</a>
            <a href="cookies.php">Cookies</a>
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

    <main>
        <h1 class="page-title">Nous sommes à votre écoute</h1>

        <form class="form-container" action="#" method="post">
            <label for="nom">Nom complet :</label>
            <input type="text" id="nom" name="nom" class="form-input" required>

            <label for="commentaires">Votre message :</label>
            <textarea id="commentaires" name="commentaires" class="form-input" rows="4" required></textarea>

            <button type="submit" class="submit-btn">Envoyer</button>
            <button type="reset" class="reset-btn">Effacer</button>
        </form>
    </main>

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
