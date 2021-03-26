<?php
namespace App\Core;
use \PDO;

abstract class Connect{
    
    protected string $_host      = 'localhost';
    protected string $_dbName    = 'cupoftea';
    protected string $_user      = 'root';
    protected string $_password  = '';
    protected $pdo;

    public function __construct(){
        
        $this->pdo = $this->connection();    
    }
    
    public function connection(){
        
        // Objet qui appartient à PHP et qui permet ma connexion 
        $pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbName,$this->_user,$this->_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES UTF8');
        
        return $pdo;
    }
}