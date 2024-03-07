<?php

// On déclare de l'espace
namespace App\TodolistPhp\Controllers;

// On appelle les class
// On déclare la class nécessaire 
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// On déclare le nom de la class
class ContactController
{
    // On délcare la fonction index
    public function index()
    {
        // echo "C'est la page des tâches !";
        
        // Déterminer le dossier qui va contenir les vues
        // __DIR__ = le dossier parant dans lequel on est  et dirname(__DIR__) = renvoie directement à la racine
        $loader = new FilesystemLoader("../templates"); 

        // Initialiser twig 
        $twig = new Environment($loader);

        $tasks = ['Envoyer un message de soutien', 'Vos questions','Vos problèmes'];
        // Rendre une vue
        echo $twig->render('contactpage.twig', [
                                                'name' => 'Seraphin_BAX',
                                                'tasks' => $tasks
                                            ]);
    }
}



?>