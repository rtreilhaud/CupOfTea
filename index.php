<?php
    
if(array_key_exists('page', $_GET)){

    switch($_GET['page']){

        // Page d'accueil
        case 'home':

            $path = 'indexView.php';

        break;

        // Page 'Thés'
        case 'listing':

            $path = 'listingView.php';
        
        break;

        // Page 'Produit'
        case 'product':

            $path = 'productView.php';
        
        break;

        // Page 'Notre histoire'
        case 'about':

            $path = 'aboutView.php';

        break;

    }

}else{

    header('Location: index.php?page=home');
    exit;
}

// J'affiche la page
require 'templates/template.php';


