<?php
// Script de mise à jour des mots de passe en clair vers un format sécurisé

try {
    $pdo = new PDO("mysql:host=localhost;dbname=prosit7;charset=utf8mb4", "user", "password123");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer tous les utilisateurs
    $stmt = $pdo->query("SELECT id, motDePasse FROM utilisateurs");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        $hashed_password = password_hash($user['motDePasse'], PASSWORD_BCRYPT);

        // Mettre à jour le mot de passe hashé
        $updateStmt = $pdo->prepare("UPDATE utilisateurs SET motDePasse = ? WHERE id = ?");
        $updateStmt->execute([$hashed_password, $user['id']]);

        echo "🔐 Mot de passe mis à jour pour l'utilisateur ID: " . $user['id'] . "<br>";
    }

    echo "<br>✅ Tous les mots de passe ont été hachés avec succès.";
} catch (PDOException $e) {
    echo "❌ Erreur lors de la mise à jour : " . $e->getMessage();
}
?>
