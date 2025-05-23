<?php
// index.php
?>
<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lebonplan - Site d'annonces</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <header>
        <div class="text-center">
            <img src="../Images/BonPlan.png" alt="Le Bon Plan" class="logo">
        </div>
        <nav class="navbar">
            <a href="index.php" class="active" aria-current="page">Accueil</a>
            <a href="a-propos.php">À Propos</a>
            <a href="inscription.php">Inscription</a>
            <a href="offre.php">Offres</a>
            <a href="connexion.php">Connexion</a>
            <a href="avis.php">Avis</a>
            <a href="contact.php">Contact</a>
            <a href="cookies.php">Cookies</a>
        </nav>
    </header>
    
    <main>
        <h2 class="page-title">Bienvenue sur Lebonplan</h2>
        <p>Votre site d'annonces en ligne pour acheter et vendre en toute simplicité.</p>

        <h3>Catégories</h3>
        <ul class="categories">
            <li><a href="immobilier.php">Immobilier</a></li>
            <li><a href="vehicule.php">Véhicules</a></li>
            <li><a href="vetements.php">Vêtements</a></li>
            <li><a href="multimedia.php">Multimédia</a></li>
            <li><a href="maison.php">Maison</a></li>
            <li><a href="loisirs.php">Loisirs</a></li>
            <li><a href="services.php">Services</a></li>
        </ul>

        <h3>Derniers articles ajoutés</h3>
        <div class="table-container">
            <table class="articles-table">
                <thead>
                    <tr>
                        <th>Intitulé</th>
                        <th>Localisation</th>
                        <th>Vendeur</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Description 1</td>
                        <td>Ville</td>
                        <td>Nom</td>
                        <td>X €</td>
                    </tr>
                    <tr>
                        <td>Description 2</td>
                        <td>Ville</td>
                        <td>Nom</td>
                        <td>X €</td>
                    </tr>
                    <tr>
                        <td>Description 3</td>
                        <td>Ville</td>
                        <td>Nom</td>
                        <td>X €</td>
                    </tr>
                </tbody>
            </table>
        </div>

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
