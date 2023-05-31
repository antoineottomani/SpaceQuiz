<?php

namespace App\Model\Manager;

use App\Model\Entity\Answer;
use SpaceQuiz\Manager;
use App\Model\Entity\Question;

class QuestionManager extends Manager
{

    public function questionInit(): ?Question
    {
        $question = array();
        return new Question($question);
    }


    public function find(int $id): ?array
    {
        $sql = 'SELECT * FROM question WHERE question.id_category = :id';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
        $question = $query->fetchAll();
        if (!$question || empty($question)) {
            return array();
        }

        $questionsObjects = [];
        foreach ($question as $element) {
            array_push($questionsObjects, new Question($element));
        }
        return $questionsObjects;
    }

    public function findQuestionByIdCat(int $id): ?Question
    {
        $temp = array();
        foreach ($_SESSION['Questions'] as $item) {
			if ($item['id']!='') {
				array_push($temp, $item['id']);
			}
        }
		if (empty($temp)) {
			$temp[] = 0;
		}
		
        $sql = 'SELECT * FROM question WHERE id_category = :id AND id NOT IN (' . implode(',', $temp) . ') ORDER BY RAND() LIMIT 0, 1';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);

        $question = $query->fetch();
        if (!$question) {
            return null;
        } else {
            return new Question($question);
		}
    }



    public function addQuestion(Question $questionProperties): int
    {

        // PARTIE TABLE QUESTION
        $newQuestion = "INSERT INTO question (title, illustration, illustration_title, id_category) VALUES (:title, :illustration, :illustration_title, :id_category)";
        $query = $this->connection->prepare($newQuestion);

        $query->execute([
            'title' => $questionProperties->getTitle(),
            'illustration' => $questionProperties->getIllustration(),
            'illustration_title' => $questionProperties->getIllustrationTitle(),
            'id_category' => $questionProperties->getIdCategory()

        ]);

        return $this->connection->lastInsertId();
    }

    public function getQuestionById(int $id): ?Question
    {
        $sql = "SELECT * FROM question WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);

        $question = $query->fetch();
        if (!$question || empty($question)) {
            return null;
        }
        return new Question($question);
    }

    public function deleteQuestion(int $id): void
    { {
            $sql =  "DELETE FROM question WHERE id = :id";
            $query = $this->connection->prepare($sql);
            $query->execute([
                'id' => $id
            ]);
        }
    }

    public function editQuestion(Question $question): bool
    {
        $editedQuestion = "UPDATE question SET title = :title, illustration = :illustration, illustration_title = :illustration_title
        WHERE id = :id";

        $query = $this->connection->prepare($editedQuestion);
        $status = $query->execute([
            'id' => $question->getId(),
            'title' => $question->getTitle(),
            'illustration' => $question->getIllustration(),
            'illustration_title' => $question->getIllustrationTitle()
        ]);

        return true;
    }
}