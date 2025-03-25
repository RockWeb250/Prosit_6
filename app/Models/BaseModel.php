<?php
// app/model/BaseModel.php

namespace App\Model;

use App\Models\SqlDatabase;
use PDO;

abstract class BaseModel {
    protected PDO $pdo;
}

