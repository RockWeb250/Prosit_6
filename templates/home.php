<?php include 'templates/partials/header.php'; ?>

<main>
    <h2 class="page-title">
        <?php if (isset($_SESSION['user'])): ?>
            Bienvenue <?= htmlspecialchars($_SESSION['user']['prenom']) ?>
        <?php else: ?>
            Bienvenue sur Lebonplan
        <?php endif; ?>
    </h2>

    <p>Votre site d'annonces en ligne pour acheter et vendre en toute simplicité.</p>

    <h3>Catégories</h3>
    <ul class="categories">
        <li><a href="templates/immobilier.php">Immobilier</a></li>
        <li><a href="templates/vehicule.php">Véhicules</a></li>
        <li><a href="templates/vetements.php">Vêtements</a></li>
        <li><a href="templates/multimedia.php">Multimédia</a></li>
        <li><a href="templates/maison.php">Maison</a></li>
        <li><a href="templates/loisirs.php">Loisirs</a></li>
        <li><a href="templates/services.php">Services</a></li>
    </ul>

    <h3>Derniers articles ajoutés</h3>
    <div class="table-container">
        <table class="articles-table">
            <thead>
                <tr>
                    <th>Intitulé</th>
                    <th>Localisation</th>
                    <th>Vendeur</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Description 1</td>
                    <td>Ville</td>
                    <td>Nom</td>
                    <td>X €</td>
                </tr>
                <tr>
                    <td>Description 2</td>
                    <td>Ville</td>
                    <td>Nom</td>
                    <td>X €</td>
                </tr>
                <tr>
                    <td>Description 3</td>
                    <td>Ville</td>
                    <td>Nom</td>
                    <td>X €</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="js/interaction.js"></script>

    <?php include 'templates/partials/footer.php'; ?>