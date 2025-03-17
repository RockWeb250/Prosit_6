<?php
/**
 * This is the router, the main entry point of the application.
 * It handles the routing and dispatches requests to the appropriate controller methods.
 */

require "vendor/autoload.php";

use App\Controllers\TaskController;

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true
]);

if (isset($_GET['uri'])) {
    $uri = $_GET['uri'];
} else {
    $uri = '/';
}

$controller = new TaskController($twig);

switch ($uri) {
    case '/':
        // TODO : call the welcomePage method of the controller
        //echo 'Welcome page';
        $controller->welcomePage();
        break;
    case 'add_task':
        // TODO : call the addTask method of the controller
        $controller->addTask();
        break;
    case 'check_task':
        // TODO : call the checkTask method of the controller
        $controller->checkTask();
        break;
    case 'history':
        // TODO : call the historyPage method of the controller
        $controller->historyPage();
        break;
    case 'uncheck_task':
        // TODO : call the uncheckTask method of the controller
        $controller->uncheckTask();
        break;
    case 'about':
        // TODO : call the aboutPage method of the controller
        $controller->aboutPage();
        break;
    default:
        // TODO : return a 404 error
        echo '404 Not Found';
        break;
}