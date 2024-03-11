<?php 

namespace App\TodolistPhp\Services;

class Utils
{
    //////////////////////////////////////////////// factorisation /////////////////////////////////////////////////////////////////////
    
    // factorisation de la fonction debuf var_Utils::dump
    static function dump($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
    
    // factorisation de la fonction de nettoyage des champs inputs des formulaires
    static function cleaner($input){
        $stringclean = htmlentities(strip_tags($input));
        return $stringclean;
    }
}

?>  