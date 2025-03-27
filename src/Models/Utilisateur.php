<?php
namespace App\Models;

use PDO;
use PDOException;

class Utilisateur
{
    private PDO $pdo;

    public function __construct()
    {
        $db_user = "user";
        $db_pass = "password123";
        $host = "localhost";
        $db_name = "prosit7";
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $db_user, $db_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Le reste de tes méthodes reste inchangé...
}
