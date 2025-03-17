<?php
// offre11.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postuler à une offre de Stage</title>
    <link rel="stylesheet" type="text/css" href="../../css/styles.css">
</head>
<body>
    <header>
        <div class="text-center">
            <img src="../../Images/BonPlan.png" alt="Le Bon Plan" class="logo">
        </div>
        <nav class="navbar">
            <a href="../index.php">Accueil</a>
            <a href="../a-propos.php">À Propos</a>
            <a href="../inscription.php">Inscription</a>
            <a href="../offre.php" class="active" aria-current="page">Offres</a>
            <a href="../connexion.php">Connexion</a>
            <a href="../avis.php">Avis</a>
            <a href="../contact.php">Contact</a>
            <a href="../cookies.php">Cookies</a>
        </nav>
    </header>
    
    <main>
        <section class="job-details">
            <h2>Stage - Analyste Financier</h2>
            <p>Entreprise : SoftLink | Localisation : Lyon</p>
            <p>Publié le : 03/03/2025 | Réf : 80467-01</p>
            <h3>Résumé de l'offre :</h3>
            <div class="resume-offre">
                <span>6 mois</span>
                <span>Bac +5</span>
                <span>Finance, Analyse, Gestion</span>
                <span>Exp. - 1 an</span>
            </div>
            <h3>Envoyez votre candidature dès maintenant !</h3>
        </section>
  
        <section class="formulaire">
            <div class="form-container">
                <form action="../cv.php" method="post" enctype="multipart/form-data">
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
  
                    <label for="cv">CV :</label>
                    <div class="cv-upload" onclick="document.getElementById('cv').click();">
                        Ajouter mon CV
                        <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx,.rtf,.jpg,.png" style="display: none;">
                    </div>
                    <p style="font-size: 12px; color: gray;">Formats acceptés : .pdf, .doc, .docx, .rtf, .jpg, .png</p>
                    <div class="button-container">
                        <button type="submit" class="submit-btn">Postuler</button>
                        <button type="reset" class="reset-btn">Réinitialiser</button>
                    </div>
                </form>
            </div>
        </section>
        <div class="back-to-offers">
            <button class="back-btn" onclick="window.location.href='../offre.php';">← Retour aux offres</button>
        </div>
    </main>
  
    <script src="../../js/offre.js"></script>
    <script src="../../js/interaction.js"></script>
  
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Mentions Légales</h4>
                <p>Hébergeur : CESI</p>
                <p>Adresse : 80 avenue Edmund Halley Rouen Madrillet Innovation, 76800 Saint-Étienne-du-Rouvray</p>
                <p>Tél : 02 32 81 85 60</p>
                <p>Raison Sociale : Entreprise de services informatiques</p>
            </div>
            <div class="footer-column">
                <h4>Autres Informations</h4>
                <p>&copy; 2025 - Tous droits réservés</p>
                <p><a href="../politique-confidentialite.php">Politique de confidentialité</a></p>
            </div>
        </div>
    </footer>
</body>
</html>
