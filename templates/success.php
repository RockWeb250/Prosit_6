<?php
// success.php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidature Envoyée</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <header>
        <div class="text-center">
            <img src="../Images/BonPlan.png" alt="Le Bon Plan" class="logo">
        </div>
        <nav class="navbar">
            <a href="index.php">Accueil</a>
            <a href="a-propos.php">À Propos</a>
            <a href="inscription.php">Inscription</a>
            <a href="offre.php" class="active" aria-current="page">Offres</a>
            <a href="connexion.php">Connexion</a>
            <a href="avis.php">Avis</a>
            <a href="contact.php">Contact</a>
            <a href="cookies.php">Cookies</a>
        </nav>
    </header>

    <main class="content">
        <div class="success-container">
            <h1>Candidature Envoyée</h1>
            <p>Merci pour votre candidature !</p>
            <p>Nous avons bien reçu votre CV et vous enverrons une confirmation par email sous peu.</p>
            <a href="offre.php" class="btn-voir">Retour aux offres</a>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Mentions Légales</h4>
                <p>Hébergeur : CESI</p>
                <p>Adresse : 80 avenue Edmund Halley Rouen Madrillet Innovation, 76800 Saint-Étienne-du-Rouvray</p>
                <p>Tél : 02 32 81 85 60</p>
                <p>Raison Sociale : Entreprise de services informatiques</p>
            </div>
            <div class="footer-column">
                <h4>Autres Informations</h4>
                <p>&copy; 2025 - Tous droits réservés</p>
                <p><a href="politique-confidentialite.php">Politique de confidentialité</a></p>
            </div>
        </div>
    </footer>

    <script src="../js/interaction.js"></script>
</body>

</html>