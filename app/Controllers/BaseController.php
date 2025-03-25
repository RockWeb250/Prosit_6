<?php
namespace App\Controller;

class BaseController
{
    protected \Twig\Environment $twig;

    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    }

    protected function render(string $template, array $params = [])
    {
        echo $this->twig->render($template, $params);
    }
}
