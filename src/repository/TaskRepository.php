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
    public function new(){
        
            // Se connecter à la base de données
        $pdo = new Database (
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
        }
        return $newTask;
    }
    public function show($id){

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


}