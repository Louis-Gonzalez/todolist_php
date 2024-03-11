<?php

// On déclare de l'espace
namespace App\TodolistPhp\Repository;

// On appelle les class
use App\TodolistPhp\Services\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// On déclare la class： TaskRepository
class TaskRepository
{
    public function index(){

        // Se connecter à la base de données
        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );
        $tasks = $pdo->selectAll("SELECT * FROM task order by id desc");
        return $tasks;
    }
}

