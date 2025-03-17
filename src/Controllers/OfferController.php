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
        echo $this->templateEngine->render('index.php', ['offers' => $offers]);
    }

    public function addOffer()
    {
        if (!isset($_POST['offer'])) {
            header('Location: /');
            exit();
        }

        $offer = $_POST['offer'];
        $this->model->addOffer($offer);
        header('Location: /');
        exit();
    }

    public function aboutPage()
    {
        echo $this->templateEngine->render('a-propos.php');
    }
}