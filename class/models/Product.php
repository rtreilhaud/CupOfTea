<?php
namespace App\Model;
use App\Core\Connect;
use \PDO;

class Product extends Connect{

    protected $_pdo;

    public function __construct(){

        $this->_pdo = $this->connection();
    }

    // Récupère tous les produits de la catégorie demandée
    public function fetchProductsFromCategory(int $category_id): array{
        
        // Requête de sélection
        $sql = "SELECT * FROM `product`
                WHERE category_id = :category_id";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        $query->execute(['category_id' => $category_id]);
        // Je recupère plusieurs lignes donc j'ecris fetchAll et je retourne le résultat 
        return $query->fetchALL(PDO::FETCH_ASSOC);
    }

    // Récupère le produit demandé
    public function fetchProduct(int $product_id){
        
        // Requête de sélection
        $sql = "SELECT * FROM `product`
                WHERE id = :product_id";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        $query->execute(['product_id' => $product_id]);
        // Je recupère le résultat 
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
