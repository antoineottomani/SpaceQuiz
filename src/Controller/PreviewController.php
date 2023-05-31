<?php

namespace App\Controller;

use App\Model\Manager\CategoryManager;
use SpaceQuiz\Controller;

// Création d'une classe qui va contenir les méthodes relatives à l'affichage des previews
class PreviewController extends Controller
{

    // Méthode qui affiche la preview du quiz qu'on a choisi en fonction de son id
    public function showPreview(): void
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {

            if (isset($_GET['refreshsession'])) {
                $_SESSION['Questions'] = array();
            }

            $previewManager = new CategoryManager();
            $singleCategory = $previewManager->getCategoryById($_GET['id']);

            $this->renderView('quiz/quizPreview.php', [
                'title' => 'Jouer au quiz : ' . $singleCategory->getTheme(),
                'singleCategory' => $singleCategory
            ]);
        } else {
            $this->redirectToRoute('home');
        }
    }
}