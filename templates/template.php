<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Site vitrine pour des thés">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Chosissez votre thé - Cup of Tea</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <!-- FlexSlider -->
        <script src="js/jquery.flexslider-min.js"></script>
        <script src="js/flexslider.js"></script>
        <link rel="stylesheet" href="css/flexslider.css">
        <!-- CSS -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
            <p>Livraison offerte à partir de 65€ d'achat&nbsp;!</p>

            <div class="container">
                <div class="flex"> 
                    <a href="index.php?page=home"><img src="img/logo.png" alt="Logo du site Cup Of Tea"></a>
                    <p class="panier">
                        <span>Mon panier</span> <i class="fas fa-shopping-cart"></i> <strong>42,00€</strong>
                    </p>
                </div>

                <nav class="flex"> 
                    <a href="index.php?page=listing">thés</a>
                    <a href="#">grands crus</a>
                    <a href="#">accessoires</a>
                    <a href="#">épicerie</a>
                    <a href="index.php?page=about">notre histoire</a>
                </nav>
            </div>

            <div id="ribbon">
                <img src="img/ribbon.svg" alt="Elu meilleur thé">
            </div>
        </header>
        
        <!-- Main -->
        <?php require 'view/' .$path; ?>
        
        <footer>
            
            <div>
                <ul class="container flex">
                    <li><i class="fas fa-lock"></i> paiement sécurisé</li>
                    <li><i class="fas fa-truck"></i> livraison offerte</li>
                    <li><i class="fas fa-money-bill-alt"></i> carte fidélité</li>
                    <li><i class="fas fa-phone"></i> service client</li>
                    <li><i class="fas fa-check-circle"></i> garantie qualité</li>
                </ul>
            </div>
        
            <nav class="container flex">
                <ul>
                    <li><h3>cup of tea</h3></li>
                    <li><a href="index.php?page=about">Notre histoire</a></li>
                    <li><a href="#">Nos boutiques</a></li>
                    <li><a href="#">Le thé de A à Z</a></li>
                    <li><a href="#">Espace Clients Professionnels</a></li>
                    <li><a href="#">Recrutement</a></li>
                    <li><a href="#">Contactez-nous&nbsp;!</a></li>
                    <li><a href="#">L'Ecole du thé</a></li>
                </ul>
            
                <ul>
                    <li><h3>commandez en ligne</h3></li>
                    <li><a href="#">Première visite</a></li>
                    <li><a href="#">Aide - FAQ</a></li>
                    <li><a href="#">Service client</a></li>
                    <li><a href="#">Suivre ma commande</a></li>
                    <li><a href="#">Conditions générales de vente</a></li>
                    <li><a href="#">Informations légales</a></li>
                </ul>
            
                <ul>
                    <li><h3>suivez-nous</h3></li>
                    <li><a href="index.php?page=about">Notre histoire</a></li>
                    <li><a href="#">Nos boutiques</a></li>
                    <li><a href="#">Le thé de A à Z</a></li>
                    <li><a href="#">Espace clients professionnels</a></li>
                </ul>
        </nav>
            
        <div>
            <div class="container">
                <img src="img/big.png" alt="logo3wa"/>
                <p>Cet exercice de <a href="https://3wa.fr/">3W Academy</a> est mis à disposition <a href="#">pour l'usage personnel des étudiants</a>. Pas de Rediffusion- Attribution- Pas d'Utilisation Commerciale - Pas de modification - International" pour l'usage personnel des étudiants.<br/>
                Pas de Rediffusion- Attribution- Pas d'Utilisation Commerciale - Pas de modification - International. autorisations au-delà du champ de cette licence peuvent être obtenues auprès de <a href="mailto:contact@3wa.fr">contact@3wa.fr</a>. Les maquettes ont été réalisées par <a href="#">Justine Muller.</a></p>
            </div>
        </div>
        </footer>
    </body>
</html>
