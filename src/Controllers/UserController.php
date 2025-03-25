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
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $db_user = "user";            
            $db_pass = "password123";     
            $dsn = "mysql:host=localhost;dbname=offres_stage;charset=utf8mb4";

            try {
                $dbh = new PDO($dsn, $db_user, $db_pass);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $dbh->prepare("SELECT * FROM utilisateurs WHERE email = ? LIMIT 1");
                $stmt->execute([$email]);
                $result = $stmt->fetch(PDO::FETCH_OBJ);

                if ($result !== null) {
                    if ($result->motDePasse === $password) {
                        echo "<p style='color:green;text-align:center;'>Bienvenue " . htmlspecialchars($result->email) . " !</p>";
                    } else {
                        echo "<p style='color:red;text-align:center;'>Mot de passe incorrect.</p>";
                    }
                } else {
                    echo "<p style='color:red;text-align:center;'>Utilisateur non trouvé.</p>";
                }
            } catch (PDOException $e) {
                echo "<p style='color:red;'>Erreur de connexion : " . $e->getMessage() . "</p>";
            }
        } else {
            echo $this->templateEngine->render('login.twig');
        }
    }
}
