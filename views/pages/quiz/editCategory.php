<section class="edit-category">

    <div class="back-btn">
        <a class="return" title="Bouton pour revenir en arrière" href="?page=list_category"><i
                class="fa-solid fa-chevron-left"></i></a>
    </div>

    <h1>Modifier une catégorie</h1>

    <form action="" method="post" enctype="multipart/form-data">

        <label for="theme">Nom de la catégorie</label>
        <input type="text" id="theme" name="theme" value="<?= $data['category']->getTheme(); ?>" />

        <label for="cover">Image de la catégorie</label>
        <input type="file" name="cover" id="cover" />

        <img src="<?= $data['category']->getCover(); ?>" alt="<?= $data['category']->getDescription(); ?>">


        <label for="description">Description</label>
        <input type="text" name="description" id="description"
            value="<?php echo $data['category']->getDescription(); ?>" />

        <div class="user-choices">
            <input type="radio" value="1" name="user_only" <?php if ($data['category']->getUserOnly()) {
                                                                echo "checked";
                                                            } ?> />Catégorie disponible pour l'utilisateur connecté
            <input type="radio" value="0" name="user_only" <?php if (!$data['category']->getUserOnly()) {
                                                                echo "checked";
                                                            } ?> />Catégorie disponible pour tous
        </div>

        <div class="edit-form-btn">
            <button type="submit" class="submit-btn">Modifier</button>
            <a title="Bouton pour annuler l'édition de catégorie" href="?page=list_category"><button type="button"
                    class="submit-btn">Annuler</button></a>
        </div>
    </form>

</section>