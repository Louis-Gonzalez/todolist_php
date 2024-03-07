<?php

// On déclare le nom d'espace 
namespace App\TodolistPhp;


// On appelle les class
use App\TodolistPhp\Controllers\TaskController;
use App\TodolistPhp\Controllers\HomeController;
use App\TodolistPhp\Controllers\ContactController;

// ici on n'a pas besoin de l'autoloader car il est appellé dans le index 
require_once('../vendor/autoload.php');

// On déclare le nom de la class

class Router {

    public function index() {
        // exemples de routes
        $routes = [
            '/' => [
                'controller' => 'HomeController@index',
                'method' => 'GET'],

            '/task' => [
                'controller' => 'TaskController@index',
                'method' => 'GET'],

                '/task/new' => [
                    'controller' => 'TaskController@new',
                    'method' => 'GET'],

            '/task/:id' => [
                'controller' => 'TaskController@show',
                'method' => 'GET'],

            '/contact' => [
                'controller' => 'ContactController@index',
                'method' => 'GET'],
        ]; 
        // Récupérer l'URL demandée
        $url = $_SERVER['REQUEST_URI'];

        /////////////////////////////// Trouver le controller et la méthode corresponante  ////////////////////////////////////////////////////////
        // La route pour la home 
        if ($url === '/formation_php/todolist_php/public/')
        {

            // Instancier le controller et appeler la méthode (est la fonction qui se trouve dans le controle appelé)
            $controller = new HomeController();
            $controller->index();
        }

        // La route pour la tâche
        if ($url === '/formation_php/todolist_php/public/task'){

            // Instancier le controller et appeler la méthode 
            $controller = new TaskController();
            $controller->index();
        }

        // La route pour la tâche new
        if ($url === '/formation_php/todolist_php/public/task/new'){

            // Instancier le controller et appeler la méthode 
            $controller = new TaskController();
            $controller->new();
        }

        // La route pour la page contact
        if ($url === '/formation_php/todolist_php/public/contact'){

            // Instancier le controller et appeler la méthode 
            $controller = new ContactController();
            $controller->index();
        }

        // La route pour la tâche show
        // var_dump($url);
        // "/formation_php/todolist_php/public/task/50/"
        $parts = explode('/', $url);
        if (array_key_exists(5, $parts) && $parts[5] !== "" && $parts[4] === "task"){
            
                // Instancier le controller et appeler la méthode 
                $id = $parts[5];
                $controller = new TaskController();
                $controller->show($id);
        }
        
    }
    // public function notFound() {
    
    //     // On affiche la page 404
    //     // Quand la route n'existe pas
    //     $url = $_SERVER['REQUEST_URI'];
    //     echo "<pre>";
    //     var_dump($url);
    //     echo "</pre>";
    //     die();
    //     $routes = ['/', '/task' , '/task/new', '/task/:id' ];


    //     if (!in_array($url, $routes, true)) {
    //         echo "Error 404 not found";
    //     };
    // }
}


// Récupérer l'URL demandée  //// fait 
// Inclure le fichier du controler avec "requi_once"  ////// fait
// Instancier le controler et appeler la méthode  ///// fait 
// Gérer les erreurs (par exemple, afficher un page 404)


?>