<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $dsn = "mysql:host=localhost;dbname=offres_stage;charset=utf8mb4";
    $db_user = "root"; // adapte si besoin
    $db_pass = "";     // ton mot de passe MySQL

    try {
        $pdo = new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudo = ? LIMIT 1");
        $stmt->execute([$email]); // on suppose ici que `pseudo = email`

        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user && password_verify($password, $user->motDePasse)) {
            echo "<p style='color:green;text-align:center;'>Bienvenue, {$user->pseudo} !</p>";
        } else {
            echo "<p style='color:red;text-align:center;'>Identifiants incorrects.</p>";
        }
    } catch (PDOException $e) {
        echo "<p style='color:red'>Erreur SQL : " . $e->getMessage() . "</p>";
    }
}
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
            <a href="inscription.php">Inscription</a>
            <a href="offre.php">Offres</a>
            <a href="connexion.php" class="active" aria-current="page">Connexion</a>
            <a href="avis.php">Avis</a>
            <a href="contact.php">Contact</a>
            <a href="cookies.php">Cookies</a>
        </nav>
    </header>

    <main>
        <h2 class="page-title">Formulaire de connexion</h2>

        <form class="form-container" method="post">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" class="form-input" required>

            <label for="password">Mot de Passe :</label>
            <input type="password" id="password" name="password" class="form-input" required>

            <button type="submit" class="submit-btn">Connexion</button>
            <button type="reset" class="reset-btn">Effacer</button>
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
