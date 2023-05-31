<section class="edit-question-answers">


    <div class="back-btn">
        <a title="Bouton pour revenir en arrière" class="return" href="?page=list_category_4_question"><i
                class="fa-solid fa-chevron-left"></i></a>
    </div>

    <h1>Modifier la question et les réponses</h1>

    <div class="edit-block">


        <form action="" method="POST" enctype="multipart/form-data">

            <div class="question-area">

                <label for="title">Titre de la question</label>
                <input type="text" id="title" name="title" value="<?= $data['question']->getTitle(); ?>" />

                <label for="illustration">Image d'illustration</label>
                <img src="<?= $data['question']->getIllustration(); ?>"
                    alt="<?= $data['question']->getIllustrationTitle(); ?>">
                <input type="file" id="illustration" name="illustration" />

                <label for="illustration_title">Nom de l'image</label>
                <input type="text" id="illustration_title" value="<?= $data['question']->getIllustrationTitle(); ?>"
                    name="illustration_title" placeholder="Nom de l'image" />
            </div>

            <div class="answers-area">
                <h2>Réponses</h2>

                <div class="edit-answers">
                    <?php foreach ($data['answers'] as $key => $answer) { ?>
                    <input class="answer" type="text" value="<?= $answer->getText(); ?>" name="answer-<?= $key; ?>" />

                    <div class="is-correct">
                        <label for="is_correct-<?= $key; ?>">Vrai</label>
                        <input type="radio" name="is_correct-<?= $key; ?>" value="1" id="is_correct-<?= $key; ?>"
                            <?php
                                                                                                                        if ($answer->getIsCorrect() == 1) {
                                                                                                                            echo "checked";
                                                                                                                        }; ?>>

                        <label for="is_false-<?= $key; ?>">Faux</label>
                        <input type="radio" name="is_correct-<?= $key; ?>" value="0" id="is_false-<?= $key; ?>"
                            <?php
                                                                                                                    if ($answer->getIsCorrect() == 0) {
                                                                                                                        echo "checked";
                                                                                                                    }; ?>> <?php } ?>
                    </div>
                </div>

                <button type="submit">Modifier</button>
        </form>

    </div>





</section>