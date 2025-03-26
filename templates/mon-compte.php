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
}

$_SESSION['last_activity'] = time();

// 🔧 Normalisation complète du rôle
$rawRole = $_SESSION['user']->role ?? 'etudiant';
$normalized = strtolower(trim($rawRole));

switch ($normalized) {
    case 'admin':
        $role = 'Administrateur';
        break;
    case 'pilote':
        $role = 'Pilote';
        break;
    case 'étudiant':
    case 'etudiant':
        $role = 'Etudiant';
        break;
    default:
        $role = 'Inconnu';
        break;
}

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

            <!-- Infos : accessible à tous -->
            <div class="offer-card">
                <a href="informations.php" class="btn-status">Mes Infos</a>
            </div>

            <!-- Candidatures : si droit SFx24 (postuler à une offre) -->
            <?php if ($pm->hasAccess($role, 'SFx24')): ?>
                <div class="offer-card">
                    <a href="/Prosit_6/index.php?uri=show_status" class="btn-status">Candidatures</a>
                </div>
            <?php endif; ?>

            <!-- Gérer les étudiants : si droit SFx17 (Rechercher un compte étudiant) -->
            <?php if ($pm->hasAccess($role, 'SFx17')): ?>
                <div class="offer-card">
                    <a href="gestion_etudiants.php" class="btn-status">Gérer les étudiants</a>
                </div>
            <?php endif; ?>

            <!-- Gérer les offres : si droit SFx9 (Créer une offre) -->
            <?php if ($pm->hasAccess($role, 'SFx9')): ?>
                <div class="offer-card">
                    <a href="gestion_offres.php" class="btn-status">Gérer les offres</a>
                </div>
            <?php endif; ?>

            <!-- Gérer les pilotes : si droit SFx13 (Rechercher un compte pilote) -->
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
    <script src="../js/interaction.js"></script>
</body>

</html>