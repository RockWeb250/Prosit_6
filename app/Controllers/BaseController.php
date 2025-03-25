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

        require_once dirname(__DIR__) . '/templates/layout.twig';

    }
}
