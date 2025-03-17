<?php
// cv.php

// Démarrer la mise en tampon pour éviter tout output avant la redirection
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuration des formats autorisés et de la taille maximale (2 Mo)
$allowedExtensions = ["pdf", "doc", "docx", "odt", "rtf", "jpg", "png"];
$maxFileSize = 2 * 1024 * 1024; // 2 Mo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Récupération et validation des champs texte
    $civilite = isset($_POST['civilite']) ? trim($_POST['civilite']) : '';
    if (!in_array(strtolower($civilite), ['madame', 'monsieur'])) {
        die("Valeur de civilité invalide.");
    }

    $nom = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : '';
    $prenom = isset($_POST['prenom']) ? htmlspecialchars(trim($_POST['prenom'])) : '';

    // Sanitisation et validation de l'email
    $emailRaw = isset($_POST['email']) ? trim($_POST['email']) : '';
    $email = filter_var($emailRaw, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse e-mail invalide.");
    }

    // 2. Vérification qu'un fichier a bien été uploadé
    if (!isset($_FILES['cv']) || $_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
        die("Erreur lors de l'envoi du fichier.");
    }

    // Récupération des informations du fichier
    $fileTmpPath = $_FILES['cv']['tmp_name'];
    $fileName = basename($_FILES['cv']['name']); // Sécurise le nom du fichier
    $fileSize = $_FILES['cv']['size'];

    // 3. Extraction de l'extension et vérification
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        die("Format de fichier non autorisé.");
    }
    if ($fileSize > $maxFileSize) {
        die("Le fichier ne doit pas dépasser 2 Mo.");
    }

    // 4. Validation du type MIME à l'aide de finfo
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($fileTmpPath);
    $allowedMimeTypes = [
        "pdf" => "application/pdf",
        "doc" => "application/msword",
        "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "odt" => "application/vnd.oasis.opendocument.text",
        "rtf" => "application/rtf",
        "jpg" => "image/jpeg",
        "png" => "image/png"
    ];
    if (!isset($allowedMimeTypes[$fileExtension]) || $allowedMimeTypes[$fileExtension] !== $mimeType) {
        die("Type de fichier invalide.");
    }

    // 5. Générer un nom de fichier unique et définir le répertoire de destination
    $newFileName = uniqid("cv_", true) . "." . $fileExtension;
    $uploadDir = __DIR__ . '/uploaded_cvs/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            die("Impossible de créer le dossier d'upload.");
        }
    }
    $destPath = $uploadDir . $newFileName;

    // 6. Déplacer le fichier vers le dossier cible
    if (!move_uploaded_file($fileTmpPath, $destPath)) {
        $error = error_get_last();
        die("Erreur lors du déplacement du fichier: " . print_r($error, true));
    }

    // 7. Préparation de l'email de confirmation
    $subject = "Confirmation de votre candidature";
    $message = "Bonjour " . htmlspecialchars($prenom) . " " . htmlspecialchars($nom) . ",\n\n"
        . "Nous avons bien reçu votre candidature pour le stage. Nous vous remercions de votre intérêt et vous contacterons prochainement.\n\n"
        . "Cordialement,\nL'équipe de recrutement";
    $headers = "From: no-reply@example.com\r\n" .
        "Reply-To: no-reply@example.com\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // Envoi de l'email de confirmation
    if (!mail($email, $subject, $message, $headers)) {
        // Si l'envoi d'email échoue, vous pouvez enregistrer l'erreur dans les logs
        error_log("Échec de l'envoi de l'email à $email");
    }

    // 8. Redirection vers la page de succès
    header("Location: success.php");
    exit;
} else {
    echo "Méthode non autorisée.";
}

ob_end_flush();
?>