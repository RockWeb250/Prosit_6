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

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    /**
     * Retourne un objet utilisateur depuis son email (connexion)
     */
    public function findByEmail(string $email): ?object
    {
        $stmt = $this->pdo->prepare("
            SELECT u.*, r.nom AS role
            FROM utilisateurs u
            JOIN roles r ON u.role_id = r.id
            WHERE u.email = ?
        ");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ?: null;
    }





    /**
     * Compter le nombre total d’utilisateurs
     */
    public function countAll(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM utilisateurs");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $row['total'];
    }

    /**
     * Récupérer tous les utilisateurs de façon paginée
     */
    public function findAll(int $limit, int $offset): array
    {
        $stmt = $this->pdo->prepare("
SELECT u.id, u.email, u.motDePasse, u.civilite, u.nom, u.prenom, r.nom AS role
FROM utilisateurs u
JOIN roles r ON u.role_id = r.id
ORDER BY u.id DESC
LIMIT :limit OFFSET :offset

        ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Créer un nouvel utilisateur
     */
    public function createUser(array $data): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO utilisateurs (email, motDePasse, civilite, nom, prenom, role_id)
            VALUES (:email, :motDePasse, :civilite, :nom, :prenom, :role_id)
        ");
        return $stmt->execute([
            ':email' => $data['email'],
            ':motDePasse' => $data['motDePasse'],   // déjà haché
            ':civilite' => $data['civilite'] ?? null,
            ':nom' => $data['nom'] ?? null,
            ':prenom' => $data['prenom'] ?? null,
            ':role_id' => $data['role_id'] ?? 3   // par défaut étudiant (id 3)
        ]);
    }

    /**
     * Mettre à jour un utilisateur existant
     */
    public function updateUser(int $id, array $data): bool
    {
        // On génère dynamiquement la requête en fonction des champs fournis
        $fields = [];
        $params = [];
        foreach ($data as $key => $val) {
            $fields[] = "$key = :$key";
            $params[":$key"] = $val;
        }
        $fieldsSql = implode(', ', $fields);

        $sql = "UPDATE utilisateurs SET $fieldsSql WHERE id = :id";
        $params[':id'] = $id;

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Supprimer un utilisateur
     */
    public function deleteUser(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Chercher un utilisateur par nom/prénom/email
     */
    public function searchUser(string $search): array
    {
        $stmt = $this->pdo->prepare("
            SELECT id, email, nom, prenom, role
            FROM utilisateurs
            WHERE nom LIKE :q OR prenom LIKE :q OR email LIKE :q
        ");
        $stmt->execute([':q' => "%$search%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRole(): ?string
    {
        return $this->role ?? null;
    }

}
