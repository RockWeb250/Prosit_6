<?php
namespace App\Controllers;

use App\Models\OfferModel;

class OfferController
{
    protected OfferModel $model;
    private $templateEngine;
    public function __construct($templateEngine)
    {
        $this->model = new OfferModel(); // SQL utilisé
        $this->templateEngine = $templateEngine;
    }

    public function welcomePage()
    {
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

    public function showStatusPage()
    {
        $offers = $this->model->getAllOffers();
        echo $this->templateEngine->render('status.twig', ['offers' => $offers]);
    }

    public function addOfferPage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $offer = [
                'offer' => $_POST['offer'],
                'status' => $_POST['status']
            ];
            $this->model->addOffer($offer);
            header('Location: /offres');
        } else {
            echo $this->templateEngine->render('status.twig');
        }
    }


    public function deleteOffer($id)
    {
        $success = $this->model->deleteOfferById($id);
        if ($success) {
            header('Location: /offres');
        } else {
            echo "Erreur : offre non trouvée ou suppression échouée.";
        }
    }
}