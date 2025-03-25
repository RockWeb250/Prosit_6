<?php
// public/index.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Chemins importants
define('ROOT_DIR', dirname(__DIR__));
define('APP_DIR', ROOT_DIR . '/app');
define('TEMPLATE_DIR', ROOT_DIR . '/templates');

require_once ROOT_DIR . '/vendor/autoload.php';
require_once APP_DIR . '/config/config.php';

use App\Controllers\OfferController;
use App\Controllers\UserController;

// Initialisation de Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates');
$twig = new \Twig\Environment($loader, ['debug' => true]);
$twig->addGlobal('base_url', BASE_URL);
$twig->addGlobal('session', $_SESSION ?? []);

// Récupération de l'URI
$uri = $_GET['uri'] ?? '/';

// Contrôleurs
$offerController = new OfferController($twig);
$userController = new UserController($twig);

// Routing
switch (trim($uri, '/')) {
    case '':
        $offerController->welcomePage();
        break;

    case 'offres':
        $offerController->offersPage();
        break;

    case 'show_status':
        $offerController->showStatusPage();
        break;

    case 'a-propos':
        echo $twig->render('a-propos.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;


    case 'contact':
        echo $twig->render('contact.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'avis':
        echo $twig->render('avis.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'inscription':
        echo $twig->render('inscription.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'loisirs':
        echo $twig->render('loisirs.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'maison':
        echo $twig->render('maison.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'multimedia':
        echo $twig->render('multimedia.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'politique-confidentialite':
        echo $twig->render('politique-confidentialite.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'services':
        echo $twig->render('services.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'vetements':
        echo $twig->render('vetements.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'immobilier':
        echo $twig->render('immobilier.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
        break;

    case 'vehicule':
        echo $twig->render('vehicule.twig', [
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? []
        ]);
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