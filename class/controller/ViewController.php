<?php
namespace App\Controller;

// Nomme les namespace utilisés
use App\Autoloader;
use App\Controller\{ToolController, FormController};
use App\Models\{Category, Product, User};

Autoloader::register();

class ViewController{

    private $_tools;
    private $_formCTRL;
    private $_categoryMod;
    private $_productMod;
    private $_userMod;

    public function __construct($page){

        // Instanciation des classes
        $this->_tools = new ToolController();
        $this->_formCTRL = new FormController();
        $this->_categoryMod = new Category();
        $this->_productMod = new Product();
        $this->_userMod = new User();

        // Récupère la fonction liée à la page
        $view = $page . 'View';

        // Si la fonction existe
        if(method_exists($this, $view)){

            // Récupère les données
            $data = $this->$view(); 

        // Sinon redirige la page
        }else{

            $this->_tools->redirect('index.php?page=home');
        }
        
        // Affiche la page
        $this->displayTemplate($data);
    }

    // Page d'accueil
    public function homeView(){

        // Données de la page
        $data = [
            'path' => 'home.php',
            'title' => 'Accueil'
        ];

        return $data;
    }

    public function listingView(){

         // Données de la page
         $data = [
            'path' => 'listing.php',
            'title' => 'Thés',
            'categories' => $this->_categoryMod->fetchAllCategories(),
            'productMod' => $this->_productMod
        ];

        return $data;
    }


    // Page 'Produit'
    public function productView(){

        // Vérifie s'il y a un ID de produt
        if(array_key_exists('pID', $_GET)){

            // Récupère le thé correspondant à l'ID
            $product = $this->_productMod->fetchProduct($_GET['pID']);

            // S'il n'existe pas, redirige vers la liste des thés
            if($product === false){

                $this->_tools->redirect('index.php?page=listing');

            // Si la page produit existe
            }else{

                // Données de la page
                $data = [
                    'path' => 'product.php',
                    'title' => $product['name'],
                    'product' => $product
                ];
        
                return $data;
            }
            
        }else{

            $this->_tools->redirect('index.php?page=listing');
        }
    }

    // Page 'Notre histoire'
    public function aboutView(){

        // Données de la page
        $data = [
            'path' => 'about.php',
            'title' => 'Notre histoire'
        ];

        return $data;
    }

    // Page 'Inscription'
    public function registerView(){

        // Données de la page
        $data = [
            'path' => 'register.php',
            'title' => 'Inscription'
        ];

        if($_POST){

            // Vérifie le formulaire d'inscription
            $data['message'] = $this->_formCTRL->checkRegisterForm($_POST);
        }

        return $data;
    }

    // Page 'Connexion'
    public function loginView(){

        // Données de la page
        $data = [
            'path' => 'login.php',
            'title' => 'Connexion'
        ];

        if($_POST){

            // Vérifie le formulaire de connexion
            $data['message'] = $this->_formCTRL->checkLogin($_POST);
        }

        return $data;
    }

    // Déconnexion
    public function logoutView(){

        session_destroy();
        $this->_tools->redirect('index.php?page=home');
    }

    // Page 'Mon compte'
    public function accountView(){

        // Vérifie si l'utilisateur est connecté
        if(array_key_exists('email', $_SESSION)){

            // Données de la page
            $data = [
                'path' => 'account.php',
                'title' => 'Mon compte',
                'user' => $this->_userMod->fetchUser($_SESSION['email'])
            ];

            return $data;

        // S'il n'est pas connecté, redirige vers la page de connexion
        }else{

            $this->ools->redirect('index.php?page=login');
        }
    }

    // Page 'Mon panier'
    public function cartView(){

        // Données de la page
        $data = [
            'path' => 'cart.php',
            'title' => 'Mon panier'
        ];

        return $data;
    }

    // Affiche le template en fonction des variables données
    public function displayTemplate(array $variables){

        // Convertit le tableau en variables (ex: $path = $variable['path'])
        extract($variables);

        // Ajoute le ToolController (nécessaire pour le template)
        $tools = $this->_tools;

        // Affiche la page
        require 'templates/template.php';
    }
}