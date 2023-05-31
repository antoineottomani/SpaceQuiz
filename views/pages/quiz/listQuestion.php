<section class="editing-question-list">

    <div class="back-btn">
        <a title="Bouton pour revenir en arrière" class="return" href="?page=list_category_4_question"><i
                class="fa-solid fa-chevron-left"></i></a>
    </div>

    <!-- ZONE POUR LE POP UP DE SUPPRESSION -->
    <div class=" modal-container">
        <div class="overlay modal-trigger"></div>
        <div class="modal">
            <button class="close-modal modal-trigger">X</button>
            <p class="warning-delete">Es-tu sûr de vouloir supprimer cette question ?</p>
            <div class="btns">
                <form action="" method="POST">
                    <input type="hidden" name="page" value="?page=delete_question_answers">
                    <input type="hidden" id="section" name="section" value="question_answers">
                    <input id="id-selected-question_answers" type="hidden" name="id" value="">
                    <button type="button" class="confirm-delete">Oui</button>
                </form>

                <button class="no-delete modal-trigger">Non</button>
            </div>
        </div>
    </div>


    <div class="content">

        <h1>Gestion des questions</h1>

        <div class="question-listing">
            <ul>
                <?php foreach ($data['allQuestions'] as $question) { ?>
                <li>
                    <h2><?= $question->getTitle(); ?></h2>
                    <img class="thumbnail-edit" src="<?= $question->getIllustration(); ?>"
                        alt="<?= $question->getIllustrationTitle(); ?>" />

                    <div class="actions-edit">
                        <a title="Bouton pour modifier une question"
                            href="?page=edit_question&id=<?= $question->getId() ?>">Modifier</a>
                        <button class="btn-delete modal-btn modal-trigger"
                            id-question="<?= $question->getId() ?>">Supprimer</button>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>

</section>