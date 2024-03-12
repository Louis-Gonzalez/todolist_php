<?php

// On déclare de l'espace
namespace App\TodolistPhp\Controllers;

// On appelle les class
// On déclare la class nécessaire 
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\TodolistPhp\Services\Database;

// On déclare le nom de la class
class SearchController
{
    // On délcare la fonction index
    public function index()
    {
        // Déterminer le dossier qui va contenir les vues
        // __DIR__ = le dossier parant dans lequel on est  et dirname(__DIR__) = renvoie directement à la racine
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
        // var_dump($_POST);
        $keyword = $_POST['keyword'];

        // var_dump("valeur de keyword : ", $keyword);
        $sql = "SELECT * FROM task
                WHERE title LIKE '%$keyword%'
                or who LIKE '%$keyword%'
                OR description LIKE '%$keyword%'
                OR duration LIKE '%$keyword%'
                OR status LIKE '%$keyword%' ";

        // var_dump("valeur de sql : ", $sql);
        $tasks = $pdo->selectAll($sql , []);             
        // var_dump("valeur de tasks : ", $tasks);
        // echo "<pre>";
        // var_dump("valeur de pdo : ", $pdo);
        // echo "</pre>";

        // Rendre une vue
        echo $twig->render('searchpage.twig', [
                                                'keyword' => $keyword,
                                                'tasks' => $tasks
                                            ]);
    }
}



?>