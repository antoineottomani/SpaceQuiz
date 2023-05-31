<!-- PAGE DE FORMULAIRE D'INSCRIPTION -->
<section class="inscription-area">

    <h1>Inscription</h1>

    <h2>Vous avez déjà un compte ?</h2>
    <a title="Bouton pour se connecter" class="cta-connexion" href="?page=user_login">Se connecter</a>

    <form action="" method="POST">
        <?php include '_errors.php' ?>

        <div class="login-area">
            <label for="login">Votre login</label>
            <input type="text" id="login" name="login" required>
        </div>

        <div class="password">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="repeat-password">
            <label for="confirm_password">Répétez le mot de passe</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <button type="submit">S'inscrire</button>
    </form>


</section>