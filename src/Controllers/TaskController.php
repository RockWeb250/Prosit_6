<?php
namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends Controller
{

    public function __construct($templateEngine)
    {
        $this->model = new TaskModel();
        $this->templateEngine = $templateEngine;
    }

    public function welcomePage()
    {
        // Retrieve the list of tasks from the model
        $tasks = $this->model->getAllTasks();
        echo $this->templateEngine->render('index.php', ['tasks' => $tasks]);
    }

    public function addTask()
    {
        // First, we check if the 'task' parameter is present in the POST request
        if (!isset($_POST['task'])) {
            // If not, we redirect the user to the home page
            header('Location: /');
            exit();
        }

        // Then, we retrieve the value of the 'task' parameter
        $task = $_POST['task'];
        // We call the addTask method of the model with the task as a parameter
        $this->model->addTask($task);
        // Finally, we redirect the user to the home page
        header('Location: /');
        exit();
    }

    public function checkTask()
    {
        // First, we check if the 'id' parameter is present in the POST request
        if (!isset($_POST['id'])) {
            // If not, we redirect the user to the home page
            header('Location: /');
            exit();
        }

        // Then, we retrieve the value of the 'id' parameter
        $id = $_POST['id'];
        // We call the checkTask method of the model with the id as a parameter
        $this->model->checkTask($id);
        // Finally, we redirect the user to the home page
        header('Location: /');
        exit();
    }

    public function historyPage()
    {
        // Retrieve the list of tasks from the model
        $tasks = $this->model->getAllTasks();
        // Render the history.twig.html template with the list of tasks
        echo $this->templateEngine->render('politique-confidentialite.php', ['tasks' => $tasks]);
    }

    public function uncheckTask()
    {
        // It's the same as the checkTask method, but we call the uncheckTask method of the model
        if (!isset($_POST['id'])) {
            header('Location: /');
            exit();
        }

        $id = $_POST['id'];
        $this->model->uncheckTask($id);
        header('Location: /');
        exit();
    }

    public function aboutPage()
    {
        // Render the about.twig.html template
        echo $this->templateEngine->render('a-propos.php');
    }
}