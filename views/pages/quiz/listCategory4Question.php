<section class="editing-category-list">

    <div class="back-btn">
        <a title="Bouton pour revenir en arrière" class="return" href="?page=question_answers_panel"><i
                class="fa-solid fa-chevron-left"></i></a>
    </div>

    <div class="content">
        <h1>Choix de la catégorie</h1>

        <div class="category-listing">
            <ul>
                <?php foreach ($data['listCategories'] as $category) { ?>
                <li>
                    <h2><?= $category->getTheme(); ?></h2>
                    <img class="thumbnail-edit" src="<?= $category->getCover(); ?>"
                        alt="<?= $category->getDescription(); ?>" />

                    <div class="actions-edit">
                        <a title="Bouton pour voir les questions associées à une catégorie" class="see-questions"
                            href="?page=list_question&idCategory=<?= $category->getId() ?>">Voir
                            les questions</a>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>

</section>