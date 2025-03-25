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
$loader = new \Twig\Loader\FilesystemLoader(TEMPLATE_DIR);
$twig = new \Twig\Environment($loader, ['debug' => true]);
$twig->addGlobal('base_url', BASE_URL);
$twig->addGlobal('session', $_SESSION ?? []);

// URI
$uri = trim($_GET['uri'] ?? '/', '/');

// Contrôleurs
$offerController = new OfferController($twig);
$userController = new UserController($twig);

// Routing avec rendu Twig automatique
$staticPages = [
    'a-propos',
    'avis',
    'contact',
    'cookies',
    'immobilier',
    'inscription',
    'loisirs',
    'maison',
    'multimedia',
    'politique-confidentialite',
    'services',
    'vehicule',
    'vetements',
];

if (in_array($uri, $staticPages)) {
    echo $twig->render("$uri.twig");
    exit;
}

// Cas spéciaux (contrôleurs)
switch ($uri) {
    case '':
        $offerController->welcomePage();
        break;

    case 'offres':
        $offerController->offersPage();
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
