<?php
// index.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "vendor/autoload.php";

use App\Controllers\OfferController;
use App\Controllers\UtilisateurController;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, ['debug' => true]);

// URI de la route
$uri = $_GET['uri'] ?? '/';

// Routing des contrôleurs
$offerController = new OfferController($twig);
$userController = new UtilisateurController($twig);

// Routing des actions
switch (trim($uri, '/')) {
    case '':
        $offerController->welcomePage();
        break;

    case 'offres':
        $offerController->offersPage();
        break;

    case 'about':
        $offerController->aboutPage();
        break;

    case 'show_status':
        $offerController->showStatusPage();
        break;

    case 'login':
        $userController->login();
        break;

    case 'logout':
        session_start();
        session_destroy();
        header('Location: index.php');
        exit;

    default:
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1>";
        break;
}
?>