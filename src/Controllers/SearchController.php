<?php

// On déclare de l'espace
namespace App\TodolistPhp\Controllers;

// On appelle les class
// On déclare la class nécessaire 
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\TodolistPhp\Repository\SearchRepository;
use App\TodolistPhp\Controllers\AbstractController;

// On déclare le nom de la class
class SearchController extends AbstractController
{
    // On délcare la fonction index
    public function index()
    {
        // Déterminer le dossier qui va contenir les vues
        // __DIR__ = le dossier parant dans lequel on est  et dirname(__DIR__) = renvoie directement à la racine
        $loader = new FilesystemLoader("../templates"); 
        // Initialiser twig 
        $twig = new Environment($loader);

        $keyword = $_POST['keyword'];
        $tasks = new SearchRepository(); 
        $tasks = $tasks->search();
        // Rendre une vue
        $this->render('searchpage.twig', [
                                                'keyword' => $keyword,
                                                'tasks' => $tasks
                                            ]);
    }
    public function searchContact(){
        $loader = new FilesystemLoader("../templates");
        $twig = new Environment($loader);

        $keyword = $_POST['keyword'];
        $messages = new SearchRepository();
        $messages = $messages->searchContact();
        
        $this->render('searchcontactpage.twig', [
                                                'keyword' => $keyword,
                                                'messages' => $messages
                                            ]);
    }
}

?>