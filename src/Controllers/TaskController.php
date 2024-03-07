<?php

// On déclare de l'espace
namespace App\TodolistPhp\Controllers;

// On déclare la class nécessaire 
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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

        $tasks = ['Faire une entrée', 'Faire un plat','Faire un gateau'];
        // Rendre une vue
        echo $twig->render('taskpage.twig', [
                                                'name' => 'Seraphin_BAX',
                                                'tasks' => $tasks
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

        // Rendre une vue
        echo $twig->render('tasknewpage.twig', [
                                                'name' => 'Seraphin_BAX',
                                                'text' => $text
                                            ]);
    }

    // On délcare la fonction show qui prend en parametre $id
    public function show($id)
    {
        echo "C'est la page pour voir une tâche ". $id . "!"; 
    }
}
