<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/config.php'; // S'assurer que BASE_URL est bien chargé
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
        <img src="<?= BASE_URL ?>images/BonPlan.png" alt="Le Bon Plan" class="logo">
    </div>

    <nav class="navbar">
        <a href="<?= BASE_URL ?>index.php" class="active">Accueil</a>
        <a href="<?= BASE_URL ?>index.php?uri=about">À Propos</a>
        <a href="<?= BASE_URL ?>index.php?uri=offres">Offres</a>
        <a href="<?= BASE_URL ?>index.php?uri=avis">Avis</a>
        <a href="<?= BASE_URL ?>index.php?uri=contact">Contact</a>
        <a href="<?= BASE_URL ?>index.php?uri=cookies">Cookies</a>

        <?php if (isset($_SESSION['user'])): ?>
            <?php if (!empty($_SESSION['user']->role) && $_SESSION['user']->role === 'Admin'): ?>
                <a href="<?= BASE_URL ?>index.php?uri=dashboard">Admin Panel</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>

    <div class="auth-container">
        <?php if (isset($_SESSION['user'])): ?>
            <div class="user-info">
                Bienvenue <?= htmlspecialchars($_SESSION['user']->prenom ?? $_SESSION['user']->email) ?> |
                <form action="<?= BASE_URL ?>index.php?uri=logout" method="POST" style="display:inline;">
                    <button type="submit" class="logout-btn">Déconnexion</button>
                </form>
            </div>
        <?php else: ?>
            <a href="<?= BASE_URL ?>index.php?uri=login" class="btn-login">Connexion</a>
            <a href="<?= BASE_URL ?>index.php?uri=register" class="btn-register">Inscription</a>
        <?php endif; ?>
    </div>
</header>
