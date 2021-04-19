<?php
namespace App;

// Méthodes static accessibles sans instancier la classe
// __CLASS__ donne la classe instaciée
// __NAMESPACE__ donne le namespace actuel
// __DIR__ donne le namespace actuel

class Autoloader{
    
    static function register(){

        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class){

        // On récupère dans $class la totalité du namespace de la classe concernée (ex: App\Controller\ToolController)

        // On retire App\ (ex: Controller\ToolController)
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);

        // On remplace les \ par des / (pour LINUX et MAC)
        $class = str_replace('\\', '/', $class);
        // Windows n'a pas de problème s'il y a un mélange de \ et / 
 
        // On vérifie si le fichier existe
        $file = __DIR__ . '\\' . $class . '.php';
        if(file_exists($file)){
            require_once $file;
        }
    }
}