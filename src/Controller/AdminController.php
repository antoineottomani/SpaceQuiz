<?php

namespace App\Controller;


use App\Model\Manager\QuizManager;
use SpaceQuiz\Controller;
use App\Model\Manager\CategoryManager;
use App\Model\Manager\FileManager;
use App\Model\Manager\QuestionManager;
use App\Model\Manager\AnswerManager;
use App\Model\Manager\UserManager;


// Création d'une classe qui va contenir les méthodes relatives au back office
class AdminController extends Controller
{

    public function __construct()
    {
        // Constructeur qui interdit à un utilisateur "non administrateur" d'accéder au panel par URL
        // Toute la classe ne peut donc pas être utilisée par un user "non admin"
        if (isset($_SESSION)) {
            $userManager = new UserManager();
            $userId = $_SESSION['user_id'];
            $user = $userManager->find($userId);
            if ($user->getRole() != 'admin') {
                $this->redirectToRoute('home');
            }
        }
    }



    // Méthode qui affiche la vue pour l'administration
    public function adminPanel(): void
    {
        $this->renderView('quiz/adminPanel.php', [
            'title' => 'Gestion des Quiz'
        ]);
    }

    // M&thode qui affiche la vue pour gérer les catégories
    public function categoryPanel(): void
    {
        $this->renderView('quiz/categoryPanel.php', [
            'title' => "Gestion des catégories"
        ]);
    }


    /* Méthode qui permet d'ajouter une catégorie 
        et d'upload des fichiers */
    public function addCategory(): void
    {
        $uploadFile = new FileManager();

        $fileUrl = $uploadFile->upload($_FILES);

        if (isset($_POST) && !empty($_POST)) {

            // Construit l'objet "category"
            $categoryManager = new CategoryManager;
            $category = $categoryManager->categoryInit();
            $category->setTheme($_POST['theme']);
            $category->setCover($fileUrl);
            $category->setDescription($_POST['description']);
            $category->setUserOnly($_POST['user_only']);

            // Ajoute "category" dans la bdd
            $quizManager = new QuizManager();
            $quizManager->addCategory($category);

            // Redirection
            $this->redirectToRoute('list_category');
        } else {
            $this->renderView('quiz/addCategory.php', [
                'title' => 'Ajouter un quiz'
            ]);
        }
    }


    // Méthode qui permet d'ajouter des Q/R et d'upload un fichier 
    public function addQuestionAnswers(): void
    {
        $uploadFile = new FileManager();
        $fileUrl = $uploadFile->upload($_FILES);

        if (isset($_POST) && !empty($_POST)) {

            // Construit les objets "question" et "answer"
            $questionManager = new QuestionManager();
            $question = $questionManager->questionInit();
            $answerManager = new AnswerManager();

            // Permet de définir les attributs des objets avec les valeurs entrées dans le formulaire
            $question->setTitle($_POST['title']);
            $question->setIllustration($fileUrl);
            $question->setIllustrationTitle($_POST['illustration_title']);
            $question->setIdCategory($_POST['id_category']);
            $lastId = $questionManager->addQuestion($question);

            for ($i = 0; $i < MAXANSWERS; $i++) {
                $answers[$i] = $answerManager->answerInit();
                $answers[$i]->setText($_POST['answer-' . $i]);
                $answers[$i]->setIdQuestion($lastId);
                $answers[$i]->setIsCorrect($_POST['is_correct-' . $i]);
                $answerManager->addAnswers($answers[$i]);
            }
            // Redirection
            $this->redirectToRoute('list_category');
        } else {
            // Récupérer les catégories pour les insérer dans le select pour ajouter une Q/R
            $categories = new CategoryManager();
            $selectCategories = $categories->getAllCategories(1, true);


            $this->renderView('quiz/addQuestionAnswers.php', [
                'title' => 'Ajouter des questions et réponses',
                'selectAll' => $selectCategories
            ]);
        }
    }


    // Méthode pour lister les catégories 
    public function listCategory(): void
    {
        $homeCategories = new CategoryManager();
        $listCategories = $homeCategories->getAllCategories(1, true);

        if (isset($_GET['status'])) {
            if ($_GET['status']) {
                $message = "Catégorie bien modifiée !";
            } else {
                $message = "Catégorie non modifiée !";
            }
        } else {
            $message = "";
        }

        $this->renderView('quiz/listCategory.php', [
            'title' => 'Liste des catégories',
            'listCategories' => $listCategories,
            'message' => $message
        ]);
    }

    // Méthode qui permet d'éditer une catégorie
    public function editCategory(): void
    {
        $quizManager = new QuizManager();
        $categories = new CategoryManager();
        $category = $categories->getCategoryById($_GET['id']);

        // Vérifie si le form est soumis
        if (!empty($_POST)) {
            $category->setTheme($_POST['theme']);
            $category->setDescription($_POST['description']);
            $category->setUserOnly($_POST['user_only']);
            if (isset($_FILES)) {
                $fileType = array_keys($_FILES)[0];
                if (!$_FILES[$fileType]['error']) {
                    $uploadFile = new FileManager();
                    $fileToRemove = $category->getCover();
                    unlink($fileToRemove);
                    $fileUrl = $uploadFile->upload($_FILES);
                    $category->setCover($fileUrl);
                }
            }
            $status = $quizManager->editCategory($category);
            $this->redirectToRoute('list_category', array('status' => $status));
        } else {
            $this->renderView('quiz/editCategory.php', [
                'title' => 'Modifier une catégorie',
                'category' => $category
            ]);
        }
    }

