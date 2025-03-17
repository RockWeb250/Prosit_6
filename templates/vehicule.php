<?php
// vehicule.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules - Lebonplan</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div style="text-align: center;">
        <img src="../Images/BonPlan.png" alt="Le Bon Plan" class="logo">
    </div>
  
    <nav class="navbar">
        <a href="index.php">Accueil</a>
        <a href="immobilier.php">Immobilier</a>
        <a href="vehicule.php" class="active" aria-current="page">Véhicules</a>
        <a href="vetements.php">Vêtements</a>
        <a href="multimedia.php">Multimédia</a>
        <a href="maison.php">Maison</a>
        <a href="loisirs.php">Loisirs</a>
        <a href="services.php">Services</a>
    </nav>

    <header>
        <div class="header-bar">
            <h1 class="categorie-title">Véhicules</h1>
        </div>
    </header>
    
    <main class="content-container">
        <h2 class="section-title">Annonces Véhicules</h2>
        <p>Retrouvez ici toutes les annonces disponibles dans la catégorie Véhicules.</p>
        
        <section class="annonces">
            <p>Aucune annonce disponible pour le moment.</p>
        </section>
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
