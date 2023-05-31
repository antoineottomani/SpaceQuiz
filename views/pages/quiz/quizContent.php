<?php
$_SESSION['Questions'][] = array(
    'id' => $data['idQuestion'],
    'user_answer_id' => 0,
    'start' => $ts = microtime(true),
    'end' => $ts,
    'delay' => 0,
    'is_correct' => 0
);
?>

<section class="quiz-container">

    <h1 class="title-question"><?= $data['question']->getTitle(); ?></h1>

    <div class="quiz-card">

        <!-- ZONE D'AFFICHAGE DU QUIZ -->

        <div class="quiz-form">
            <form method="post" action="?page=quiz_content&id=<?= $data['question']->getIdCategory(); ?>">
                <ul class="choices">
                    <?php foreach ($data['answers'] as $answer) { ?>
                    <li>
                        <input type="hidden" name="idQuestion" value="<?= $data['question']->getId(); ?>" />
                        <input class="answer" value="<?= $answer->getId(); ?>" name="choice" type="radio" />
                        <?= $answer->getText(); ?>
                    </li>
                    <?php } ?>
                </ul>

                <div class="next-question">
                    <button type="submit" class="submit-answer">></button>
                </div>
            </form>
        </div>


        <!-- ZONE DE L'IMAGE DE LA QUESTION POSÉE -->
        <div class="quiz-img">
            <img class="thumbnail" src="<?= $data['question']->getIllustration() ?>"
                alt="<?= $data['question']->getIllustrationTitle(); ?>" />
        </div>

    </div>

</section>