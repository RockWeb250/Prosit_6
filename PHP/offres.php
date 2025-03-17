<?php
// offres.php (Page 2)
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Offres de Stage</title>
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
      <a href="contact.php">Contact</a>
      <a href="cookies.php">Cookies</a>
    </nav>
  </header>

  <main class="content">
    <h1 class="page-title">Offres de Stage</h1>
    <form class="search-form">
      <label for="motcle">Mot-clé :</label>
      <input type="text" id="motcle" name="motcle">
      <button type="submit" class="submit-btn">Rechercher</button>
      <button type="reset" class="reset-btn">Effacer</button>
    </form>

    <h3 class="categorie-title">Liste des offres disponibles</h3>
    <div class="offers-container">
      <div class="offer-card" data-offre-id="offre1">
        <h4>Stage - Analyste Financier</h4>
        <p>Entreprise : SoftLink | Localisation : Lyon</p>
        <a href="Offres_PHP/offre11.php" class="btn-voir">Voir</a>
      </div>
      <div class="offer-card" data-offre-id="offre2">
        <h4>Stage - Ingénieur en Systèmes Embarqués</h4>
        <p>Entreprise : TechInnov | Localisation : Grenoble</p>
        <a href="Offres_PHP/offre12.php" class="btn-voir">Voir</a>
      </div>
      <div class="offer-card" data-offre-id="offre3">
        <h4>Stage - Data Scientist</h4>
        <p>Entreprise : DataSphere | Localisation : Montpellier</p>
        <a href="Offres_PHP/offre13.php" class="btn-voir">Voir</a>
      </div>
      <div class="offer-card" data-offre-id="offre4">
        <h4>Stage - Développeur Web Full-Stack</h4>
        <p>Entreprise : CodeNation | Localisation : Lille</p>
        <a href="Offres_PHP/offre14.php" class="btn-voir">Voir</a>
      </div>
      <div class="offer-card" data-offre-id="offre5">
        <h4>Stage - Consultant Marketing Digital</h4>
        <p>Entreprise : MarketBoost | Localisation : Nantes</p>
        <a href="Offres_PHP/offre15.php" class="btn-voir">Voir</a>
      </div>
      <div class="offer-card" data-offre-id="offre6">
        <h4>Stage - Développeur Blockchain</h4>
        <p>Entreprise : CryptoFuture | Localisation : Paris</p>
        <a href="Offres_PHP/offre16.php" class="btn-voir">Voir</a>
      </div>
      <div class="offer-card" data-offre-id="offre7">
        <h4>Stage - Chargé de Communication</h4>
        <p>Entreprise : MediaConnect | Localisation : Bordeaux</p>
        <a href="Offres_PHP/offre17.php" class="btn-voir">Voir</a>
      </div>
      <div class="offer-card" data-offre-id="offre8">
        <h4>Stage - Ingénieur Cloud & DevOps</h4>
        <p>Entreprise : CloudInfinity | Localisation : Rennes</p>
        <a href="Offres_PHP/offre18.php" class="btn-voir">Voir</a>
      </div>
      <div class="offer-card" data-offre-id="offre9">
        <h4>Stage - Responsable Énergies Renouvelables</h4>
        <p>Entreprise : GreenTech | Localisation : Toulouse</p>
        <a href="Offres_PHP/offre19.php" class="btn-voir">Voir</a>
      </div>
      <div class="offer-card" data-offre-id="offre10">
        <h4>Stage - Consultant Supply Chain</h4>
        <p>Entreprise : LogiFlow | Localisation : Marseille</p>
        <a href="Offres_PHP/offre20.php" class="btn-voir">Voir</a>
      </div>
    </div>

    <div class="pagination">
      <a href="offre.php" class="page-link">Page Précédente</a>
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
  <script src="../js/recherche.js"></script>
</body>

</html>