<?php

// Récupere mes fichiers de fonction
require_once 'controller/ToolController.php';
require_once 'controller/FormController.php';
require_once 'models/Category.php';
require_once 'models/Product.php';

// Instanciation des mes classes
$tools = new ToolController();
$formCTRL = new FormController();
$categoryMod = new Category();
$productMod = new Product();
$userMod = new User();

// Démarrage de la session
session_start();
// var_dump($_COOKIE);

// Gestion des actions / requêtes AJAX
if(array_key_exists('action', $_GET) && !empty($_POST)){

    switch($_GET['action']){

        // Modifier les informations du profil
        case 'updateProfile':

            $result = $formCTRL->checkProfileUpdate($_POST);
            echo json_encode($result);

        break;

        // Modifier le mot de passe
        case 'updatePassword':

            $result = $formCTRL->checkPasswordUpdate($_POST);
            echo json_encode($result);

        break;

        // Modifier le mot de passe
        case 'deleteAccount':

            $result = $formCTRL->checkAccountDeletion($_POST);
            echo json_encode($result);

        break;
    }

}else{

    // Gestion des pages
    if(array_key_exists('page', $_GET)){

        switch($_GET['page']){

            // Page d'accueil
            case 'home':

                $path = 'home.php';
                $title= 'Accueil';

            break;

            // Page 'Thés'
            case 'listing':

                $path = 'listing.php';
                $title = 'Thés';

                // Récupère les catégories de thé
                $categories = $categoryMod->fetchAllCategories();
            
            break;

            // Page 'Produit'
            case 'product':

                $path = 'product.php';

                if(array_key_exists('pID', $_GET)){

                    // Récupère le thé correspondant à l'ID
                    $product = $productMod->fetchProduct($_GET['pID']);

                    if($product === false){
                        $tools->redirect('index.php?page=listing');
                    }else{
                        $title = $product['name'];
                    }
                    
                }else{

                    $tools->redirect('index.php?page=listing');
                }
            
            break;

            // Page 'Notre histoire'
            case 'about':

                $path = 'about.php';
                $title = 'Notre histoire';

            break;

            // Page 'Inscription'
            case 'register':

                $path = 'register.php';
                $title = 'Inscription';

                if($_POST){

                    // Check the register form
                    $message = $formCTRL->checkRegisterForm($_POST);
                }
                
            break;

            // Page 'Connexion'
            case 'login':

                $path = 'login.php';
                $title = 'Connexion';

                if($_POST){

                    var_dump($_POST);
                    // Check the login
                    $message = $formCTRL->checkLogin($_POST);
                }

            break;

            // Déconnexion
            case 'logout':

                session_destroy();
                $tools->redirect('index.php?page=home');

            break;

            // Page 'Mon compte'
            case 'account':

                $path = 'account.php';
                $title = 'Mon compte';

                if(array_key_exists('email', $_SESSION)){

                    $user = $userMod->fetchUser($_SESSION['email']);

                }else{

                    $tools->redirect('index.php?page=login');
                }

            break;
        }

    }else{

        $tools->redirect('index.php?page=home');
    }

    // J'affiche la page
    require 'templates/template.php';
}
