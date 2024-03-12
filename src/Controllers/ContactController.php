<?php

// On déclare de l'espace
namespace App\TodolistPhp\Controllers;

// On appelle les class
// On déclare la class nécessaire 
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\TodolistPhp\Services\Database;
use App\TodolistPhp\Services\Utils;
use App\TodolistPhp\Controllers\AbstractController;
use App\TodolistPhp\Repository\ContactRepository;

// On déclare le nom de la class
class ContactController extends AbstractController
{
    public function index()
    {
        // echo "C'est la page d'accueil!";
        $loader = new FilesystemLoader("../templates"); 
        // Initialiser twig 
        $twig = new Environment($loader);
        $messages = new ContactRepository();
        $messages = $messages->index();
        $this->render('contactpage.twig', [
                                                'messages' => $messages,
                                            ]);
    }

    public function show(int $id)
    {

        $loader = new FilesystemLoader("../templates"); 
        // Initialiser twig 
        $twig = new Environment($loader);

        $message = new ContactRepository();
        $message = $message->showMessage($id);

        // Rendre une vue
        $this->render('contactshowpage.twig',  [
                                                        'message'=>$message
                                                    ]);
    }
    public function deleteMessage(int $id)
    {
        $loader = new FilesystemLoader("../templates");
        $twig = new Environment($loader);

        $message = new ContactRepository();
        $message = $message->deleteMessage($id);
        header ('Location: /formation_php/todolist_php/public/contact');
    }
    // On délcare la fonction index
    public function new()
    {
        // Déterminer le dossier qui va contenir les vues
        // __DIR__ = le dossier parant dans lequel on est  et dirname(__DIR__) = renvoie directement à la racine
        $loader = new FilesystemLoader("../templates"); 
        // Initialiser twig 
        $twig = new Environment($loader);

        $message = new ContactRepository();
        $message = $message->new();

        //Rendre une vue
        $this->render('contactnewpage.twig', []);
    }
    public function updateMessage(int $id){

        $loader = new FilesystemLoader("../templates");
        $twig = new Environment($loader);

        $message = new ContactRepository();
        $message = $message->updateMessage($id);

        header ('Location: /formation_php/todolist_php/public/contact');
        // Rendre une vue
        $this->render('contactupdatepage.twig', [
                                                    'message' => $message
                                                ]);
    }
}

?>