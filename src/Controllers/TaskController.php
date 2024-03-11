<?php

// On déclare de l'espace
namespace App\TodolistPhp\Controllers;

// On déclare la class nécessaire 

use App\TodolistPhp\Services\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\TodolistPhp\Services\Utils;
use App\TodolistPhp\Repository\TaskRepository;

// On déclare la classe TaskController
class TaskController
{
    // On délcare la fonction index par default
    public function index()
    {
        // echo "C'est la page des tâches !";
        
        // Déterminer le dossier qui va contenir les vues
        // __DIR__ = le dossier parant dans lequel on est  et dirname(__DIR__) = renvoie directement à la racine
        $loader = new FilesystemLoader("../templates"); 

        // Initialiser twig 
        $twig = new Environment($loader);

        $taskRepository = new TaskRepository();
        $tasks = $taskRepository->index();

        // Rendre une vue
        echo $twig->render('taskpage.twig', [
                                                'tasks' => $tasks,
                                            ]);
    }
// On délcare la fonction new
    public function new()
    {
        $text = "C'est la page pour ajouter une tâche !";
        
        // Déterminer le dossier qui va contenir les vues
        // __DIR__ = le dossier parant dans lequel on est  et dirname(__DIR__) = renvoie directement à la racine
        $loader = new FilesystemLoader("../templates"); 

        // Initialiser twig 
        $twig = new Environment($loader);

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

                    // Se connecter à la base de données
            $pdo = new Database(
                                    "127.0.0.1",
                                    "todolist_php",
                                    "3306",
                                    "root",
                                    ""
                                );

            // Vérification des champs qui ont update dans le formulaire
            if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['duration']) && isset($_POST['status'])
            && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['duration']) && !empty($_POST['status'])) 
                {
                    $title= Utils::cleaner($_POST['title']);
                    $description = Utils::cleaner($_POST['description']);
                    $duration = Utils::cleaner($_POST['duration']);
                    $status = Utils::cleaner($_POST['status']);

                    // Insertion des champs dans la base de données
                    $newTask = $pdo->query("    INSERT INTO task 
                                                (title, description, duration, status) 
                                                VALUES ( '$title', '$description', '$duration', '$status')");
                    // Redirection vers le tableau des tâches
                    header('Location: /formation_php/todolist_php/public/task');
                }
        }
        // Rendre une vue
        echo $twig->render('tasknewpage.twig', [
                                                'text' => $text,
                                                ]);
    }
    public function delete(int $id)
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
        $task = $pdo->select("DELETE FROM task WHERE id = " .$id);
        header('Location: /formation_php/todolist_php/public/task');
    }
    public function update($id) {
        $loader = new FilesystemLoader("../templates"); 
        $twig = new Environment($loader);

        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );
        $task = $pdo->select(
            "SELECT * from task where id = " . $id
        );

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = Utils::cleaner($_POST['title']);
            $description = Utils::cleaner($_POST['description']);
            $duration = Utils::cleaner($_POST['duration']);
            $status = Utils::cleaner($_POST['status']);
            $update_at = date("Y-m-d H:i:s");

            $pdo->query(
                            "update task set title = :title, description = :description, duration = :duration, status = :status, update_at = :update_at where id = :id",
                            [
                                'id' => $id,
                                'title' => $title,
                                'description' => $description,
                                'duration' => $duration,
                                'status' => $status,
                                'update_at' => $update_at,
                            ]
        );
        header("Location: http://localhost/formation_php/todolist_php/public/task");
        }
        
        echo $twig->render('taskupdatepage.twig',   [
                                                    'task' => $task
                                                    ]);
    }
    
    // On délcare la fonction show qui prend en parametre $id
    public function show(int $id)

    {   
        
        // Déterminer le dossier qui va contenir les vues   
        $loader = new FilesystemLoader("../templates"); 

        // Initialiser twig 
        $twig = new Environment($loader);

        // la correspondance de l'id souhaite via une requete sql
        // Se connecter à la base de données
        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );

        ////////////// Méthode 1 ////////////////////////////////////////////////////////////////
        // $tasks = $pdo->selectAll("SELECT * FROM task ");

        // echo $twig->render('taskshowpage.twig', [   
        //                                             'tasks' => $tasks,
        //                                             'id' => $id,
        //                                             'title' => $tasks[$id-1]['title'],
        //                                             'description' => $tasks[$id-1]['description'],
        //                                             'duration' => $tasks[$id-1]['duration'],
        //                                             'status' => $tasks[$id-1]['status'],
        //                                             'create_at' => $tasks[$id-1]['create_at'],
        //                                             'update_at' => $tasks[$id-1]['update_at']
        //                                         ]);

        /////////// Méthode 2 //////////////////////////////////////////////////////////////////////
        $task = $pdo->select("SELECT * FROM task WHERE id = " .$id);

        echo $twig->render('taskshowpage2.twig',[
                                                    'task' => $task
                                                ]);
    }
}