    // Méthode qui permet de supprimer une catégorie 
    public function deleteCategory(): void
    {
        $categories = new CategoryManager();
        if (!empty($_POST)) {
            $category = $categories->getCategoryById($_POST['id']);
            $fileToRemove = $category->getCover();
            unlink($fileToRemove);
            $categories->deleteCategory($_POST['id']);
        }
        $this->redirectToRoute('category_panel');
    }


    // Méthode qui affiche la page d'édition de Q/R
    public function questionAnswersPanel(): void
    {
        $this->renderView('quiz/questionAnswerPanel.php', [
            'title' => 'Modifier des questions et réponses'
        ]);
    }


    // Méthode qui liste les catégories pour en modifier les Q/R
    public function listCategory4Question(): void
    {
        $homeCategories = new CategoryManager();
        $listCategories = $homeCategories->getAllCategories(1, true);

        $this->renderView('quiz/listCategory4Question.php', [
            'title' => 'Choix de la catégorie',
            'listCategories' => $listCategories,
        ]);
    }

    // Méthode qui liste les questions pour soit les éditer soit les supprimer
    public function listQuestion(): void
    {
        $listQuestion = new QuestionManager();
        $allQuestions = $listQuestion->find($_GET['idCategory']);


        if (isset($_GET['status'])) {
            if ($_GET['status']) {
                $message = "Question bien modifiée !";
            } else {
                $message = "Question non modifiée !";
            }
        } else {
            $message = "";
        }

        $this->renderView('quiz/listQuestion.php', [
            'title' => 'Choix de la question',
            'allQuestions' => $allQuestions,
            'message' => $message
        ]);
    }


    // Méthode qui permet d'éditer une question et ses réponses
    public function editQuestion(): void
    {
        $questionManager = new QuestionManager();
        $answersManager = new AnswerManager();

        $selectedQuestion = $questionManager->getQuestionById($_GET['id']);
        $allAnswers = $answersManager->getAnswersByQuestionId($_GET['id']);

        if (isset($_POST) && !empty($_POST)) {

            // Mise à jour de la question
            $selectedQuestion->setTitle($_POST['title']);
            $selectedQuestion->setIllustrationTitle($_POST['illustration_title']);
            if (isset($_FILES)) {
                $fileType = array_keys($_FILES)[0];
                if (!$_FILES[$fileType]['error']) {
                    $uploadFile = new FileManager();
                    $fileToRemove = $selectedQuestion->getIllustration();
                    unlink($fileToRemove);
                    $fileUrl = $uploadFile->upload($_FILES);
                    $selectedQuestion->setIllustration($fileUrl);
                }
            }


            $status = $questionManager->editQuestion($selectedQuestion);

            // Mise à jour des réponses
            foreach ($allAnswers as $key => $answer) {
                $answer->setText($_POST['answer-' . $key]);
                $answer->setIsCorrect($_POST['is_correct-' . $key]);
                $answersManager->editAnswer($answer);
            }

            $this->redirectToRoute('list_question&idCategory=' . $selectedQuestion->getIdCategory(), array('status' => $status));
        } else {
            $this->renderView('quiz/editQuestion.php', [
                'title' => 'Modifier une question',
                'question' => $selectedQuestion,
                'answers' => $allAnswers
            ]);
        }
    }

    // Méthode qui permet de supprimer une question et ses réponses
    public function deleteQuestionAnswers(): void
    {
        $question = new QuestionManager();
        $answers = new AnswerManager();

        $getQuestion = $question->getQuestionById($_GET['id']);
        $fileToRemove = $getQuestion->getIllustration();
        unlink($fileToRemove);


        $answers->deleteAnswers($_GET['id']);


        $this->redirectToRoute('list_question&id=' . $getQuestion->getIdCategory());
    }


    // Méthode qui permet d'administrer les utilisateurs du site
    public function userManager(): void
    {

        $message = '';
        $userManager = new UserManager();

        // Parcours des données POST pour déterminer l'Id et le role de chaque user
        if (isset($_POST)) {
            foreach ($_POST as $key => $post) {
                if (substr($key, 0, 4) == 'role') {
                    $idUser = substr($key, 4);
                    $role = $post;
                    $userManager->changeRole($idUser, $role);
                    $message = 'La modification a bien été prise en compte.';
                }
            }
        }
        $userList = $userManager->getAllUsers();


        $this->renderView('user/userManager.php', [
            'title' => 'Gestion des utilisateurs',
            'userList' => $userList,
            'message' => $message
        ]);
    }
}