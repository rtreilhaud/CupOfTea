<?php
namespace App\Controller;

// Récupère les modèles nécessaires
use App\Autoloader;
use App\Controller\ToolController;
use App\Models\User;

Autoloader::register();

class FormController{

    private $_message;
    private $_userMod;
    private $_tools;

    public function __construct(){

        $this->_message = ['error' => null, 'success' => null];
        $this->_userMod = new User();
        $this->_tools = new ToolController();
    }

    public function confirmPassword(string $psw, string $psw2):bool{

        return ($psw === $psw2) ? true : false;
    }

    public function checkRegisterForm(array $post):array{

        if(!empty($post['email']) && !empty($post['psw']) && !empty($post['psw2'])){

            // Vérifie que l'adresse email est au bon format
            if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){

                $this->_message['error'] = "Votre email n'est pas une adresse valide";
            
            // Si c'est le cas
            }else{

                // Vérifie si l'utilisateur existe
                if($this->_userMod->fetchUser($post['email']) !== false){

                    $this->_message['error'] = 'Cet email est déjà utilisé, veuillez en choisir un autre';

                // S'il n'existe pas
                }else{

                    // Vérifie si le mot de passe est confirmé
                    if($this->confirmPassword($post['psw'], $post['psw2'])){

                        // Ajoute l'utilisateur
                        $this->_userMod->addUser($post['email'], password_hash($post['psw'], PASSWORD_DEFAULT));

                        // Message de confirmation
                        $this->_message['success'] = 'Bienvenue, votre inscription est terminée';

                        // Redirection vers la page de connexion
                        $this->_tools->redirect('index.php?page=login');

                    }else{

                        $this->_message['error'] = 'Le mot de passe de confirmation est différent du mot de passe' ;
                    }
                }
            }

        }else{

            $this->_message['error'] = 'Veuillez remplir les champs demandés';
        }

