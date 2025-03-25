<?php
namespace App\Tests;

use App\Models\Utilisateur;
use PHPUnit\Framework\TestCase;
use PDO;
use PDOStatement;

class UtilisateurTest extends TestCase
{
    public function testFindByEmailReturnsUserObject()
    {
        $pdoMock = $this->createMock(PDO::class);
        $stmtMock = $this->createMock(PDOStatement::class);

        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetch')->willReturn((object)['email' => 'test@example.com', 'motDePasse' => '1234']);

        $pdoMock->method('prepare')->willReturn($stmtMock);

        // Injecte le mock dans l'objet via Reflection (car `$pdo` est privé)
        $utilisateur = new Utilisateur();
        $reflection = new \ReflectionClass($utilisateur);
        $property = $reflection->getProperty('pdo');
        $property->setAccessible(true);
        $property->setValue($utilisateur, $pdoMock);

        $result = $utilisateur->findByEmail('test@example.com');

        $this->assertIsObject($result);
        $this->assertEquals('test@example.com', $result->email);
    }

    public function testFindByEmailReturnsNullIfNotFound()
    {
        $pdoMock = $this->createMock(PDO::class);
        $stmtMock = $this->createMock(PDOStatement::class);

        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetch')->willReturn(false);

        $pdoMock->method('prepare')->willReturn($stmtMock);

        $utilisateur = new Utilisateur();
        $reflection = new \ReflectionClass($utilisateur);
        $property = $reflection->getProperty('pdo');
        $property->setAccessible(true);
        $property->setValue($utilisateur, $pdoMock);

        $result = $utilisateur->findByEmail('notfound@example.com');

        $this->assertNull($result);
    }
}
?>