<?php
/**
 * This is the router, the main entry point of the application.
 * It handles the routing and dispatches requests to the appropriate controller methods.
 */

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

switch ($uri) {
    case '/':
        $controller->welcomePage();
        break;
    case 'add_offer':
        $controller->addOffer();
        break;
    case 'about':
        $controller->aboutPage();
        break;
    case 'show_status':
        $controller->show_Status();
        break;
    default:
        echo '404 Not Found';
        break;
}

?>