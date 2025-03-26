<?php
namespace App\Controllers;

use App\Models\Utilisateur;

class UserController
{
    private $templateEngine;

    public function __construct($templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    public function login()
    {
        session_start();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $utilisateurModel = new Utilisateur();
            $user = $utilisateurModel->findByEmail($email);

            if ($user && password_verify($password, $user->motDePasse)) {
                $_SESSION['user'] = $user;
                header('Location: ../index.php');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }

        echo $this->templateEngine->render('login.twig', [
            'error' => $error
        ]);
    }
}
