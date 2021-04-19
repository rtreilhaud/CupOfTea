<?php

// Récupère mon Autoloader
require_once 'class/Autoloader.php';

// Nomme les namespace utilisés
use App\Autoloader;
use App\Controller\{ToolController, ViewController, AjaxController};

Autoloader::register();

// Instanciation des mes classes
$tools = new ToolController();

// Démarrage de la session
session_start();
// var_dump($_COOKIE);

// Gestion des actions / requêtes AJAX
if(array_key_exists('action', $_GET) && !empty($_POST)){

    new AjaxController($_GET['action'], $_POST);

// Gestions des pages
}else if(array_key_exists('page', $_GET)){

    new ViewController($_GET['page']);

// Redirection vers l'Accueil
}else{

    $tools->redirect('index.php?page=home');
}
