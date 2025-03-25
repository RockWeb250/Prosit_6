<?php
namespace App\Controllers;

use App\Models\Utilisateur;

class GestionUtilisateursController
{
    private $templateEngine;
    private Utilisateur $userModel;

    public function __construct($templateEngine)
    {
        $this->templateEngine = $templateEngine;
        $this->userModel = new Utilisateur();
    }

    /**
     * Affichage paginé de la liste des utilisateurs + stats
     */
    public function index()
    {
        session_start();

        // Vérifier si l'utilisateur est connecté ET admin
        if (!isset($_SESSION['user']) || ($_SESSION['user']->role ?? '') !== 'Admin') {
            header('Location: /index.php');
            exit;
        }

        // Pagination
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $total = $this->userModel->countAll();
        $users = $this->userModel->findAll($limit, $offset);

        // Stats (exemple : total)
        // Si tu veux plus de stats (Admin vs User), tu peux faire une requête plus précise
        $stats = [
            'total_users' => $total
        ];

        // On affiche la page
        echo $this->templateEngine->render('gestion_utilisateurs.twig', [
            'users' => $users,
            'stats' => $stats,
            'page'  => $page,
            'limit' => $limit,
            'total' => $total
        ]);
    }

    /**
     * Création d'un utilisateur (formulaire + traitement POST)
     */
    public function create()
    {
        session_start();
        if (!isset($_SESSION['user']) || ($_SESSION['user']->role ?? '') !== 'Admin') {
            header('Location: /index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST["nom"]);
            $prenom = trim($_POST["prenom"]);
            $email = trim($_POST["email"]);
            $role = trim($_POST["role"] ?? 'User');
            // Hachage du mot de passe
            $passwordHash = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $civilite = $_POST["civilite"] ?? null;

            if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($role) && !empty($passwordHash)) {
                $success = $this->userModel->createUser([
                    'nom'       => $nom,
                    'prenom'    => $prenom,
                    'email'     => $email,
                    'role'      => $role,
                    'motDePasse'=> $passwordHash,
                    'civilite'  => $civilite
                ]);
                if ($success) {
                    $_SESSION["message"] = "Utilisateur ajouté avec succès.";
                } else {
                    $_SESSION["error"] = "Erreur lors de l'ajout de l'utilisateur.";
                }
            } else {
                $_SESSION["error"] = "Veuillez remplir tous les champs.";
            }

            header("Location: /index.php?controller=gestionutilisateurs&action=index");
            exit;
        }

        // Sinon on affiche un formulaire "create_user.twig" (ou .php)
        echo $this->templateEngine->render('create_user.twig');
    }

    /**
     * Modification d'un utilisateur (traitement POST)
     */
    public function update()
    {
        session_start();
        if (!isset($_SESSION['user']) || ($_SESSION['user']->role ?? '') !== 'Admin') {
            header("Location: /index.php");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = (int)$_POST["id"];
            $nom = trim($_POST["nom"] ?? '');
            $prenom = trim($_POST["prenom"] ?? '');
            $email = trim($_POST["email"] ?? '');
            $role = trim($_POST["role"] ?? '');
            $civilite = $_POST["civilite"] ?? null;

            $data = [];
            if ($nom)     $data['nom'] = $nom;
            if ($prenom)  $data['prenom'] = $prenom;
            if ($email)   $data['email'] = $email;
            if ($role)    $data['role'] = $role;
            if ($civilite)$data['civilite'] = $civilite;

            // Si un nouveau mot de passe est envoyé, on le hash
            if (!empty($_POST["password"])) {
                $data['motDePasse'] = password_hash($_POST["password"], PASSWORD_BCRYPT);
            }

            if (!empty($data)) {
                $success = $this->userModel->updateUser($id, $data);
                if ($success) {
                    $_SESSION["message"] = "Utilisateur modifié avec succès.";
                } else {
                    $_SESSION["error"] = "Erreur lors de la mise à jour.";
                }
            }

            header("Location: /index.php?controller=gestionutilisateurs&action=index");
            exit;
        }
    }

    /**
     * Suppression d'un utilisateur (traitement POST)
     */
    public function delete()
    {
        session_start();
        if (!isset($_SESSION['user']) || ($_SESSION['user']->role ?? '') !== 'Admin') {
            header("Location: /index.php");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = (int) $_POST["id"];
            $success = $this->userModel->deleteUser($id);
            if ($success) {
                $_SESSION["message"] = "Utilisateur supprimé avec succès.";
            } else {
                $_SESSION["error"] = "Erreur lors de la suppression.";
            }

            header("Location: /index.php?controller=gestionutilisateurs&action=index");
            exit;
        }
    }

    /**
     * Recherche d'un utilisateur (traitement POST)
     */
    public function search()
    {
        session_start();
        if (!isset($_SESSION['user']) || ($_SESSION['user']->role ?? '') !== 'Admin') {
            header("Location: /index.php");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $searchQuery = trim($_POST["search_query"]);
            $results = [];
            if (!empty($searchQuery)) {
                $results = $this->userModel->searchUser($searchQuery);
            }
            
            // Récup stats (facultatif)
            $stats = [
                'total_users' => $this->userModel->countAll()
            ];

            echo $this->templateEngine->render('gestion_utilisateurs.twig', [
                'search_result' => $results,
                'stats'         => $stats
            ]);
        } else {
            echo "Veuillez utiliser le formulaire de recherche.";
        }
    }
}
