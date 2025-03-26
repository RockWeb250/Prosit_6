<?php
// mon-compte.php
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

// Connexion à la base de données
$db_user = "user";
$db_pass = "password123";
$host = "localhost";
$dbname = "prosit7";
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Exemple : récupérer toutes les offres
    $stmt = $pdo->query("SELECT * FROM offres");
    $offres = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > (SESSION_TIMEOUT * 60)) {
    session_unset();
    session_destroy();
    header('Location: connexion.php?timeout=1');
    exit;
}

$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Lebonplan</title>
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
            <a href="cookies.php">Cookies</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="mon-compte.php" class="active" aria-current="page">Mon Compte</a>
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
        <h2 class="page-title">Bienvenue sur votre espace personnel</h2>

        <div class="offers-container">
            <div class="offer-card">
                <a href="/Prosit_6/index.php?uri=show_status" class="btn-status">Mes candidatures</a>
            </div>
            <div class="offer-card">
                <a href="offre.php" class="btn-status">Les Offres</a>
            </div>
        </div>
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