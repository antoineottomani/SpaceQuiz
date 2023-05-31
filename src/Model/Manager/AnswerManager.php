<?php

namespace App\Model\Manager;

use SpaceQuiz\Manager;
use App\Model\Entity\Answer;

class AnswerManager extends Manager
{

    public function answerInit(): ?Answer
    {
        $answer = array();
        return new Answer($answer);
    }

    public function getAnswerStatusById(int $id): bool
    {
        $sql = 'SELECT is_correct FROM answer WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
        $Answer = $query->fetch();
        if (isset($Answer['is_correct']))
            return $Answer['is_correct'];
        else
            return 0;
    }

    public function getAnswers(int $id): ?array
    {
        $sql = 'SELECT id, text, is_correct FROM answer WHERE answer.id_question = :id ORDER BY RAND()';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);

        $arrayAnswers = $query->fetchAll();
        if (!$arrayAnswers || empty($arrayAnswers)) {
            return null;
        }
        $allAnswers = [];
        foreach ($arrayAnswers as $answer) {
            array_push($allAnswers, new Answer($answer));
        }
        return $allAnswers;
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

    public function getAnswersByQuestionId(int $idQuestion): ?array
    {
        $sql = "SELECT * FROM answer WHERE id_question = :id ";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $idQuestion
        ]);

        $answers = $query->fetchAll();
        if (!$answers || empty($answers)) {
            return [];
        }
        $answersObjects = [];
        foreach ($answers as $element) {
            array_push($answersObjects, new Answer($element));
        }
        return $answersObjects;
    }

    public function editAnswer(Answer $answer): void
    {
        $editedAnswer = "UPDATE answer SET text = :text, is_correct = :is_correct WHERE id = :id";

        $query = $this->connection->prepare($editedAnswer);
        $query->execute([
            'id' => $answer->getId(),
            'text' => $answer->getText(),
            'is_correct' => $answer->getIsCorrect()
        ]);
    }

    public function deleteAnswers(int $idQuestion): void
    {
        $sql =  "DELETE FROM question WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $idQuestion
        ]);
    }
}