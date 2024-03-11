<?php

// On déclare de l'espace
namespace App\TodolistPhp\Controllers;

// On appelle les class
// On déclare la class nécessaire 
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\TodolistPhp\Services\Database;
use App\TodolistPhp\Services\Utils;

// On déclare le nom de la class
class ContactController
{
    public function index(){
        // echo "C'est la page d'accueil!";
        $loader = new FilesystemLoader("../templates"); 
        // Initialiser twig 
        $twig = new Environment($loader);

        // Se connecter à la base de données
        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );
        $messages = $pdo->selectAll("SELECT * FROM contact");
        echo $twig->render('contactpage.twig', [
                                                'messages' => $messages,
                                            ]);
    }

    // On délcare la fonction index
    public function new()
    {
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
            if(isset($_POST['title-message']) && isset($_POST['description-message']) && isset($_POST['email-message'])
            && !empty($_POST['title-message']) && !empty($_POST['description-message']) && !empty($_POST['email-message'])) 
                {
                    $title= Utils::cleaner($_POST['title-message']);
                    $description = Utils::cleaner($_POST['description-message']);
                    $email = Utils::cleaner($_POST['email-message']);
                    $create_at = date('Y-m-d H:i:s');
                    $update_at = date('Y-m-d H:i:s');
                    // Insertion des champs dans la base de données
                    $contact = $pdo->query("    INSERT INTO contact 
                                                (title, description, email, create_at, update_at) 
                                                VALUES ( '$title', '$description', '$email', '$create_at', '$update_at')");
                    // Redirection vers le tableau des tâches
                    header('Location: /formation_php/todolist_php/public/contact');
                }
        }
        // Rendre une vue
        echo $twig->render('contactnewpage.twig', []);
    }

    public function show(int $id){

        $loader = new FilesystemLoader("../templates"); 
        // Initialiser twig 
        $twig = new Environment($loader);

        $pdo = new Database(
            "127.0.0.1",
            "todolist_php",
            "3306",
            "root",
            ""
        );
        $message = $pdo->select("SELECT * FROM contact where id = ". $id );
        // Rendre une vue
        echo $twig->render('contactshowpage.twig',  [
                                                        'message'=>$message
                                                    ]);
    }

    
}

?>