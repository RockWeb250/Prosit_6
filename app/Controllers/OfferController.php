<?php
namespace App\Controllers;

use App\Models\OfferModel;

class OfferController
{
    protected OfferModel $model;
    private \Twig\Environment $templateEngine;

    public function __construct(\Twig\Environment $templateEngine)
    {
        $this->model = new OfferModel(); // SQL utilisé
        $this->templateEngine = $templateEngine;
    }

    public function welcomePage()
    {
        $articles = [
            ['intitule' => 'Canapé', 'localisation' => 'Paris', 'vendeur' => 'Julien', 'prix' => '150 €'],
            ['intitule' => 'iPhone 13', 'localisation' => 'Lyon', 'vendeur' => 'Alice', 'prix' => '500 €'],
            ['intitule' => 'Vélo VTT', 'localisation' => 'Marseille', 'vendeur' => 'Hugo', 'prix' => '120 €'],
        ];

        echo $this->templateEngine->render('home.twig', [
            'articles' => $articles,
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? [],
        ]);
    }

    public function offersPage()
    {
        $offers = $this->model->getAllOffers();
        echo $this->templateEngine->render('offre.twig', [
            'offers' => $offers,
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? [],
        ]);
    }

    public function showStatusPage()
    {
        $offers = $this->model->getAllOffers();
        echo $this->templateEngine->render('status.twig', [
            'offers' => $offers,
            'base_url' => BASE_URL,
            'session' => $_SESSION ?? [],
        ]);
    }

    public function addOfferPage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $offer = [
                'offer' => $_POST['offer'],
                'status' => $_POST['status']
            ];
            $this->model->addOffer($offer);
            header('Location: ' . BASE_URL . 'index.php?uri=offres');
            exit;
        } else {
            echo $this->templateEngine->render('status.twig', [
                'base_url' => BASE_URL,
                'session' => $_SESSION ?? [],
            ]);
        }
    }

    public function deleteOffer($id)
    {
        $success = $this->model->deleteOfferById($id);
        if ($success) {
            header('Location: ' . BASE_URL . 'index.php?uri=offres');
        } else {
            echo "Erreur : offre non trouvée ou suppression échouée.";
        }
    }
}
