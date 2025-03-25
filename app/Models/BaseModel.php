<?php
// app/model/BaseModel.php

namespace App\Model;

use App\Models\SqlDatabase;
use PDO;

abstract class BaseModel {
    protected PDO $pdo;

    public function __construct() {
        $db = new SqlDatabase('offres_stage');  // ← adapte selon ton nom de BDD
        $this->pdo = $db->getPdo();             // ← on crée une méthode getPdo()
    }
}

