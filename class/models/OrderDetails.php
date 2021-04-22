<?php
namespace App\Models;
use App\Core\Connect;
use \PDO;

class OrderDetails extends Connect{

    protected $_pdo;

    public function __construct(){

        $this->_pdo = $this->connection();
    }

    // Ajoute les détails de la commande dans la base de données
    public function addOrderDetails(array $item, string $orderID){
  
        // Requête d'insertion
        $sql = "INSERT INTO `orderdetails` 
                (`order_id`, `product_id`, `product_name`, `quantity`, `unit_price`) 
                VALUES (:orderID, :prodID, :prodName, :quantity, :price)";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        return $query->execute([
                                ':orderID' => $orderID,
                                ':prodID' => $item['id'],
                                ':prodName' => $item['name'],
                                ':quantity' => $item['quantity'], 
                                ':price' => $item['price']
                               ]);
    }

    // Récupère les détails d'une commande dans la base de données
    public function fetchOrderDetails(string $orderID){

        // Requête de sélection
        $sql = "SELECT * FROM `orderDetails`
                WHERE `order_id` = :orderID";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        $query->execute([':orderID' => $orderID]);
        // Je recupère plusieurs lignes donc j'ecris fetchAll et je retourne le résultat 
        return $query->fetchALL(PDO::FETCH_ASSOC);
    }
}