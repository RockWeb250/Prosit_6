<?php
// app/controller/BaseController.php

namespace App\Controller;

class BaseController
{
    /**
     * Méthode de rendu de la vue.
     */
    protected function render($view, $params = [])
    {
        // Extraire les variables pour la vue
        extract($params);

        require_once dirname(__DIR__) . '/templates/partials/header.php';   // header commun
        require_once dirname(__DIR__) . '/templates/home.php';   
        require_once dirname(__DIR__) . '/templates/partials/header.php';   // footer commun

    }
}
