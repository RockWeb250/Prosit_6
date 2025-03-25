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
        echo $this->templateEngine->render('home.twig', [
            'base_url' => BASE_URL,
            'articles' => [
                ['intitule' => 'Canapé', 'localisation' => 'Paris', 'vendeur' => 'Julien', 'prix' => '150 €'],
                ['intitule' => 'iPhone 13', 'localisation' => 'Lyon', 'vendeur' => 'Alice', 'prix' => '500 €'],
                ['intitule' => 'Vélo VTT', 'localisation' => 'Marseille', 'vendeur' => 'Hugo', 'prix' => '120 €'],
            ]
        ]);

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