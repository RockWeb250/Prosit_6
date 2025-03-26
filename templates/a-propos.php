<?php
// a-propos.php
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>À Propos</title>
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>

<body>
  <header>
    <div class="text-center">
      <img src="../Images/BonPlan.png" alt="Le Bon Plan" class="logo">
    </div>
    <nav class="navbar">
      <a href="../index.php">Accueil</a>
      <a href="a-propos.php" class="active" aria-current="page">À Propos</a>
      <a href="offre.php">Offres</a>
      <a href="avis.php">Avis</a>
      <a href="contact.php">Contact</a>
      <a href="cookies.php">Cookies</a>
      <?php if (isset($_SESSION['user'])): ?>
        <a href="mon-compte.php">Mon Compte</a>
        <form action="deconnexion.php" method="POST" class="logout-form">
          <button type="submit" class="logout-button">Déconnexion</button>
        </form>
      <?php else: ?>
        <a href="connexion.php">Connexion</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <h1 class="page-title">Qui sommes-nous ?</h1>

    <div class="about-container" style="border: 2px solid black; padding: 20px;">
      <div class="about-box">
        <h2>Histoire</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vel nunc condimentum, porttitor metus
          id, venenatis sapien. Ut at lobortis nulla. Sed eleifend, nunc vel mattis cursus, odio risus semper nibh, vel
          gravida libero eros eu lorem. Mauris eu finibus nulla. Pellentesque aliquet, tortor sit amet laoreet eleifend,
          eros urna hendrerit dolor, id consequat nisi elit id diam. Etiam maximus neque vel elit semper, ut tempus
          massa tempor. Quisque faucibus nec magna dapibus dictum. Aliquam mattis erat arcu, ut sodales dui vestibulum
          sed. Aliquam congue malesuada turpis, ac elementum nisl. Cras ut metus sed urna faucibus vehicula. In interdum
          ligula at blandit egestas. Maecenas elit magna, facilisis ut purus vitae, rhoncus placerat urna. Maecenas quam
          est, rutrum dapibus blandit vitae, ultrices vitae neque. Integer euismod consequat congue. Donec feugiat
          facilisis orci et tempor.</p>
      </div>

      <div class="about-box">
        <h2>Nos engagements</h2>
        <p>Vestibulum sollicitudin augue nec arcu placerat, vel dapibus nisi congue. Mauris porttitor arcu in dignissim
          pharetra. Aliquam libero lorem, facilisis et faucibus quis, feugiat in diam. Donec id pulvinar felis, eget
          sollicitudin libero. Vestibulum varius congue fringilla. Aenean eget condimentum sem. Aenean sollicitudin
          felis non nisi facilisis auctor. Nam at lacus nibh. Ut et nisl molestie, commodo orci eget, ornare eros. In
          hac habitasse platea dictumst. Quisque at fermentum leo, quis placerat ligula. Sed accumsan odio ac pharetra
          vulputate. Nam nisl augue, scelerisque non vulputate eget, consequat quis lacus. In posuere turpis non sem
          porta vehicula. Ut mollis leo vestibulum, porttitor enim eget, volutpat mauris. Donec eu justo est.</p>
      </div>

      <div class="about-box full-width">
        <h2>Nos services</h2>
        <p>Proin ultrices finibus nibh a ultrices. Proin sed eros dictum, tristique ligula sit amet, scelerisque turpis.
          Praesent rhoncus dui quis volutpat aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
          posuere cubilia curae; Praesent lacinia mattis libero sit amet tempor. Suspendisse posuere neque vitae dui
          ullamcorper ullamcorper. Praesent mollis consectetur aliquam. Suspendisse potenti. Fusce mattis bibendum
          porttitor. Aenean nunc tellus, ultricies at nisi at, ultricies fringilla ex. Aliquam tincidunt nibh eu
          tincidunt mattis. Donec sed mollis sem. Integer quis euismod nunc, a euismod felis. Maecenas a consectetur
          nunc. Phasellus dapibus mollis lectus, ut sodales ligula suscipit eu.</p>
      </div>
    </div>
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