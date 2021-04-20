<?php
namespace App\Models;
use App\Core\Connect;
use \PDO;

class Orders extends Connect{

    protected $_pdo;

    public function __construct(){

        $this->_pdo = $this->connection();
    }

    // Récupère la dernière commande enregistrée
    public function fetchLastOrderID(){

        // Requête de sélection
        $sql = "SELECT Max(id) FROM `orders`";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        $query->execute();
        // Je recupère le résultat 
        $order = $query->fetch(PDO::FETCH_ASSOC);
        return $order['Max(id)'];
    }

    // Ajoute une nouvelle commande dans la base de données 'orders'
    public function addOrder(string $userID, string $total){

        // Requête d'insertion
        $sql = "INSERT INTO `orders` (`user_id`, `total_price`) VALUES (:userID, :total)";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        return $query->execute([
                                ':userID' => $userID,
                                ':total' => $total,
                               ]);
    }

    // Ajoute les détails de la commande dans la base de données 'orderdetails'
    public function addOrderDetails($item, string $orderID){
  
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
}