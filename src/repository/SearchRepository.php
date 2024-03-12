<?php 

// On déclare de l'espace
namespace App\TodolistPhp\Repository;

// On appelle les class nécessaire 
use App\TodolistPhp\Services\Database;

// On déclare la class : SearchRepository

class SearchRepository
{
    public function search()
    {
        // Se connecter à la base de données
        $pdo = new Database (
                                "127.0.0.1",
                                "todolist_php",
                                "3306",
                                "root",
                                ""
                            );

        $keyword = $_POST['keyword'];

        $sql = "SELECT * FROM task
        WHERE title LIKE '%$keyword%'
        or who LIKE '%$keyword%'
        OR description LIKE '%$keyword%'
        OR duration LIKE '%$keyword%'
        OR status LIKE '%$keyword%' ";

        $tasks = $pdo->selectAll($sql , []);  
        
        return $tasks;
    }
    public function searchContact()
    {
        // Se connecter à la base de données
        $pdo = new Database (
                                "127.0.0.1",
                                "todolist_php",
                                "3306",
                                "root",
                                ""
                            );
                // var_dump($_POST);
                $keyword = $_POST['keyword'];

                // var_dump("valeur de keyword : ", $keyword);
                $sql = "SELECT * FROM contact
                        WHERE title LIKE '%$keyword%'
                        OR description LIKE '%$keyword%'";
                
                $messages = $pdo->selectAll($sql , []);
        return $messages;
    }
}