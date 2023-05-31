<!-- FORMULAIRE DE CONNEXION -->
<section class="connexion-area">

    <h1>Connexion</h1>

    <form action="" method="POST">

        <?php include '_errors.php' ?>

        <div class="connexion-content">

            <div class="login-area">
                <label for="login">Login</label>
                <input type="login" name="login" id="login" required>
            </div>

            <div class="password">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

        </div>

        <button class="connexion-btn" type="submit">Se connecter</button>
    </form>

</section>