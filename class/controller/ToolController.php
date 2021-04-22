<?php
namespace App\Controller;

class ToolController{

    // Redirige vers l'URL
    public function redirect(string $url):void{

        header('Location: '.$url);
        exit;
    }

    // Vérifie si quelqu'un est connecté
    public function isConnected():bool{

        return (array_key_exists('role', $_SESSION)) ? true : false ;
    }

    // Convertir une date US en date européenne
    public function convertDate(string $date){

        $parts = explode('-', $date);
        $day = explode(' ', $parts[2]);
        $newDate = $day[0].'/'.$parts[1].'/'.$parts[0];

        return $newDate;
    }

    // Traduire le statut d'une commande
    public function translateStatus(string $status){

        switch($status){

            case 'unpaid':
                return 'Non payée';
            break;

            case 'ordered':
                return 'Commandée';
            break;

            case 'shipped':
                return 'Expédiée';
            break;

            case 'received':
                return 'Livrée';
            break;

            default:
                return 'Inconnu';
        }
    }

    /********** Gestion des cookies **********/

    // Ajoute les cookies appelés en paramètres
    public function setCookies(array $cookieNames,  array $cookies):void{

        foreach($cookieNames as $name){

            setcookie($name, $cookies[$name], time()+365*24*3600);
        }
    }

    // Supprime les cookies appelés en paramètre
    public function deleteCookies(array $cookieNames):void{

        foreach($cookieNames as $name){

            if(array_key_exists($name, $_COOKIE)){

                setcookie($name);
                unset($_COOKIE[$name]);
            }
        }
    }

    // Vérifie si un cookie existe
    public function isCookieSet(string $cookie){

        if(array_key_exists($cookie, $_COOKIE)){

            return "value='".$_COOKIE[$cookie]."'";

        }else{

            return false;
        }
    }
}