<?php
namespace App\Controllers;

use App\Models\OfferModel;
use App\Models\TaskModel;

class OfferController extends Controller
{

    public function __construct($templateEngine)
    {
        $this->model = new OfferModel();
        $this->templateEngine = $templateEngine;
    }

    public function welcomePage()
    {
        // Retrieve the list of tasks from the model
        $offers = $this->model->getAllOffers();
        echo $this->templateEngine->render('home.php', ['offers' => $offers]);
    }

    public function offersPage()
    {
        $offers = $this->model->getAllOffers();
        echo $this->templateEngine->render('offre.twig', ['offers' => $offers]);
    }

    public function aboutPage()
    {
        echo $this->templateEngine->render('a-propos.php');
    }

    public function show_Status()
    {
        $offers = $this->model->getAllOffers();
        echo $this->templateEngine->render('status.twig', ['offers' => $offers]);
    }

}
?>