<?php
namespace App\Controllers;

use App\Models\Utilisateur;

class GestionUtilisateursController
{
    private Utilisateur $userModel;

    public function __construct()
    {
        $this->userModel = new Utilisateur();
    }

    /**
     * Page principale de gestion des utilisateurs (accès admin uniquement)
     */
    public function index()
    {
        session_start();

        if (!isset($_SESSION['user']) || ($_SESSION['user']['role_id'] ?? 0) != 1) {
            header('Location: /index.php');
            exit;
        }

        // Affiche la page de gestion
        header("Location: /templates/gestion_etudiants.php");
        exit;
    }

    /**
     * Traitement de la création d'un utilisateur
     */
    public function create()
    {
        session_start();

        if (!isset($_SESSION['user']) || ($_SESSION['user']['role_id'] ?? 0) != 1) {
            header('Location: /index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST["nom"] ?? '');
            $prenom = trim($_POST["prenom"] ?? '');
            $email = trim($_POST["email"] ?? '');
            $role = trim($_POST["role"] ?? 'Etudiant');
            $motDePasse = $_POST["password"] ?? '';
            $civilite = $_POST["civilite"] ?? null;

            if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($role) && !empty($motDePasse)) {
                $success = $this->userModel->createUser([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'email' => $email,
                    'role' => $role,
                    'motDePasse' => password_hash($motDePasse, PASSWORD_BCRYPT),
                    'civilite' => $civilite
                ]);

                $_SESSION["message"] = $success ? "Utilisateur ajouté avec succès." : "Erreur lors de l'ajout de l'utilisateur.";
            } else {
                $_SESSION["error"] = "Veuillez remplir tous les champs.";
            }

            header("Location: /templates/gestion_etudiants.php");
            exit;
        }
    }

    /**
     * Mise à jour d'un utilisateur
     */
    public function update()
    {
        session_start();

        if (!isset($_SESSION['user']) || ($_SESSION['user']['role_id'] ?? 0) != 1) {
            header('Location: /index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $data = [
                'nom' => trim($_POST['nom'] ?? ''),
                'prenom' => trim($_POST['prenom'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'role' => trim($_POST['role'] ?? '')
            ];

            if (!empty($_POST['password'])) {
                $data['motDePasse'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
            }

            $success = $this->userModel->updateUser($id, array_filter($data));

            $_SESSION["message"] = $success ? "Utilisateur modifié avec succès." : "Erreur lors de la mise à jour.";
            header("Location: /templates/gestion_etudiants.php");
            exit;
        }
    }

    /**
     * Suppression d'un utilisateur
     */
    public function delete()
    {
        session_start();

        if (!isset($_SESSION['user']) || ($_SESSION['user']['role_id'] ?? 0) != 1) {
            header('Location: /index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $success = $this->userModel->deleteUser($id);
            $_SESSION["message"] = $success ? "Utilisateur supprimé avec succès." : "Erreur lors de la suppression.";
            header("Location: /templates/gestion_etudiants.php");
            exit;
        }
    }

    /**
     * Recherche d'utilisateur
     */
    public function search()
    {
        session_start();

        if (!isset($_SESSION['user']) || ($_SESSION['user']['role_id'] ?? 0) != 1) {
            header('Location: /index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $motcle = trim($_POST['motcle'] ?? '');
            $result = !empty($motcle) ? $this->userModel->searchUser($motcle) : [];
            $_SESSION['search_result'] = $result;
        }

        header("Location: /templates/gestion_etudiants.php");
        exit;
    }
}
?>