<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title> Cup of Tea <?= '- '.$title ?></title>
        <!-- Description de la page -->
        <meta name="description" content="Site vitrine pour des thés">
        <!-- Balise nécessaire pour le responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Image Favicon (raccourci Favoris) -->
	    <link rel="icon" type="image/png" href="public/img/title.png">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com"> 
        <link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <!-- FlexSlider -->
        <script src="public/js/jquery.flexslider-min.js"></script>
        <script src="public/js/flexslider.js"></script>
        <link rel="stylesheet" href="public/css/flexslider.css">
        <!-- JS Panier -->
        <script src="public/js/cartManagement.js" type="module" defer></script>
        <!-- CSS -->
        <link rel="stylesheet" href="public/css/normalize.css">
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body>
        <header>
            <p class="dark"> Livraison offerte à partir de 65€ d'achat ! </p>
            <img src="public/img/ribbon.svg" alt="Elu meilleur thé" id="ribbon">
            <div class="container">
                <div class="flex"> 
                    <a href="index.php?page=home"><img src="public/img/logo.png" alt="Logo du site Cup Of Tea"></a>
                    <a href="index.php?page=cart"><p class="panier">
                        <span>Mon panier</span> <i class="fas fa-shopping-cart"></i> <span class="price" id="cartTotal"></span>
                    </p></a>
                </div>

                <nav> 
                    <ul class="flex">
                        <li><a href="index.php?page=listing"> Thés </a></li>
                        <!-- <li><a href="#"> Grands crus </a></li> -->
                        <!-- <li><a href="#"> Accessoires </a></li> -->
                        <!-- <li><a href="#"> Épicerie </a></li> -->
                        <li><a href="index.php?page=about"> Notre histoire </a></li>
                        <?php if(!$tools->isConnected()): ?>
                            <li><a href="index.php?page=login"> Connexion </a></li>
                        <?php else: ?>
                            <li><a href="index.php?page=account"> Mon compte </a></li>
                            <li><a href="index.php?page=orders"> Mes commandes </a></li>
                            <li><a href="index.php?page=logout"> Déconnexion </a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header>
        
        <!-- Main -->
        <?php require 'view/' .$path; ?>
        
        <footer>
            <div>
                <ul class="container flex">
                    <li><i class="fas fa-lock"></i> Paiement sécurisé</li>
                    <li><i class="fas fa-truck"></i> Livraison offerte</li>
                    <li><i class="fas fa-money-bill-alt"></i> Carte fidélité</li>
                    <li><i class="fas fa-phone"></i> Service client</li>
                    <li><i class="fas fa-check-circle"></i> Garantie qualité</li>
                </ul>
            </div>
        
            <nav class="container flex">
                <ul>
                    <li><h3> Cup of Tea</h3></li>
                    <li><a href="index.php?page=about">Notre histoire</a></li>
                    <!-- <li><a href="#">Nos boutiques</a></li> -->
                    <li><a href="index.php?page=listing">Le thé de A à Z</a></li>
                    <!-- <li><a href="#">Espace Clients Professionnels</a></li> -->
                    <!-- <li><a href="#">Recrutement</a></li> -->
                    <!-- <li><a href="#">Contactez-nous !</a></li> -->
                    <!-- <li><a href="#">L'Ecole du thé</a></li> -->
                </ul>
            
                <ul>
                    <li><h3> Commandez en ligne </h3></li>
                    <li><a href="index.php?page=register"> Première visite </a></li>
                    <li><a href="index.php?page=cart"> Mon panier </a></li>        
                    <!-- <li><a href="#">Aide - FAQ</a></li> -->
                    <!-- <li><a href="#">Service client</a></li> -->
                    <li><a href="index.php?page=orders"> Suivre ma commande </a></li>
                    <!-- <li><a href="#">Conditions générales de vente</a></li> -->
                    <!-- <li><a href="#">Informations légales</a></li> -->
                </ul>
            
                <ul>
                    <li><h3> Suivez-nous </h3></li>
                    <li><a href="index.php?page=about"> Notre histoire </a></li>
                    <!-- <li><a href="#">Nos boutiques</a></li> -->
                    <li><a href="index.php?page=listing"> Le thé de A à Z </a></li>
                    <!-- <li><a href="#">Espace Clients Professionnels</a></li> -->
                </ul>
            </nav>
                
            <div>
                <div class="container">
                    <img src="public/img/big.png" alt="logo3wa"/>
                    <p>Cet exercice de <a href="https://3wa.fr/">3W Academy</a> est mis à disposition pour l'usage personnel des étudiants. Pas de Rediffusion- Attribution- Pas d'Utilisation Commerciale - Pas de modification - International" pour l'usage personnel des étudiants.<br/>
                    Pas de Rediffusion- Attribution- Pas d'Utilisation Commerciale - Pas de modification - International. autorisations au-delà du champ de cette licence peuvent être obtenues auprès de <a href="mailto:contact@3wa.fr">contact@3wa.fr</a>. Les maquettes ont été réalisées par Justine Muller.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
