<?php
namespace App\Models;
use App\Core\Connect;
use \PDO;

class User extends Connect{

    protected $_pdo;

    public function __construct(){

        $this->_pdo = $this->connection();
    }

    // Récupère l'utilisateur selon son email
    public function fetchUser(string $email){

        // Requête de sélection
        $sql = "SELECT * FROM `user`
                WHERE email = :email";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        $query->execute(['email' => $email]);
        // Je recupère le résultat 
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Ajoute un nouvel utilisateur dans la base de données
    public function addUser(string $email, string $psw): void{
        
        // Requête d'insertion
        $sql = "INSERT INTO `user` (`email`, `password`) VALUES (:email, :psw)";
        // Je prépare la requête
        $query = $this->_pdo->prepare($sql);
        // Puis je l'exécute 
        $query->execute([
                            ':email' => $email,
                            ':psw' => $psw,
                        ]);
    }

    // Supprime un utilisateur de la base de données
    public function deleteUser(string $email) :void{

         // Requête d'insertion
         $sql = "DELETE FROM `user` WHERE email = '{$email}'";
         // Je prépare la requête
         $query = $this->_pdo->prepare($sql);
         // Puis je l'exécute 
         $query->execute();
    }

    // Modifie les informations de l'utilisateur
    public function updateUser(int $id, string $update): void{

         // Requête de mise à jour
         $sql = "UPDATE `user` SET {$update}
                 WHERE id = :id";
         // Je prépare la requête
         $query = $this->_pdo->prepare($sql);
         // Puis je l'exécute 
         $query->execute([':id' => $id,]);
    }

    // Modifie le mot de passe de l'utilisateur
    public function updatePassword(int $id, string $psw): void{

         // Requête de mise à jour
         $sql = "UPDATE `user` SET `password` = '{$psw}'
                 WHERE id = :id";
         // Je prépare la requête
         $query = $this->_pdo->prepare($sql);
         // Puis je l'exécute 
         $query->execute([':id' => $id]);
    }
}
