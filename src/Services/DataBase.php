<?php 

// On déclare l'espace de nom
namespace App\TodolistPhp\Services;


// On utilise PDO et PDOException les fonction natives php
use PDO;
use PDOException;


// class\DataBase.php

class Database {

    // propriète de la basse de données
    private $db_host;
    private $db_name;
    private $db_port;
    private $db_user;
    private $db_pass;

    // proprièté DSN Data Source Name
    private $db_dsn;

    // propriété PDO
    private $pdo;

    // constructeur
    public function __construct(
            $db_host = DB_HOST, 
            $db_name = DB_NAME, 
            $db_port = DB_PORT, 
            $db_user = DB_USER, 
            $db_pass = DB_PASS,
        ) 
        {
            $this->db_host = $db_host; // cela veut dire tu récupères la valeur de l'argument et tu l'assignes à la propriété $db_host
            $this->db_name = $db_name;
            $this->db_port = $db_port;
            $this->db_user = $db_user;
            $this->db_pass = $db_pass;
            $this->db_dsn = 'mysql:host='.$this->db_host.';dbname='.$this->db_name.';port='.$this->db_port.';charset=utf8';
        }
        // On vérifie si le PDO est null soit la base de données non connectée
        private function getPDO() {
            if ($this->pdo === null) {
                try {
                    // connexion à la base donnée mvc_php réutilisation des constantes dans la demande connexion
                    $db = new PDO($this->db_dsn, $this->db_user, $this->db_pass);
                    // ici on active les attributs des erreurs de la connexion et d'exception 
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $error) {
                    // tenter de réessayer la connexion après un certain délai, iconv permet de convertir de l'encodage ISO-8859-1 vers UTF-8
                    echo "Hum problème de connexion au serveur de base de données". iconv('ISO-8859-1','UTF-8',$error->getMessage());
                    die(); // ici on arrête la connexion s'il n'y a pas de connexion
                }
                $this->pdo = $db; // on se connecte à la bdd
            }
            // pdo est appelé qu'une seule fois
            return $this->pdo;
        }
        // function qui récupère tous les données de toutes les colonnes d'une table
        public function selectAll($statement, $params = []) {
            $sql = $this->getPDO()->prepare($statement);
            $sql->execute($params); // on exécute la requête avec le tableau de paramètres et ceci remplace BindParam
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
          // function qui récupère tous les données d'une colonne d'une table
        public function select($statement, $params = []) {
            $sql = $this->getPDO()->prepare($statement);
            $sql->execute($params);
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        // function qui nous sert à faire des insert into, update et delete
        public function query($statement, $params = []){
            $sql = $this->getPDO()->prepare($statement);
            $sql->execute($params);

            return $this->getPDO();
        }
}


?>