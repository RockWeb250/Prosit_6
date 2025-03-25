<?php
namespace App\Controllers;

use PDO;
use PDOException;

class UserController
{
    private $templateEngine;

    public function __construct($templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = "user";
            $pass = "password123";
            $host = "localhost";
            $charset = 'utf8mb4';

            try {
                $dbh = new PDO($dsn, $user, $pass);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $dbh->prepare("SELECT * FROM utilisateurs WHERE pseudo = ? LIMIT 1");
                $stmt->execute([$username]);
                $result = $stmt->fetch(PDO::FETCH_OBJ);

                if ($result && $result->motDePasse === $password) {
                    echo "Bienvenue " . htmlspecialchars($result->pseudo);
                } else {
                    echo "Identifiants incorrects.";
                }

            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        } else {
            echo $this->templateEngine->render('login.twig'); // Formulaire HTML
        }
    }
}
