<?php

// On déclare le nom d'espace 
namespace App\TodolistPhp;


// On appelle les class
use App\TodolistPhp\Controllers\TaskController;
use App\TodolistPhp\Controllers\HomeController;
use App\TodolistPhp\Controllers\ContactController;
use App\TodolistPhp\Controllers\SearchController;


// ici on n'a pas besoin de l'autoloader car il est appellé dans le index 
require_once('../vendor/autoload.php');

// On déclare le nom de la class

class Router
{

    public function index()
    {
        // exemples de routes
        $routes = [
            '/' => [
                'controller' => 'HomeController@index',
                'method' => 'GET'
            ],

            '/search' => [
                'controller' => 'SearchController@index',
                'method' => 'POST'
            ], // je suis en train de faire celui là 
            // http://localhost/formation_php/todolist_php/public/? %2F= %2F formation_php %2F todolist_php %2F public & keywords=typage

            '/task/search' => [
                'controller' => 'TaskController@search',
                'method' => 'POST'
            ],

            '/contact/search' => [
                'controller' => 'ContactController@search',
                'method' => 'POST'
            ],

            '/task' => [
                'controller' => 'TaskController@index',
                'method' => 'GET'
            ],

            '/task/new' => [
                'controller' => 'TaskController@new',
                'method' => 'POST'
            ],

            '/task/delete/:id' => [
                'controller' => 'TaskController@delete',
                'method' => 'POST'
            ],

            '/task/update/:id' => [
                'controller' => 'TaskController@update',
                'method' => 'POST'
            ],

            '/task/:id' => [
                'controller' => 'TaskController@show',
                'method' => 'GET'
            ],

            '/contact' => [
                'controller' => 'ContactController@index',
                'method' => 'GET'
            ],
        ];
        // Récupérer l'URL demandée
        $url = $_SERVER['REQUEST_URI'];
        $parts = explode('/', $url);
        // echo "<pre>";
        // var_dump($parts); 
        // echo "</pre>";
        // die();

        /////////////////////////////// Trouver le controller et la méthode corresponante  ////////////////////////////////////////////////////////
        // La route pour la home 
        if ($url === '/formation_php/todolist_php/public/') {

            // Instancier le controller et appeler la méthode (est la fonction qui se trouve dans le controle appelé)
            $controller = new HomeController();
            $controller->index();
        }

        // La route pour la tâche
        else if ($url === '/formation_php/todolist_php/public/task') {

            // Instancier le controller et appeler la méthode 
            $controller = new TaskController();
            $controller->index();
        }

        // La route pour la tâche new
        else if ($url === '/formation_php/todolist_php/public/task/new') {

            // Instancier le controller et appeler la méthode 
            $controller = new TaskController();
            $controller->new();
        }

        // La route pour la tâche new

        else if (array_key_exists(6, $parts) && intval($parts[6]) && $parts[6] !== "" && $parts[5] === "delete" && $parts[4] === "task") {
            // Instancier le controller et appeler la méthode 
            $id = (int)$parts[6];
            $controller = new TaskController();
            $controller->delete($id);
        }


        // La route pour la page contact
        else if ($url === '/formation_php/todolist_php/public/contact') {
            // Instancier le controller et appeler la méthode 
            $controller = new ContactController();
            $controller->index();
        }

        
        // La route pour la page contact
        else if ($url === '/formation_php/todolist_php/public/contact/new') {
            // Instancier le controller et appeler la méthode 
            $controller = new ContactController();
            $controller->new();
        }
        
        // /formation_php/todolist_php/public/contact/delete/3
        else if (array_key_exists(6, $parts) && intval($parts[6]) && $parts[6] !== "" && $parts[5] === "delete" && $parts[4] === "contact") {
            // Instancier le controller et appeler la méthode 
            $id = (int)$parts[6];
            $controller = new ContactController();
            $controller->deleteMessage($id);
        }
               // La route pour la tâche update
        // exemple d'url : /formation_php/todolist_php/public/contact/update/11
        if (array_key_exists(6, $parts) && intval($parts[6]) && $parts[5] == "update" && $parts[4] === "contact") {
            // Instancier le controller et appeler la méthode 
            $id = (int)$parts[6];
            $controller = new ContactController();
            $controller->updateMessage($id);
        }

        // "/formation_php/todolist_php/public/task/50/"
        // intval vérifier si c'est un integer

        if (array_key_exists(5, $parts) && intval($parts[5]) && $parts[5] !== "" && $parts[4] === "task") {
            // Instancier le controller et appeler la méthode 
            $id = (int)$parts[5];
            $controller = new TaskController();
            $controller->show($id);
        }


        // La route pour la tâche update
        // exemple d'url : /formation_php/todolist_php/public/task/update/11
        if (array_key_exists(6, $parts) && intval($parts[6]) && $parts[5] == "update" && $parts[4] === "task") {
            // Instancier le controller et appeler la méthode 
            $id = (int)$parts[6];
            $controller = new TaskController();
            $controller->update($id);
        }
                // La route pour la tâche update
        // exemple d'url : /formation_php/todolist_php/public/task/update/status/11
        if (array_key_exists(7, $parts) && intval($parts[7]) && $parts[6] == "status" && $parts[5] == "update" && $parts[4] === "task") {
            // Instancier le controller et appeler la méthode 
            $id = (int)$parts[7];
            $controller = new TaskController();
            $controller->updateStatus($id);
        }

        //localhost/formation_php/todolist_php/public/?%2F = %2F&keywords = typage
        // localhost/formation_php/todolist_php/public/?/=/&keywords=typage
        // http://localhost/formation_php/todolist_php/public/task/search

        if (array_key_exists(5, $parts) && $parts[5] === "search" && $parts[4] === "task") {
        
            // Instancier le controller et appeler la méthode 
            $controller = new SearchController();
            $controller->index();
        }

        // http://localhost/formation_php/todolist_php/public/contact/11
        if (array_key_exists(5, $parts) && intval($parts[5]) && $parts[4] === "contact") {
            // Instancier le controller et appeler la méthode 
            $id = (int)$parts[5];
            $controller = new ContactController();
            $controller->show($id);
        }
        if (array_key_exists(5, $parts) && $parts[5] === "search" && $parts[4] === "contact") {
            // Instancier le controller et appeler la méthode 
            $controller = new SearchController();
            $controller->searchContact();
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
