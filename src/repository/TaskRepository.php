<?php

// On déclare de l'espace
namespace App\TodolistPhp\Repository;

// On appelle les class
use App\TodolistPhp\Services\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\TodolistPhp\Services\Utils;

// On déclare la class： TaskRepository
class TaskRepository
{
    public function index(){

        // Se connecter à la base de données
        $pdo = new Database (
                                "127.0.0.1",
                                "todolist_php",
                                "3306",
                                "root",
                                ""
                            );
        $tasks = $pdo->selectAll("SELECT * FROM task order by id desc");
        return $tasks;
    }
    public function new()
    {
        
            // Se connecter à la base de données
        $pdo = new Database (
                                "127.0.0.1",
                                "todolist_php",
                                "3306",
                                "root",
                                ""
                            );
    // Vérification des champs qui ont update dans le formulaire
    if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['duration']) && isset($_POST['who'])
    && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['duration']) && !empty($_POST['who'])) 
        {
            var_dump($_POST['who']);
            // die();
            $title= Utils::cleaner($_POST['title']);
            $description = Utils::cleaner($_POST['description']);
            $duration = Utils::cleaner($_POST['duration']);
            $who = Utils::cleaner($_POST['who']);
            $status = "En attente";

            // Insertion des champs dans la base de données
            $newTask = $pdo->query("    INSERT INTO task 
                                        (title, description, duration, who, status) 
                                        VALUES ( ?, ?, ?, ?, ?)", [ $title, $description, $duration, $who, $status ]);
        }
        return $newTask;
    }
    public function show($id)
    {
        // la correspondance de l'id souhaite via une requete sql
        // Se connecter à la base de données
        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );
        $task = $pdo->select("SELECT * FROM task WHERE id = " .$id);
        return $task;
    }
    public function delete(int $id)
    {
        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );
        $task = $pdo->select("DELETE FROM task WHERE id = " .$id);
        return $task;
    }

    public function update(int $id)
    {
        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );
            $task = $pdo->select("SELECT * from task where id = " . $id);
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = Utils::cleaner($_POST['title']);
            $description = Utils::cleaner($_POST['description']);
            $duration = Utils::cleaner($_POST['duration']);
            $who = Utils::cleaner($_POST['who']);
            $status = Utils::cleaner($_POST['status']);
            $update_at = date("Y-m-d H:i:s");
            $pdo->query(
                            "update task set title = :title, description = :description, duration = :duration, who = :who, status = :status, update_at = :update_at where id = :id",
                            [
                                'id' => $id,
                                'title' => $title,
                                'description' => $description,
                                'duration' => $duration,
                                'who' => $who,
                                'status' => $status,
                                'update_at' => $update_at,
                            ]
        );
        header("Location: http://localhost/formation_php/todolist_php/public/task");
        }
        return $task;
    }
    public function updateStatus(int $id)
    {
        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );
        $task = $pdo->select("SELECT * from task where id = " . $id);

        $update_at = date("Y-m-d H:i:s");
        $status =   $task['status']; // On récupère le status depuis la requête sql
        
        // var_dump($status);

        if ($status == "En attente") {
            $status = "En cours";
        }
        else if ($status == "En cours") {
                $status = "Termine";
        }
        var_dump($status);

        $pdo->query (
                        "update task set status = :status, update_at = :update_at where id = :id",
                        [
                            'id' => $id,
                            'status' => $status,
                            'update_at' => $update_at,
                        ]
        );
        header("Location: http://localhost/formation_php/todolist_php/public/task");
        
        return $task;
    }
    public function showPlan()
    {
        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );
        $tasks = $pdo->selectAll("SELECT * from task");

        $statusEnAttente = [];
        $statusEncours = [];
        $statusTermine = [];

        foreach ($tasks as $task) {
            if ($task['status'] == "En attente") {
                $statusEnAttente[] = $task;
            }
            else if ($task['status'] == "En cours") {
                $statusEncours[] = $task;
            }
            else if ($task['status'] == "Termine") {
                $statusTermine[] = $task;
            }
        }
        
        return [$tasks, $statusEnAttente, $statusEncours, $statusTermine];
    }
    
}