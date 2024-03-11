<?php

// On déclare de l'espace 
namespace App\TodolistPhp\Controllers;

// On déclare la class nécessaire 
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// On déclare la classe HomeController
class HomeController
{
    // On délcare la fonction index
    public function index()
    {
        // echo "C'est la page d'accueil!";

        // Déterminer le dossier qui va contenir les vues
        // __DIR__ = le dossier parant dans lequel on est  et dirname(__DIR__) = renvoie directement à la racine
        $loader = new FilesystemLoader("../templates"); 

        // Initialiser twig 
        $twig = new Environment($loader);

        $message1 = ['Créer une tâche qui est réalisable'];
        $message2 = ['Pense à la temporalité de réalisation e la tâche'];
        // Rendre une vue
        echo $twig->render('homepage.twig', [
                                                'name' => 'Seraphin_BAX',
                                                'message1' => $message1,
                                                'message2' => $message2
                                            ]);
    }
}