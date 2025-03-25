<?php
namespace App\Models;

use PDO;
use PDOException;

/**
 * Classe SqlDatabase : permet d’interagir avec une base MySQL.
 */
class SqlDatabase
{
    private PDO $pdo;
    private string $table;

    public function __construct(string $dbname, string $table = 'offres')
    {

        $user = "user";
        $pass = "password123";
        $host = "localhost";
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->table = $table;
        } catch (PDOException $e) {
            die("Erreur de connexion SQL : " . $e->getMessage());
        }
    }

    public function getAllRecords(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecord(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function insertRecord(array $record): int
    {
        $sql = "INSERT INTO {$this->table} (offer, status) VALUES (:offer, :status)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':offer' => $record['offer'],
            ':status' => $record['status']
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    public function updateRecord(int $id, array $record): bool
    {
        $sql = "UPDATE {$this->table} SET offer = :offer, status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':offer' => $record['offer'],
            ':status' => $record['status'],
            ':id' => $id
        ]);
    }

    public function deleteRecord(array $record): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$record['id']]);
    }
}