        return $this->_message;
    }

    public function checkLogin(array $post):array{
    
        if(!empty($post['email']) && !empty($post['psw'])){

            // Instancie le modèle User
            $this->_userMod = new User();
            $user = $this->_userMod->fetchUser($post['email']);

            // Vérifie si l'utilisateur existe
            if($user !== false){

                // Vérifie le mot de passe
                if(password_verify($post['psw'], $user['password'])){

                    // Enregistrement de la session
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = htmlspecialchars($user['email']);
                    $_SESSION['role'] = $user['role'];

                    // Gestion des cookies
                    if(isset($post['remember'])){

                        $this->_tools->setCookies(['email','psw'], 
                                                  ['email' => $post['email'],
                                                  'psw' => $post['psw']]);
                    }else{

                        $this->_tools->deleteCookies(['email', 'psw']);
                    }

                    // Redirection
                    $this->_tools->redirect('index.php?page=home');

                }else{

                    $this->_message['error'] = 'Mot de passe incorrect';
                }

            // S'il n'existe pas
            }else{

                $this->_message['error'] = "Cette adresse email n'est pas inscrite" ;
            }

        }else{

            $this->_message['error'] = 'Veuillez remplir les champs demandés';
        }

        return $this->_message;
    }

    public function checkProfileUpdate(array $post){

        // Déclaration des arrays
        $success = [];
        $error = [];

        foreach(array_keys($post) as $key){

            // Vérification de chaque champ du formulaire
            switch($key){

                case 'firstName':
                case 'lastName':
                case 'address':

                    if($post[$key] === '0' || (int) $post[$key] !== 0){

                        $this->_message['error'][] = "Le champ {$key} n'a pas une valeur valide";
                        $error[] = $key;

                    }else if(!empty($post[$key])){

                        $success[] = $key;
                        $values[] = $post[$key];
                    }

                break;

                case 'tel':

                    if(!empty($post[$key]) && (strlen($post[$key]) !== 10 || (int) $post[$key] < 100000000)){

                        $this->_message['error'][] = "Le champ {$key} n'a pas une valeur valide";
                        $error[] = $key;

                    }else if(!empty($post[$key])){

                        $success[] = $key;
                        $values[] = $post[$key];
                    }

                break;
            }
        }

        // Assemblage de la requête à envoyer au modèle User
        $query = '';
        for($i = 0; $i < count($success); $i++){

            $query .= $success[$i].'="'.$values[$i].'"';

            if($i != count($success) - 1){

                $query .= ', ' ;
            }

            // Met à jour la session
            $_SESSION[$success[$i]] = $values[$i];
        }

        // Envoie de la requête
        $this->_userMod->updateUser($post['userID'],$query);

        // Ecriture des messages
        if(count($error) === 0 && count($success) >= 1){

            // Message de succès
            $this->_message['success'] = 'Votre profil a bien été modifié';

        }else if(count($error) === 1){

            $eField = $error[0];
            // Message d'erreur
            $this->_message['error'] = "Le champ {$eField} n'a pas été modifié (valeur invalide)";

        }else if(count($error) === 2){

            $error1 = $error[0];
            $error2 = $error[1];
            // Message d'erreur
            $this->_message['error'] = "Les champs {$error1} et {$error2} n'ont pas été modifiés (valeurs invalides)";

        }else{

            $eFields = '';
            for($i = 0; $i < count($error); $i++){

                if($i !== count($error) - 1){

                    $eFields .= $error[$i].', ' ;

                }else{

                    $eFields .= 'et '.$error[$i] ;
                }
            }

            // Message d'erreur
            $this->_message['error'] = "Les champs {$eFields} n'ont pas été modifiés (valeurs invalides)";
        }
    
        // Traduction des champs du message d'erreur
        $this->_message['error'] = str_replace(array_keys($post), ['ID', 'Prénom','Nom','Téléphone','Adresse'], $this->_message['error']);

        return ['error' => $this->_message['error'],
                'success' => $this->_message['success'],
                'id' => $success,
                'values' => $values];
    }

    public function checkPasswordUpdate(array $post){

        if(!empty($post['psw']) && !empty($post['newPsw']) && !empty($post['newPsw2'])){

            // Récupère l'utilisateur pour vérifier le mot de passe
            $user = $this->_userMod->fetchUser($post['email']);

            // Vérifie le mot de passe
            if(password_verify($post['psw'], $user['password'])){

                // Vérifie si le nouveau mot de passe est confirmé
                if($this->confirmPassword($post['newPsw'], $post['newPsw2'])){

                    // Modifie le mot de passe
                    $this->_userMod->updatePassword($user['id'], password_hash($post['newPsw'], PASSWORD_DEFAULT));

                    // Modifie les cookies s'ils sont enregistrés
                    if($this->_tools->isCookieSet('psw')){

                        $this->_tools->setCookies(['psw'], ['psw' => $post['newPsw']]);
                    }

                    // Message de confirmation
                    $this->_message['success'] = 'Votre mot de passe a été modifié';

                }else{

                    $this->_message['error'] = 'Le mot de passe de confirmation est différent du mot de passe' ;
                }

            }else{

                $this->_message['error'] = 'Mot de passe incorrect';
            }

        }else{

            $this->_message['error'] = 'Veuillez remplir les champs demandés';
        }

        return $this->_message;
    }

    public function checkAccountDeletion(array $post){

        if(!empty($post['delPsw'])){

            // Récupère l'utilisateur pour vérifier le mot de passe
            $user = $this->_userMod->fetchUser($post['email']);

            // Vérifie le mot de passe
            if(password_verify($post['delPsw'], $user['password'])){

                // Supprime le compte
                $this->_userMod->deleteUser($post['email']);

                // Message de confirmation
                $this->_message['success'] = 'Votre compte a été supprimé';

                // Supprime les cookies
                $this->_tools->deleteCookies(['email', 'psw']);

                // Supprime la session
                session_destroy();

            }else{

                $this->_message['error'] = 'Mot de passe incorrect';
            }

        }else{

            $this->_message['error'] = 'Veuillez entrer votre mot de passe';
        }

        return $this->_message;
    }
}