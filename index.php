<?php
/**
 * This is the router, the main entry point of the application.
 * It handles the routing and dispatches requests to the appropriate controller methods.
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "vendor/autoload.php";

use App\Controllers\OfferController;

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true
]);

if (isset($_GET['uri'])) {
    $uri = $_GET['uri'];
} else {
    $uri = '/';
}

$controller = new OfferController($twig);

switch (trim($uri, '/')) {
    case '':
        $controller->welcomePage();
        break;
    case 'offres':
        $controller->offersPage();
        break;
    case 'about':
        $controller->aboutPage();
        break;
    case 'show_status':
        $controller->showStatusPage();
        break;
    default:
        echo '404 Not Found';
        break;
}


?>