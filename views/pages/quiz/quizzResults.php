<section class="quiz-preview">

    <div class="start-area">

        <div class="cover-area">
            <img class="cover" alt="<?= $data['categoryDescription']; ?>" src="<?= $data['categoryIllustration']; ?>">
            <div class="overlay">
                <h1><?= $data['categoryName']; ?></h1>
            </div>
        </div>

        <div class="description-area">
            <p><b><?= $data['message']; ?></b></p>
            <p>Nombre de réponses justes : <?= $data['nbCorrectAnswers']; ?>/<?= $data['nbQuestions']; ?></p>
            <p>Temps de réponse moyen : <?php echo round($data['average'], 3); ?> s.
            <p><a class="play" href="?page=quiz_preview&refreshsession=1&id=<?= $data['categoryID']; ?>">Rejouer ?</a>
        </div>

    </div>

</section>