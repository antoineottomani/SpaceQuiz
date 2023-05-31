<?php

namespace App\Controller;

use SpaceQuiz\Controller;
use App\Model\Manager\QuestionManager;
use App\Model\Manager\AnswerManager;
use App\Model\Manager\CategoryManager;

// Création d'une classe qui va contenir les méthodes relatives aux quiz
class QuizContainerController extends Controller
{
	// Méthode pour afficher le quiz (question / réponses / image)
	public function showQuiz(): void
	{
		if (isset($_GET['id'])) {
			$_SESSION['IdQuizz'] = $_GET['id'];
			$questionManager = new QuestionManager();
			$questions = $questionManager->findQuestionByIdCat($_GET['id']);

			if ($questions == null) {
				$this->redirectToRoute('quiz_results');
			} else {
				$AnswerManager = new AnswerManager();

				// enregistrement de la réponse dans la session
				if (isset($_POST) && !empty($_POST)) {
					$end = microtime(true);
					$idQuestion = $_POST['idQuestion'];
					if (isset($_POST['choice'])) {
						$user_answer_id = $_POST['choice'];
					} else {
						$user_answer_id = '0';
					}

					foreach ($_SESSION['Questions'] as $key => $q) {
						if ($q['id'] == $idQuestion) {
							$_SESSION['Questions'][$key]['user_answer_id'] = $user_answer_id;
							$_SESSION['Questions'][$key]['end'] = $end;
							$delay = $end - $q['start'];
							$_SESSION['Questions'][$key]['delay'] = $delay;
							$is_correct = $AnswerManager->getAnswerStatusById($user_answer_id);
							if (!$is_correct) {
								$is_correct = '0';
							}
							$_SESSION['Questions'][$key]['is_correct'] = $is_correct;
						}
					}
				}

				$idQuestion = $questions->getId();
				$answerManager = new AnswerManager();
				$answers = $answerManager->getAnswers($idQuestion);

				$this->renderView('quiz/quizContent.php', [
					'title' => "Quiz",
					'question' => $questions,
					'answers' => $answers,
					'idQuestion' => $idQuestion
				]);
			}
		} else {
			$this->redirectToRoute('home');
		}
	}

	// Méthode qui affiche les résultats du quiz à la fin
	public function quizzResults(): void
	{

		$categoryManager = new categoryManager();
		$category = $categoryManager->getCategoryById($_SESSION['IdQuizz']);

		$categoryID = $category->getId();
		$categoryName = $category->getTheme();
		$categoryIllustration = $category->getCover();
		$categoryDescription = $category->getDescription();

		$nbQuestions = 0;
		$nbCorrectAnswers = 0;
		$totaldelay = 0;
		$keyStop = count($_SESSION['Questions']) - 1;
		foreach ($_SESSION['Questions'] as $key => $q) {
			if ($key < $keyStop) {
				if ($q['is_correct'] == 1) {
					$nbCorrectAnswers++;
				}
				$totaldelay += $q['delay'];
				$nbQuestions++;
			}
		}

		if ($nbQuestions) {
			$average = $totaldelay / $nbQuestions;
		} else {
			$average = 0;
		}
		if ($nbQuestions > 0) {
			$pc = $nbCorrectAnswers * 100 / $nbQuestions;
			if ($pc == 0) {
				$message = 'Très mauvais !!!!';
			}
			if ($pc > 0 && $pc < 51) {
				$message = 'Pas terrible !';
			}
			if ($pc >= 51) {
				$message = 'Pas mal !';
			}
			if ($pc >= 80) {
				$message = 'Bien !';
			}
			if ($pc == 100) {
				$message = 'Parfait !!!';
			}
		} else {
			$message = 'un peu rapide, non ?';
		}


		$this->renderView('quiz/quizzResults.php', [
			'title' => "Résultats du Quiz",
			'nbQuestions' => $nbQuestions,
			'nbCorrectAnswers' => $nbCorrectAnswers,
			'average' => $average,
			'categoryIllustration' => $categoryIllustration,
			'categoryDescription' => $categoryDescription,
			'categoryName' => $categoryName,
			'categoryID' => $categoryID,
			'message' => $message

		]);
	}
}