<?php
session_start();

// Paramètres de connexion
$db_user = "user";
$db_pass = "password123";
$host = "localhost";
$db_name = "prosit7";
$charset = 'utf8mb4';

// DSN complet
$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";

try {
    $dbh = new PDO($dsn, $db_user, $db_pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupère tous les utilisateurs
    $stmt = $dbh->query("SELECT id, motDePasse FROM utilisateurs");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Pour chaque utilisateur, on re-hache le mot de passe (qu'il soit déjà haché ou non)
    foreach ($users as $user) {
        $id = $user['id'];
        $currentPassword = $user['motDePasse'];

        // On force le hachage (ici avec BCRYPT via password_hash)
        $hashedPassword = password_hash($currentPassword, PASSWORD_BCRYPT);

        // Mise à jour en base
        $updateStmt = $dbh->prepare("UPDATE utilisateurs SET motDePasse = ? WHERE id = ?");
        $updateStmt->execute([$hashedPassword, $id]);

        echo "Mot de passe mis à jour pour l'utilisateur ID: $id<br>";
    }

    echo "<br>✅ Tous les mots de passe ont été hachés avec succès.";

} catch (PDOException $e) {
    echo "❌ Erreur lors de la mise à jour : " . $e->getMessage();
}
?>
