<header>

    <!-- PARTIE LOGO + TITRE -->
    <a title="Logo et nom du Quiz" class="site-brand" href="?page=home">
        <img class="logo-brand" src="./public/img/main/logo.png" alt="logo du site" />
        <p class="title-brand">SpaceQuiz</p>
    </a>

    <!-- PARTIE ICON BURGER -->
    <input class="side-menu" type="checkbox" id="side-menu" />
    <label class="burger" for="side-menu"><span class="burger-line"></span></label>

    <!-- PARTIE NAVBAR -->
    <nav class="nav">
        <ul class="menu">
            <li><a title="Lien qui redirige vers l'accueil" href="?page=home">Accueil</a></li>

            <?php if (!$auth->isAuthenticated()) { ?>
            <li><a title="Lien qui redirige vers la page d'inscription" href="?page=user_register">Inscription</a></li>
            <li><a title="Lien qui redirige vers la page de connexion" href="?page=user_login">Connexion</a></li>
            <?php } else { ?>
            <li><a title="Lien qui redirige vers le profil de l'utilisateur" href="?page=user_home">Mon compte</a></li>
            <li><a title="Lien qui permet de se déconnecter" href="?page=user_logout">Déconnexion</a></li>
            <?php } ?>

            <!-- Affichage du lien 'admin' si l'user est authentifié comme admin -->
            <?php
            if ($auth->isAdmin()) {  ?>
            <li><a title="Lien qui redirige vers l'administration" href="?page=admin_panel">Admin</a></li>
            <?php } ?>
        </ul>
    </nav>

</header>