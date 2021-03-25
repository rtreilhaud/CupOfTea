<main id="account" class="container">
    <h1> Mon compte </h1>
    <nav>
        <ul class="flex">
            <li id="account1" class="active"> Mon profil </li>
            <li id="account2"> Modifier mes informations </li>
            <li id="account3"> Modifier mon mot de passe </li>
            <li id="account4"> Supprimer mon compte </li>
        </ul>
    </nav>

    <section id="s-account1">
        <h2> Mon profil </h2>
        <article>
            <p> <b>Prénom</b> : <span id="firstName"><?= $user['firstName'] ?></span> </p>
            <p> <b>Nom</b> : <span id="lastName"><?= $user['lastName'] ?></span> </p>
            <p> <b>Adresse email</b> : <?= $user['email'] ?> </p>
            <p> <b>Téléphone</b> : <span id="tel"><?= $user['tel'] ?></span> </p>
            <p> <b>Adresse</b> : <span  id="address"><?= $user['address'] ?></span> </p>
        </article>  
    </section>

    <section id="s-account2" class="none">
        <h2> Modifier mes informations </h2>
        <form action="" method="post">
            <fieldset class="flex">
                <input type="hidden" name="userID" value="<?= $user['id'] ?>">
                <div>
                    <label for="firstName"> Prénom : </label>
                    <input type="text" name="firstName" 
                    <?= (!empty($user['firstName'])) ? "value='".$user['firstName']."'" : '' ; ?>>
                </div>
                <div>
                    <label for="lastName"> Nom : </label>
                    <input type="text" name="lastName"
                    <?= (!empty($user['lastName'])) ? "value='".$user['lastName']."'" : '' ; ?>>
                </div>
                <div>
                    <label for="tel"> Téléphone : </label>
                    <input type="tel" name="tel" 
                    <?= (!empty($user['tel'])) ? "value='".$user['tel']."'" : '' ; ?>>
                </div>
                <div>
                    <label for="address"> Adresse : </label>
                    <input type="text" name="address" 
                    <?= (!empty($user['address'])) ? "value='".$user['address']."'" : '' ; ?>>
                </div>              
            </fieldset>
            <input type="submit" value="Confirmer" class="btn">
        </form>
    </section>

    <section id="s-account3" class="none">
        <h2> Modifier mon mot de passe </h2>
        <form action="" method="post">
            <fieldset class="flex">
                <input type="hidden" name="email" value="<?= $user['email'] ?>">  
                <input type="password" name="psw" id="psw" placeholder="Mot de passe actuel">
                <input type="password" name="newPsw" id="newPsw" placeholder="Nouveau mot de passe">
                <input type="password" name="newPsw2" id="newPsw2" placeholder="Confirmation mot de passe">
            </fieldset>
            <input type="submit" value="Confirmer" class="btn">
        </form>
    </section>

    <section id="s-account4" class="none">
        <h2> Suppression du compte </h2>
        <p> Êtes-vous sûr de vouloir supprimer votre compte ? </p>
        <p> Toutes vos informations (profil, commandes, ...) seront perdues ! </p>
        <p class="error"> Veuillez confirmer votre mot de passe </p>
        <form action="" method="post">
            <fieldset>
                <input type="hidden" name="email" value="<?= $user['email'] ?>">
                <input type="password" name="delPsw" id="delPsw" placeholder="Entrez votre mot de passe">
            </fieldset>
            <input type="submit" value="Confirmer" class='btn'>
        </form>
    </section>

    <div id="message"></div>
    
</main>
<script src="public/js/account.js" type="module"></script>