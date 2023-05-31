<?php

namespace App\Model\Manager;

use SpaceQuiz\Manager;
use App\Model\Entity\Question;
use App\Model\Entity\Category;
use App\Model\Entity\Answer;


class QuizManager extends Manager
{
    public function addCategory(Category $categoryProperties): void
    {

        //! PARTIE TABLE CATEGORY
        $newCategory = 'INSERT INTO category (theme, cover, description, user_only) VALUES (:theme, :cover, :description, :user_only)';
        $query = $this->connection->prepare($newCategory);
        $query->execute([
            'theme'   => $categoryProperties->getTheme(),
            'cover'    => $categoryProperties->getCover(),
            'description' => $categoryProperties->getDescription(),
            'user_only' => $categoryProperties->getUserOnly()
        ]);
    }



    public function addAnswers(Answer $answerProperties): void
    {
        // PARTIE TABLE RÉPONSES 
        $newAnswers = "INSERT INTO answer (text, id_question, is_correct) VALUES (:text, :id_question, :is_correct)";

        $query = $this->connection->prepare($newAnswers);
        $query->execute([
            'text' => $answerProperties->getText(),
            'id_question' => $answerProperties->getIdQuestion(),
            'is_correct' => $answerProperties->getIsCorrect()

        ]);
    }

    public function editCategory(Category $category): bool
    {
        $editedCategory = "UPDATE category SET theme = :theme, cover = :cover, description = :description, user_only = :user_only
        WHERE id = :id";

        $query = $this->connection->prepare($editedCategory);
        $status = $query->execute([
            'id' => $category->getId(),
            'theme' => $category->getTheme(),
            'cover' => $category->getCover(),
            'description' => $category->getDescription(),
            'user_only' => $category->getUserOnly()
        ]);

        return $status;
    }
}