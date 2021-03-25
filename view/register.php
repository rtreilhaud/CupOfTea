<main id="register" class="container">

    <form action="" method="POST">
        <fieldset class="flex">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="psw" id="psw" placeholder="Mot de passe">
            <input type="password" name="psw2" id="psw2" placeholder="Confirmer mot de passe">
        </fieldset>
        <fieldset class="flex none">
            <legend> Facultatif </legend>
            <input type="text" name="firstName" id="firstName" placeholder="Prénom">
            <input type="text" name="lastName" id="lastName" placeholder="Nom">
            <input type="text" name="address" id="address" placeholder="Adresse">
            <input type="tel" name="tel" id="tel" placeholder="Téléphone">
        </fieldset>
        <input type="submit" value="S'inscrire" class="btn">
        <?php if(isset($message) && $message['error'] !== null): ?>
            <p class='error'><?= $message['error']; ?></p>
        <?php endif; ?>
        <?php if(isset($message) && $message['success'] !== null): ?>
            <p class='success'><?= $message['success']; ?></p>
        <?php endif; ?>
    </form>
</main>