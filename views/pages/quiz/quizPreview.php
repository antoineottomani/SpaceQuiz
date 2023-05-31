<section class="quiz-preview">

    <div class="start-area">

        <div class="cover-area">
            <img class="cover" alt="<?= $data['singleCategory']->getDescription(); ?>"
                src="<?= $data['singleCategory']->getCover(); ?>">
            <div class="overlay">
                <h1><?= $data['singleCategory']->getTheme(); ?></h1>
            </div>
        </div>

        <div class="description-area">
            <p>Testez vos connaissances</p>
            <a title="Bouton pour jouer à un quiz" class="play"
                href="?page=quiz_content&id=<?= $data['singleCategory']->getId(); ?>">Jouer</a>
        </div>

    </div>
</section>