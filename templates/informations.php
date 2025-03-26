<?php
session_start();

// Vérification de la connexion utilisateur
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['user']['id'];

// Paramètres de connexion
$db_user = "user";
$db_pass = "password123";
$host    = "localhost";
$db_name = "prosit7";

// Créer la connexion avec mysqli
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Préparer la requête pour récupérer les infos de l'utilisateur
$stmt = $conn->prepare("SELECT id, email, civilite, nom, prenom FROM utilisateurs WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$userInfo = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
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
            <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                <a href="mon-compte.php" class="active">Mon Compte</a>
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

        <h2 class="page-title">Bienvenue dans votre espace personnel</h2>

        <section class="formulaire">
            <?php if ($userInfo): ?>
                <div class="cookie-box">
                    <div class="resume-offre">
                        <p style="text-align : center"><span>ID : <?php echo htmlspecialchars($userInfo['id']); ?></span></p>
                        <p style="text-align : center"><span>Email : <?php echo htmlspecialchars($userInfo['email']); ?></span></p>
                        <p style="text-align : center"><span>Civilité : <?php echo htmlspecialchars($userInfo['civilite']); ?></span></p>
                        <p style="text-align : center"><span>Nom : <?php echo htmlspecialchars($userInfo['nom']); ?></span></p>
                        <p style="text-align : center"><span>Prénom : <?php echo htmlspecialchars($userInfo['prenom']); ?></span></p>
                    </div>
                </div>
            <?php else: ?>
                <p>Aucune information trouvée pour cet utilisateur.</p>
            <?php endif; ?>
        </section>

        <div class="back-to-offers">
            <button class="back-btn" onclick="window.location.href='mon-compte.php';">⭠ Retour</button>
        </div>
    </main>

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
