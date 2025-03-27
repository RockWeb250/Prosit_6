<?php

$db_user = "user";
$db_pass = "password123";
$host = "localhost";
$db_name = "prosit7";
$charset = 'utf8mb4';

session_start();

// Expiration automatique après 30 minutes d'inactivité
define('SESSION_TIMEOUT', 30);
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > (SESSION_TIMEOUT * 60)) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['last_activity'] = time();

$errorMessage = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
    
    try {
        $dbh = new PDO($dsn, $db_user, $db_pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération de l'utilisateur par email
        $stmt = $dbh->prepare("SELECT id, email, motDePasse, role_id FROM utilisateurs WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if ($result !== false) {
            // Compare le $password (en clair) avec le hash en base
            if (password_verify($password, $result->motDePasse)) {
                // Mot de passe OK, on connecte l'utilisateur
                $_SESSION['user'] = [
                    'id' => $result->id,
                    'email' => $result->email,
                    'role_id' => $result->role_id
                ];
                $_SESSION['last_activity'] = time();

                // Supprimer le cookie de consentement s'il existait (nouvelle session utilisateur)
                if (isset($_COOKIE['consentement_cookies'])) {
                    setcookie('consentement_cookies', '', time() - 3600, '/');
                }

                // Redirection vers la page d'accueil (ou où tu veux)
                header('Location: mon-compte.php');
                exit;
            } else {
                $errorMessage = "Mot de passe incorrect.";
            }
        } else {
            $errorMessage = "Utilisateur introuvable.";
        }

    } catch (PDOException $e) {
        $errorMessage = "Erreur SQL : " . $e->getMessage();
    }
}

// ⚠️ Suppression du cookie déplacée plus haut : ici on ne touche plus à rien

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
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
            <a href="connexion.php" class="active" aria-current="page">Connexion</a>
        </nav>
    </header>

    <main>
        <h2 class="page-title">Formulaire de connexion</h2>

        <?php if (isset($_GET['timeout']) && $_GET['timeout'] == 1): ?>
            <p style="color:orange; text-align:center;">
                Votre session a expiré pour cause d'inactivité. Veuillez vous reconnecter.
            </p>
        <?php endif; ?>

        <?php if (isset($errorMessage)): ?>
            <p style="color:red; text-align:center;"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>

        <form class="form-container" method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" class="form-input" required>

            <label for="password">Mot de Passe :</label>
            <input type="password" id="password" name="password" class="form-input" required>

            <button type="submit" class="submit-btn">Connexion</button>
            <button type="reset" class="reset-btn">Effacer</button>
            <a href="inscription.php" class="inscription-btn">Je n'ai pas de compte.</a>
        </form>
    </main>

    <script src="../js/connexion.js"></script>
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