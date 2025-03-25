<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined('BASE_URL')) {
    define('BASE_URL', '/'); // ou adapte selon ton arborescence
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lebonplan - Site d'annonces</title>
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>css/styles.css">
</head>

<body>
<header>
    <div class="text-center">
        <img src="<?= BASE_URL ?>Images/BonPlan.png" alt="Le Bon Plan" class="logo">
    </div>
    
    <nav class="navbar">
        <a href="<?= BASE_URL ?>index.php" class="active">Accueil</a>
        <a href="<?= BASE_URL ?>templates/a-propos.php">À Propos</a>
        <a href="<?= BASE_URL ?>templates/offre.php">Offres</a>
        <a href="<?= BASE_URL ?>templates/avis.php">Avis</a>
        <a href="<?= BASE_URL ?>templates/contact.php">Contact</a>
        <a href="<?= BASE_URL ?>templates/cookies.php">Cookies</a>

        <?php if (isset($_SESSION['user'])): ?>
            <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
                <a href="<?= BASE_URL ?>index.php?controller=dashboard&action=index">Admin Panel</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>

    <div class="auth-container">
        <?php if (isset($_SESSION['user'])): ?>
            <div class="user-info">
                Bienvenue <strong><?= htmlspecialchars($_SESSION['user']['prenom']) ?></strong> |
                <form action="<?= BASE_URL ?>index.php?controller=utilisateur&action=logout" method="POST" style="display:inline;">
                    <button type="submit" class="logout-btn">Déconnexion</button>
                </form>
            </div>
        <?php else: ?>
            <a href="<?= BASE_URL ?>templates/connexion.php" class="btn-login">Connexion</a>
            <a href="<?= BASE_URL ?>templates/inscription.php" class="btn-register">Inscription</a>
        <?php endif; ?>
    </div>
</header>
