<?php

// Récupère ma connexion à la base de données
require_once 'core/Connect.php';

class Category extends Connect{

    protected $_pdo;

    public function __construct(){

        $this->_pdo = $this->connection();
    }

    // Récupère toutes les catégories
    public function fetchAllCategories(): array{
        
        // Requête de sélection
        $sql = "SELECT * FROM `category`";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        $query->execute();
        // Je recupère plusieurs lignes donc j'ecris fetchAll et je retourne le résultat 
        return $query->fetchALL(PDO::FETCH_ASSOC);
    }
}
