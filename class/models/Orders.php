<?php
namespace App\Models;
use App\Core\Connect;
use \PDO;

class Orders extends Connect{

    protected $_pdo;

    public function __construct(){

        $this->_pdo = $this->connection();
    }

    // Ajoute une nouvelle commande dans la base de données
    public function addOrder(string $userID, string $total){

        // Requête d'insertion
        $sql = "INSERT INTO `orders` (`user_id`, `total_price`) VALUES (:userID, :total)";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        $query->execute([
                            ':userID' => $userID,
                            ':total' => $total,
                        ]);
        return $this->_pdo->lastInsertId();
    }

    // Modifie le statut d'une commande
    public function updateOrderStatus(int $orderID, string $status){

        // Requête de mise à jour
        $sql = "UPDATE `orders` SET `status` = '{$status}'
                WHERE id = :orderID";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        return $query->execute([':orderID' => $orderID]);
    }

    // Récupère toutes les commandes de l'utilisateur
    public function fetchOrders(int $userID): array{
    
        // Requête de sélection
        $sql = "SELECT * FROM `orders`
                WHERE `user_id` = :userID";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        $query->execute([':userID' => $userID]);
        // Je recupère plusieurs lignes donc j'ecris fetchAll et je retourne le résultat 
        return $query->fetchALL(PDO::FETCH_ASSOC);
    }
}