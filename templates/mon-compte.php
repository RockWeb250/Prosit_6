<?php
// mon-compte.php

use App\PermissionManager;

require_once __DIR__ . '/../src/PermissionManager.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!defined('SESSION_TIMEOUT')) {
    define('SESSION_TIMEOUT', 30);
}

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > (SESSION_TIMEOUT * 60)) {
    session_unset();
    session_destroy();
    header('Location: connexion.php?timeout=1');
    exit;
};

$_SESSION['last_activity'] = time();

$role = ucfirst(strtolower(trim($_SESSION['user']->role ?? 'etudiant')));

$pm = new PermissionManager();
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
                <a href="informations.php" class="btn-status">Mes Infos</a>
            </div>

            <!-- Candidatures : étudiants uniquement -->
            <?php if ($pm->hasAccess($role, 'SFx22') && $role === 'Etudiant'): ?>
                <div class="offer-card">
                    <a href="/Prosit_6/index.php?uri=show_status" class="btn-status">Mes candidatures</a>
                </div>
            <?php endif; ?>

            <!-- Accès aux étudiants -->
            <?php if ($pm->hasAccess($role, 'SFx3')): ?>
                <div class="offer-card">
                    <a href="gestion_etudiants.php" class="btn-status">Étudiants</a>
                </div>
            <?php endif; ?>

            <!-- Accès aux offres -->
            <?php if ($pm->hasAccess($role, 'SFx8')): ?>
                <div class="offer-card">
                    <a href="gestion_offres.php" class="btn-status">Offres</a>
                </div>
            <?php endif; ?>

            <!-- Gérer les pilotes : uniquement Admin -->
            <?php if ($pm->hasAccess($role, 'SFx13')): ?>
                <div class="offer-card">
                    <a href="gestion_pilotes.php" class="btn-status">Gérer les pilotes</a>
                </div>
            <?php endif; ?>
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
