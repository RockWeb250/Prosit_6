<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Statuts des Candidatures</title>
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
            <a href="avis.php">Avis</a>
            <a href="contact.php">Contact</a>
            <a href="cookies.php">Cookies</a>
        </nav>
    </header>

    <main>
        <h1 class="page-title">Statuts des Candidatures</h1>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Offre</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                {% for offer in offers %}
                <tr>
                    <td>{{ offer.id }}</td>
                    <td>{{ offer.offer }}</td>
                    <td class="status {{ offer.status|lower|replace(" ", " -") }}">{{ offer.status }}</td>
                </tr>
                {% endfor %}
            </tbody>
        </table>
    </main>

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