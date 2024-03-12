<?php

// On déclare de l'espace
namespace App\TodolistPhp\Controllers;

// On appelle les class nécessaire
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\TodolistPhp\Services\Database;
use App\TodolistPhp\Services\Utils;

// On déclare la classe AbstractController
abstract class AbstractController
{
    // protected : c'est des fonction qui sont utilisable seulement par les enfants de la classe
    protected function render(string $template, array $data = []){
        // Déterminer le dossier qui va contenir les vues
        // __DIR__ = le dossier parant dans lequel on est  et dirname(__DIR__) = renvoie directement à la racine
        $loader = new FilesystemLoader("../templates"); 
        $twig = new Environment($loader);
        //Rendre une vue $template = 'taskpage.twig', $data['tasks' => $tasks]
        echo $twig->render($template, $data);
    }
}

?>