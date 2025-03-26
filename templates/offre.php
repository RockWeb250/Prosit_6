<?php
// offre.php

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

$offers = [
    [
        "id" => 1,
        "titre" => "Stage - Administrateur Système et Réseau H/F",
        "entreprise" => "BM",
        "localisation" => "Pornichet",
        "publie_le" => "28/01/2025",
        "reference" => "12371-44",
        "lien" => "Offres_PHP/offre1.php"
    ],
    [
        "id" => 2,
        "titre" => "Stage - Analyste Cybersécurité",
        "entreprise" => "SecureTech",
        "localisation" => "Paris",
        "publie_le" => "03/03/2025",
        "reference" => "20451-69",
        "lien" => "Offres_PHP/offre2.php"
    ],
    [
        "id" => 3,
        "titre" => "Stage - Ingénieur en Intelligence Artificielle",
        "entreprise" => "AI Solutions",
        "localisation" => "Toulouse",
        "publie_le" => "03/03/2025",
        "reference" => "30562-75",
        "lien" => "Offres_PHP/offre3.php"
    ],
    [
        "id" => 4,
        "titre" => "Stage - Chef de Projet Digital",
        "entreprise" => "WebMaster Group",
        "localisation" => "Marseille",
        "publie_le" => "03/03/2025",
        "reference" => "50123-31",
        "lien" => "Offres_PHP/offre4.php"
    ],
    [
        "id" => 5,
        "titre" => "Stage - Développeur Mobile iOS/Android",
        "entreprise" => "AppTech",
        "localisation" => "Nantes",
        "publie_le" => "03/03/2025",
        "reference" => "70345-44",
        "lien" => "Offres_PHP/offre5.php"
    ],
    [
        "id" => 6,
        "titre" => "Stage - Consultant en Stratégie",
        "entreprise" => "StratUp",
        "localisation" => "Lille",
        "publie_le" => "03/03/2025",
        "reference" => "70345-44",
        "lien" => "Offres_PHP/offre6.php"
    ],
    [
        "id" => 7,
        "titre" => "Stage - Graphiste UI/UX Designer",
        "entreprise" => "CreativeVision",
        "localisation" => "Bordeaux",
        "publie_le" => "03/03/2025",
        "reference" => "80467-59",
        "lien" => "Offres_PHP/offre7.php"
    ],
    [
        "id" => 8,
        "titre" => "Stage - Ingénieur DevOps",
        "entreprise" => "CloudOps Solutions",
        "localisation" => "Rennes",
        "publie_le" => "03/03/2025",
        "reference" => "80467-59",
        "lien" => "Offres_PHP/offre8.php"
    ],
    [
        "id" => 9,
        "titre" => "Stage - Data Analyst",
        "entreprise" => "DataVision",
        "localisation" => "Strasbourg",
        "publie_le" => "03/03/2025",
        "reference" => "80467-59",
        "lien" => "Offres_PHP/offre9.php"
    ],
    [
        "id" => 10,
        "titre" => "Stage - Simulation en Laboratoire",
        "entreprise" => "LaboScience",
        "localisation" => "Nice",
        "publie_le" => "03/03/2025",
        "reference" => "80467-59",
        "lien" => "Offres_PHP/offre10.php"
    ],
    [
        "id" => 11,
        "titre" => "Stage - Analyste Financier",
        "entreprise" => "SoftLink",
        "localisation" => "Lyon",
        "publie_le" => "03/03/2025",
        "reference" => "80467-01",
        "lien" => "Offres_PHP/offre11.php"
    ],
    [
        "id" => 12,
        "titre" => "Stage - Ingénieur en Systèmes Embarqués",
        "entreprise" => "TechInnov",
        "localisation" => "Grenoble",
        "publie_le" => "03/03/2025",
        "reference" => "80467-02",
        "lien" => "Offres_PHP/offre12.php"
    ],
    [
        "id" => 13,
        "titre" => "Stage - Data Scientist",
        "entreprise" => "DataSphere",
        "localisation" => "Montpellier",
        "publie_le" => "03/03/2025",
        "reference" => "80467-03",
        "lien" => "Offres_PHP/offre13.php"
    ],
    [
        "id" => 14,
        "titre" => "Stage - Développeur Web Full-Stack",
        "entreprise" => "CodeNation",
        "localisation" => "Lille",
        "publie_le" => "03/03/2025",
        "reference" => "80467-04",
        "lien" => "Offres_PHP/offre14.php"
    ],
    [
        "id" => 15,
        "titre" => "Stage - Consultant Marketing Digital",
        "entreprise" => "MarketBoost",
        "localisation" => "Nantes",
        "publie_le" => "03/03/2025",
        "reference" => "80467-05",
        "lien" => "Offres_PHP/offre15.php"
    ],
    [
        "id" => 16,
        "titre" => "Stage - Développeur Blockchain",
        "entreprise" => "CryptoFuture",
        "localisation" => "Paris",
        "publie_le" => "03/03/2025",
        "reference" => "80467-06",
        "lien" => "Offres_PHP/offre16.php"
    ],
    [
        "id" => 17,
        "titre" => "Stage - Chargé de Communication",
        "entreprise" => "MediaConnect",
        "localisation" => "Bordeaux",
        "publie_le" => "03/03/2025",
        "reference" => "80467-07",
        "lien" => "Offres_PHP/offre17.php"
    ],
    [
        "id" => 18,
        "titre" => "Stage - Ingénieur Cloud & DevOps",
        "entreprise" => "CloudInfinity",
        "localisation" => "Rennes",
        "publie_le" => "03/03/2025",
        "reference" => "80467-08",
        "lien" => "Offres_PHP/offre18.php"
    ],
    [
        "id" => 19,
        "titre" => "Stage - Responsable Énergies Renouvelables",
        "entreprise" => "GreenTech",
        "localisation" => "Toulouse",
        "publie_le" => "03/03/2025",
        "reference" => "80467-09",
        "lien" => "Offres_PHP/offre19.php"
    ],
    [
        "id" => 20,
        "titre" => "Stage - Consultant Supply Chain",
        "entreprise" => "LogiFlow",
        "localisation" => "Marseille",
        "publie_le" => "03/03/2025",
        "reference" => "80467-10",
        "lien" => "Offres_PHP/offre20.php"
    ]
];

