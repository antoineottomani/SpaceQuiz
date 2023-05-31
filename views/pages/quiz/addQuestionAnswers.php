<section class="add-question-answers">

    <div class="back-btn">
        <a title="Bouton pour revenir en arrière" class="return" href="?page=question_answers_panel"><i
                class="fa-solid fa-chevron-left"></i></a>
    </div>

    <h1>Ajouter une question et des réponses</h1>

    <div class="question-block">


        <form action="" method="POST" enctype="multipart/form-data">

            <div class="question-area">
                <h2>Partie question</h2>
                <input type="text" name="title" placeholder="Titre de la question" />
                <input type="file" name="illustration" />
                <input type="text" name="illustration_title" placeholder="Nom de l'image" />


                <!-- Création d'une liste déroulante avec les catégories et leurs id pour leur rattacher des questions -->
                <select name="id_category" id="category-select">
                    <option value="">- Choisir une catégorie -</option>

                    <?php foreach ($data['selectAll'] as $selectedCategory) { ?>

                    <option value="<?= $selectedCategory->getId(); ?>"><?= $selectedCategory->getTheme(); ?></option>

                    <?php } ?>
                </select>
            </div>

            <div class="answers-area">
                <h2>Partie réponses</h2>

                <div class="answers">
                    <?php for ($i = 0; $i < MAXANSWERS; $i++) { ?>
                    <input class="input-answer" type="text" placeholder="Réponse <?= $i; ?>" name="answer-<?= $i; ?>" />

                    <div class="verify-answers">
                        <label for="is_correct-<?= $i; ?>">Vrai</label>
                        <input type="radio" name="is_correct-<?= $i; ?>" value="1" id="is_correct-<?= $i; ?>">

                        <label for="is_false-<?= $i; ?>">Faux</label>
                        <input type="radio" name="is_correct-<?= $i; ?>" value="0" id="is_false-<?= $i; ?>">
                    </div>
                    <?php } ?>
                </div>
            </div>

            <button type="submit">Ajouter</button>

        </form>

    </div>


</section>