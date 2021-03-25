<main id="login" class="container">

    <form action="" method="POST">
        <fieldset class="flex">
            <input type="email" name="email" id="email" placeholder="Email" <?= $tools->isCookieSet('email') ?>>
            <input type="password" name="psw" id="psw" placeholder="Mot de passe" <?= $tools->isCookieSet('psw') ?>>
            <div>
                <label for="remember"> Se souvenir de moi </label>
                <input type="checkbox" name="remember" id="remember"
                    <?= ($tools->isCookieSet('email')) ? 'checked' : '' ; ?> 
                >
            </div>
        </fieldset>
        <input type="submit" value="Se connecter" class="btn">
        <?php if(isset($message) && $message['error'] !== null): ?>
            <p class='error'><?= $message['error']; ?></p>
        <?php endif; ?>
        <?php if(isset($message) && $message['success'] !== null): ?>
            <p class='success'><?= $message['success']; ?></p>
        <?php endif; ?>
        <p><a href="index.php?page=register"> Vous n'avez pas de compte ? Inscrivez-vous ! </p>
    </form>
</main>