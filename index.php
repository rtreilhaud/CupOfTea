<?php

// Récupere mes fichiers de fonction
require_once 'core/Functions.php';
require_once 'models/Category.php';
require_once 'models/Product.php';

// Instanciation des mes classes
$f = new Functions();
$categoryMod = new Category();
$productMod = new Product();

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
                    $f->redirect('index.php?page=listing');
                }else{
                    $title = $product['name'];
                }
                
            }else{

                $f->redirect('index.php?page=listing');
            }
        
        break;

        // Page 'Notre histoire'
        case 'about':

            $path = 'about.php';
            $title = 'Notre histoire';

        break;

    }

}else{

    $f->redirect('index.php?page=home');
}

// J'affiche la page
require 'templates/template.php';