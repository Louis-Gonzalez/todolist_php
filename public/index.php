<?php 

// On appelle l'autoloader
require_once('../vendor/autoload.php'); // attention le index.php n'est plus à la racine il est dans le dossier public

// On appelle la class nécessaire au routage
use App\TodolistPhp\Router;

// On instancie la classe router et appelle sa méthode
$router = new Router();
$router->index();

// Récupérer l'URL demandée  //// fait 
// Inclure le fichier du controler avec "requi_once"  ////// fait
// Instancier le controler et appeler la méthode  ///// fait 
// Gérer les erreurs (par exemple, afficher un page 404)


?>
