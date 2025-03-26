<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "vendor/autoload.php";

use App\Controllers\OfferController;
use App\Controllers\UserController;

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true
]);

$uri = $_GET['uri'] ?? '/';

$controller = new OfferController($twig);
$userController = new UserController($twig);

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
    case 'login':
        $userController->login();
        break;
    default:
        echo '404 Not Found';
        break;
}
?>