$perPage = 10;
$totalItems = count($offers);
$totalPages = ceil($totalItems / $perPage);
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0
    ? (int) $_GET['page']
    : 1;
$page = max(1, min($page, $totalPages));

$start = ($page - 1) * $perPage;
$offersPage = array_slice($offers, $start, $perPage);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Offres de Stage</title>
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
            <a href="offre.php" class="active" aria-current="page">Offres</a>
            <a href="avis.php">Avis</a>
            <a href="contact.php">Contact</a>
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

    <main class="content">
        <h1 class="page-title">Offres de Stage</h1>

        <form class="search-form">
            <label for="motcle">Mot-clé :</label>
            <input type="text" id="motcle" name="motcle">
            <button type="submit" class="submit-btn">Rechercher</button>
            <button type="reset" class="reset-btn">Effacer</button>
        </form>


        <?php if (isset($_SESSION['user']) && empty($_SESSION['user'])): ?>
        <div class="status-button-container">
            <a href="/Prosit_6/index.php?uri=show_status" class="btn-status">⭢ Voir mes candidatures</a>
        </div>
        <?php endif; ?>

        <h3 class="categorie-title">Liste des offres disponibles</h3>
        <div class="offers-container">
            <?php foreach ($offersPage as $offer): ?>
                <div class="offer-card" data-offre-id="<?php echo $offer['id']; ?>">
                    <h4><?php echo htmlspecialchars($offer['titre']); ?></h4>
                    <p>
                        Entreprise : <?php echo htmlspecialchars($offer['entreprise']); ?> |
                        Localisation : <?php echo htmlspecialchars($offer['localisation']); ?>
                    </p>
                    <a href="<?php echo $offer['lien']; ?>" class="btn-voir">Voir</a>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
        echo "<div class='pagination'>";
        if ($page == 1) {
            // Page 1 active
            echo "<a href='#' class='page-active'>1</a>";
            if ($totalPages > 1) {
                // Bouton "Page Suivante"
                echo "<a href='offre.php?page=" . ($page + 1) . "'>Page Suivante</a>";
            }
        } else if ($page > 1 && $page < $totalPages) {
            // Pages intermédiaires : Page Précédente, page active, Page Suivante
            echo "<a href='offre.php?page=" . ($page - 1) . "'>Page Précédente</a>";
            echo "<a href='#' class='page-active'>$page</a>";
            echo "<a href='offre.php?page=" . ($page + 1) . "'>Page Suivante</a>";
        } else if ($page == $totalPages && $totalPages > 1) {
            // Dernière page : seulement Page Précédente
            echo "<a href='offre.php?page=" . ($page - 1) . "'>Page Précédente</a>";
            echo "<a href='#' class='page-active'>$page</a>";
        }
        echo "</div>";
        ?>
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