<?php
namespace App\Controller;

// Nomme les namespace utilisés
use App\Autoloader;
use App\Controller\{ToolController, FormController};
use App\Models\{Product, Orders, OrderDetails};

Autoloader::register();

class AjaxController{

    private $_tools;
    private $_formCTRL;
    private $_productMod;
    private $_ordersMod;
    private $_oDetailsMod;
    private $_POST;

    public function __construct($action, $POST){

        // Instancie les classes 
        $this->_tools = new ToolController();
        $this->_formCTRL = new FormController();
        $this->_productMod = new Product();
        $this->_ordersMod = new Orders();
        $this->_oDetailsMod = new OrderDetails();
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

    // Modifier le statut de la commande
    public function updateOrderStatus(){

        if(!empty($this->_POST['orderID']) && !empty($this->_POST['status'])){

            $updated = $this->_ordersMod->updateOrderStatus($this->_POST['orderID'], $this->_POST['status']);

            if($updated){
                echo json_encode(['success' => "Le statut de la commande a été modifié"]);
            }else{
                echo json_encode(['error' => "Le statut de la commande n'a pas pu être modifié"]);
            }

        }else{

            echo json_encode(['error' => "Le statut de la commande n'a pas pu être modifié"]);
        }
    }

    // Supprimer le compte
    public function deleteAccount(){

        echo json_encode($this->_formCTRL->checkAccountDeletion($this->_POST));
    }

    // Récupérer les informations d'un produit
    public function fetchProduct(){

        echo json_encode($this->_productMod->fetchProduct($this->_POST['productID']));
    }

    // Récupérer les informations d'une commande
    public function fetchOrderDetails(){

        echo json_encode($this->_oDetailsMod->fetchOrderDetails($this->_POST['orderID']));
    }

    // Enregistrer la commande si l'utilisateur est connecté
    public function orderCart(){

        if($this->_tools->isConnected()){

            if(!empty($this->_POST['total']) && !empty($this->_POST['cart'])){

                // Ajoute la commande à la base de données et récupère son ID
                $lastID = $this->_ordersMod->addOrder($_SESSION['id'], $this->_POST['total']);
                if($lastID){
        
                    // Ajoute chaque ligne du panier dans la base de données
                    foreach(json_decode($this->_POST['cart'], true) as $item){

                        $this->_oDetailsMod->addOrderDetails($item, $lastID);
                    }

                    echo json_encode([
                        'success' => "La commande n°{$lastID} a été enregistrée (visible dans <a href='index.php?page=orders'> 'Mes commandes' </a>)",
                        'orderID' => $lastID
                    ]);

                }else{

                    echo json_encode(['error' => "La commande n'a pas pu être enregistrée"]);
                }

            }else{

                echo json_encode(['error' => "La commande n'a pas pu être enregistrée"]);
            }

        }else{

            echo json_encode(['error' => 'Vous devez être connecté pour passer une commande']);
        }
    }

    // Envoyer une intention de paiement à Stripe si l'utilisateur est connecté
    public function sendPaymentIntent(){

        if($this->_tools->isConnected()){

            if(isset($_POST['total']) && !empty($_POST['total'])){

                require_once 'vendor/autoload.php';
                $total = (float) $_POST['total'];

                // On instancie Stripe
                \Stripe\Stripe::setApiKey('sk_test_51IiLCzBLEnZW0sEoIGgNT25czLkvAUPrp7rWGRlacyqdHlXFLKxfqi4BI1ebw8Q2d54HSdSiEgnFdA0aG9UDaWsR00HkkXi8fv');

                // Intention de paiement
                $intent = \Stripe\PaymentIntent::create([
                    'amount' => $total * 100, // Montant en centimes
                    'currency' => 'eur'
                ]);

                echo json_encode(['intent' => $intent]);

            }else{

                echo json_encode(['error' => "Le paiement n'a pas pu être effectué"]);
            }

        }else{

            echo json_encode(['error' => 'Vous devez être connecté pour payer une commande']);
        }
    }

    // Envoyer une erreur
    public function sendError(){

        echo json_encode(['error' => 'Action impossible']);
    }
}