<?php
namespace App\Controller;

// Nomme les namespace utilisés
use App\Autoloader;
use App\Controller\{ToolController, FormController};
use App\Models\Product;

Autoloader::register();

class AjaxController{

    private $_tools;
    private $_formCTRL;
    private $_productMod;
    private $_POST;

    public function __construct($action, $POST){

        // Instancie les classes 
        $this->_tools = new ToolController();
        $this->_formCTRL = new FormController();
        $this->_productMod = new Product();
        $this->_POST = $POST;

        // Vérifie si la fonction existe
        if(method_exists($this, $action)){

            // Exécute la fonction
            $this->$action(); 

        // Sinon renvoie une erreur
        }else{

            $this->sendError();
        }
    }

    // Modifier les informations du profil
    public function updateProfile(){

        echo json_encode($this->_formCTRL->checkProfileUpdate($this->_POST));
    }

    // Modifier le mot de passe
    public function updatePassword(){

        echo json_encode($this->_formCTRL->checkPasswordUpdate($this->_POST));
    }

    // Supprimer le compte
    public function deleteAccount(){

        echo json_encode($this->_formCTRL->checkAccountDeletion($this->_POST));
    }

    // Récupérer les informations d'un produit
    public function fetchProduct(){

        echo json_encode($this->_productMod->fetchProduct($this->_POST['productID']));
    }

    // Enregistrer la commande si l'utilisateur est connecté
    public function orderCart(){

        if($this->_tools->isConnected()){


        }else{

            echo json_encode(['error' => 'Vous devez être connecté pour passer une commande']);
        }
    }

    // Envoyer une erreur
    public function sendError(){

        echo json_encode(['error' => 'Action impossible']);
    }
}