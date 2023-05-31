<section class="user-profile">

    <h1>Mon compte : <?php echo $auth->getUser()->getLogin(); ?></h1>

    <div class="content-area">

        <!-- FORMULAIRE DE MODIFICATION DE LOGIN ET PASSWORD -->

        <?php include '_errors.php' ?>


        <form action="" method="POST">

            <h2>Modifier mes identifiants</h2>

            <!-- Récupère l'id de l'user connecté -->
            <input type="hidden" name="id" value="<?= $auth->getUser()->getId() ?>" />

            <div class="login-area">
                <label for="login">Nouveau login</label>
                <input type="text" id="login" name="login" required>
            </div>

            <div class="password">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="repeat-password">
                <label for="confirm_password">Répétez le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="btn-edit-profile">Modifier</button>

        </form>

    </div>

</section>