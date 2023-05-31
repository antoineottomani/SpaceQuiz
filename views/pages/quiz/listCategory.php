<section class="editing-category-list">

    <div class="back-btn">
        <a title="Bouton pour revenir en arrière" class="return" href="?page=category_panel"><i
                class="fa-solid fa-chevron-left"></i></a>
    </div>

    <!-- ZONE POUR LE POP UP DE SUPPRESSION -->
    <div class="modal-container">
        <div class="overlay modal-trigger"></div>
        <div class="modal">
            <button class="close-modal modal-trigger">X</button>
            <p class="warning-delete">Es-tu sûr de vouloir supprimer cette catégorie ?</p>
            <div class="btns">
                <form action="?page=delete_category" method="POST">
                    <input type="hidden" name="page" value="?page=delete_category">
                    <input type="hidden" id="section" name="section" value="category">
                    <input id="id-selected-category" type="hidden" name="id" value="">
                    <button type="submit" class="confirm-delete">Oui</button>
                </form>

                <button class="no-delete modal-trigger">Non</button>
            </div>
        </div>
    </div>


    <div class="content">
        <h1>Gestion des catégories</h1>

        <?php if (isset($data['message']) && $data['message'] != "") { ?>
        <blockquote><?= $data['message']; ?></blockquote>
        <?php } ?>


        <div class="category-listing">
            <ul>
                <?php foreach ($data['listCategories'] as $category) { ?>
                <li>
                    <h2><?= $category->getTheme(); ?></h2>
                    <img class="thumbnail-edit" src="<?= $category->getCover(); ?>"
                        alt="<?= $category->getDescription(); ?>" />

                    <div class="actions-edit">
                        <a title="Bouton pour modifier une catégorie"
                            href="?page=edit_category&id=<?= $category->getId() ?>">Modifier</a>
                        <button class="btn-delete modal-btn modal-trigger"
                            id-category="<?= $category->getId() ?>">Supprimer</button>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>

</section>