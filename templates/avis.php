<?php
// avis.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Avis</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <header>
        <div class="text-center">
            <img src="../Images/BonPlan.png" alt="Le Bon Plan" class="logo">
        </div>
        <nav class="navbar">
            <a href="index.php">Accueil</a>
            <a href="a-propos.php">À Propos</a>
            <a href="inscription.php">Inscription</a>
            <a href="offre.php">Offres</a>
            <a href="connexion.php">Connexion</a>
            <a href="avis.php" class="active" aria-current="page">Avis</a>
            <a href="contact.php">Contact</a>
            <a href="cookies.php">Cookies</a>
        </nav>
    </header>

    <main>
        <h1 class="page-title">Votre avis nous intéresse</h1>
        <form class="form-container" action="#" method="get">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" class="form-input" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" class="form-input" required>

            <label for="email">Mail :</label>
            <input type="email" id="email" name="email" class="form-input" required>

            <label for="objet">Objet de la Demande :</label>
            <select id="objet" name="objet" class="form-input">
                <option value="produit acheté">Produit Acheté</option>
                <option value="service commercial">Service Commercial</option>
                <option value="service technique">Service Technique</option>
                <option value="autres">Autres</option>
            </select>

            <fieldset class="form-fieldset">
                <legend>Catégories concernées :</legend>
                <div class="checkbox-container">
                    <label>Immobilier <input type="checkbox" name="categories" value="Immobilier"></label>
                    <label>Véhicules <input type="checkbox" name="categories" value="Véhicules"></label>
                    <label>Vêtements <input type="checkbox" name="categories" value="Vêtements"></label>
                    <label>Multimédia <input type="checkbox" name="categories" value="Multimédia"></label>
                    <label>Maison <input type="checkbox" name="categories" value="Maison"></label>
                    <label>Loisirs <input type="checkbox" name="categories" value="Loisirs"></label>
                    <label>Services <input type="checkbox" name="categories" value="Services"></label>
                </div>
            </fieldset>

            <label for="photo">Joindre un fichier :</label>
            <input type="file" id="photo" name="photo" class="form-input">

            <fieldset class="form-fieldset">
                <legend>Satisfaction :</legend>
                <div class="radio-container">
                    <label>Satisfait <input type="radio" name="satisfaction" value="Satisfait" required></label>
                    <label>Pas satisfait <input type="radio" name="satisfaction" value="Pas satisfait" required></label>
                </div>
            </fieldset>

            <label for="commentaires">Commentaires :</label>
            <textarea id="commentaires" name="commentaires" class="form-input" rows="4"></textarea>

            <button type="submit" class="submit-btn">Envoyer</button>
            <button type="reset" class="reset-btn">Effacer</button>
        </form>
    </main>

    <script src="../js/avis.js"></script>
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
