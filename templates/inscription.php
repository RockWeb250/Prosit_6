<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('SESSION_TIMEOUT')) {
    define('SESSION_TIMEOUT', 30);
}

// Redirection si l'utilisateur est déjà connecté
if (isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}

$erreur = null;

$db_user = "user";
$db_pass = "password123";
$host = "localhost";
$db_name = "prosit7";
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $civilite = $_POST['civilite'] ?? '';
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Email invalide.";
    } elseif ($password !== $confirm) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } elseif (strlen($password) < 8) {
        $erreur = "Mot de passe trop court (8 caractères minimum).";
    } else {
        try {
            $dbh = new PDO($dsn, $db_user, $db_pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Vérifier si email déjà utilisé
            $check = $dbh->prepare("SELECT id FROM utilisateurs WHERE email = ?");
            $check->execute([$email]);

            if ($check->fetch()) {
                $erreur = "Cet email est déjà utilisé.";
            } else {
                // Insertion utilisateur
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $dbh->prepare("INSERT INTO utilisateurs (email, motDePasse, civilite, nom, prenom) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$email, $passwordHash, $civilite, $nom, $prenom]);
                $userId = $dbh->lastInsertId();

                // Attribution du rôle par défaut ("étudiant" = role_id = 3)
                $stmtRole = $dbh->prepare("INSERT INTO utilisateur_role (utilisateur_id, role_id) VALUES (?, ?)");
                $stmtRole->execute([$userId, 3]);

                // Authentifier immédiatement
                $_SESSION['user'] = [
                    'id' => $userId,
                    'email' => $email,
                    'prenom' => $prenom,
                    'nom' => $nom
                ];
                $_SESSION['last_activity'] = time();

                header('Location: ../index.php');
                exit;
            }
        } catch (PDOException $e) {
            $erreur = "Erreur SQL : " . $e->getMessage();
        }
    }
}
?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
    <div style="text-align: center;">
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

    <h1 class="page-title"> Créez un compte </h1>
    <?php if (!empty($erreur)): ?>
    <p style="color: red; text-align: center;"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>
    <div class="form-container">
        <form action="inscription.php" method="post">
            <label for="civilite">Civilité :</label>
            <select id="civilite" name="civilite">
                <option value="madame">Madame</option>
                <option value="monsieur">Monsieur</option>
            </select>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="email">Courriel :</label>
            <input type="email" id="email" name="email" required>

            <hr>

            <label for="password">Mot de Passe (au moins 8 caractères): </label>
            <input type="password" id="password" name="password" minlength="8" required>

            <label for="confirm_password">Confirmation du Mot de Passe: </label>
            <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>

            <button type="submit" class="submit-btn">Postuler</button>
            <button type="reset" class="reset-btn">Réinitialiser</button>
        </form>
    </div>

    <script src="../js/inscription.js"></script>
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