<?php
// gestion_etudiants.php

session_start();

// Simule les résultats de recherche (remplacer par la BDD)
$search_result = $_SESSION['search_result'] ?? null;
unset($_SESSION['search_result']);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Utilisateurs</title>
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

    <main class="content">
    <h2>Gestion des Utilisateurs</h2>

    <?php if (!isset($_SESSION['user']) || ($_SESSION['user']['role_id'] ?? 0) != 1): ?>
        <p>Accès refusé</p>
        <?php exit; ?>
    <?php endif; ?>

    <div class="cookie-box">
        <div class="resume-offre"></div>
        <p style="text-align: center">
            <span><a href="#recherche" class="btn-login">Rechercher un Utilisateur</a></span>
        </p>
        <p>
            <span><a href="#creer" class="btn-login">Créer un Utilisateur</a></span>
        </p>
        <p>
            <span><a href="#modifier" class="btn-login">Modifier un Utilisateur</a></span>
        </p>
        <p>
            <span><a href="#supprimer" class="btn-login">Supprimer un Utilisateur</a></span>
        </p>
    </div>

    <!-- Recherche -->
    <div id="recherche" style="margin-top: 40px;">
        <h3>Rechercher un Utilisateur</h3>
        <form action="/index.php?uri=gestion_utilisateurs/search" method="POST" class="search-form">
            <label for="motcle">Mot-clé :</label>
            <input type="text" id="motcle" name="motcle" required>
            <button type="submit" class="submit-btn">Rechercher</button>
            <button type="reset" class="reset-btn">Effacer</button>
        </form>
    </div>

    <!-- Résultat -->
    <?php if (!empty($search_result)): ?>
        <div id="resultat">
            <h3>Résultat de la recherche :</h3>
            <p>Nom : <?= htmlspecialchars($search_result['nom']) ?></p>
            <p>Prénom : <?= htmlspecialchars($search_result['prenom']) ?></p>
            <p>Email : <?= htmlspecialchars($search_result['email']) ?></p>
            <p>Rôle : <?= htmlspecialchars($search_result['role']) ?></p>

            <h3>Modifier</h3>
            <form action="/index.php?uri=gestion_utilisateurs/update" method="POST">
                <input type="hidden" name="id" value="<?= $search_result['id'] ?>">
                <label>Nom :</label><input type="text" name="nom" value="<?= htmlspecialchars($search_result['nom']) ?>">
                <label>Prénom :</label><input type="text" name="prenom" value="<?= htmlspecialchars($search_result['prenom']) ?>">
                <label>Email :</label><input type="email" name="email" value="<?= htmlspecialchars($search_result['email']) ?>">
                <label>Rôle :</label>
                <select name="role">
                    <option value="Etudiant" <?= $search_result['role'] == 'Etudiant' ? 'selected' : '' ?>>Étudiant</option>
                    <option value="Pilote" <?= $search_result['role'] == 'Pilote' ? 'selected' : '' ?>>Pilote</option>
                    <option value="Admin" <?= $search_result['role'] == 'Admin' ? 'selected' : '' ?>>Administrateur</option>
                </select>
                <label>Nouveau mot de passe (facultatif) :</label>
                <input type="password" name="password">
                <button type="submit" class="btn">Modifier</button>
            </form>

            <h3>Supprimer</h3>
            <form action="/index.php?uri=gestion_utilisateurs/delete" method="POST">
                <input type="hidden" name="id" value="<?= $search_result['id'] ?>">
                <button type="submit" class="btn" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
            </form>
        </div>
    <?php endif; ?>

    <hr>

    <!-- Création -->
    <div id="creer" style="margin-top: 40px;">
        <div class ="form-container">
        <h3>Créer un Utilisateur</h3>
        <form action="/index.php?uri=gestion_utilisateurs/create" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" required>

            <label for="email">Email :</label>
            <input type="email" name="email" required>

            <label for="role">Rôle :</label>
            <select name="role" required>
                <option value="Etudiant">Etudiant</option>
                <option value="Pilote">Pilote</option>
                <option value="Admin">Administrateur</option>
            </select>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>

            <button type="submit" class="submit-btn">Créer</button>
            <button type="reset" class="reset-btn">Effacer</button>
        </form>
        </div>
    </div>
</main>


    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Mentions Légales</h4>
                <p>Hébergeur : CESI</p>
                <p>Adresse : 80 avenue Edmund Halley Rouen Madrillet Innovation</p>
                <p>Tél : 02 32 81 85 60</p>
                <p>Entreprise de services informatiques</p>
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