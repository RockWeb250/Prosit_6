<?php
// contact.php
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
            <a href="home.php">Accueil</a>
            <a href="a-propos.php">À Propos</a>
            <a href="inscription.php">Inscription</a>
            <a href="offre.php">Offres</a>
            <a href="connexion.php">Connexion</a>
            <a href="avis.php">Avis</a>
            <a href="contact.php" class="active" aria-current="page">Contact</a>
            <a href="cookies.php">Cookies</a>
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
