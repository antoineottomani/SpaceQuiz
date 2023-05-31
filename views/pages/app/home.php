<section class="home-container">

    <!-- ZONE POUR LA BANNIÈRE -->
    <div class="banner">
        <h1>Bienvenue sur SpaceQuiz, le site pour tester tes connaissances en Astronomie</h1>
        <a href="#see-home-quiz" title="Icone permettant de scroller"><i class="fa-solid fa-circle-arrow-down"></i></a>
        <div class="banner-img"></div>
    </div>


    <!-- ZONE POUR AFFICHER TOUS LES QUIZ SUR L'ACCUEIL -->
    <div class="all-quiz">

        <!-- Titre H2 dynamique en fonction du nombre de quiz disponibles -->
        <h2 id="see-home-quiz">
            <?php if (empty($data['listCategories'])) {
                echo "Pas de quiz disponible";
            } else {
                if (count($data['listCategories']) == 1) {
                    echo count($data['listCategories']) . " quiz disponible";
                } else {
                    echo count($data['listCategories']) . " quiz disponibles";
                }
            }; ?>
        </h2>


        <!-- affichage d'un CTA pour un utilisateur anonyme -->
        <?php
        if (!isset($_SESSION['user_id'])) { ?>
        <div class="cta-see-more">
            <a href="?page=user_register" title="Bouton call to action pour s'inscrire">S'inscrire pour voir tous les
                quiz</a>
        </div>
        <?php } ?>


        <ul>
            <!-- CRÉATION DE LA LISTE DES CATÉGORIES DE QUIZ SUR LA PAGE ACCUEIL -->
            <?php foreach ($data['listCategories'] as $category) { ?>
            <li>
                <a href="index.php?page=quiz_preview&id=<?= $category->getId() ?>"
                    title="Miniatures des quiz disponibles">
                    <img src="<?= $category->getCover(); ?>" alt="<?= $category->getDescription(); ?>" />
                    <h3><?= $category->getTheme(); ?></h3>
                </a>
            </li>
            <?php } ?>
        </ul>


    </div>

</section>