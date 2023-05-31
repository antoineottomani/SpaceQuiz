<?php

// Ce fichier est le contrôleur pour la gestion des
// pages globales du site (accueil, contact, à propos ...)

namespace App\Controller;

use App\Model\Manager\CategoryManager;
use SpaceQuiz\Controller;


// Création d'une classe qui va contenir les méthodes générales du site
class AppController extends Controller
{


    // Méthode page acceuil
    public function home(): void
    {

		// initialise les sessions de quizz pour garder en mémoire sur le serveur l'avancement du quizz
        $_SESSION['Questions'] = array();
        $_SESSION['IdQuizz'] = array();


        // Afficher les catégories sur la page d'accueil
        $homeCategories = new CategoryManager();


        // Système de filtre pour afficher certaines catégories en fonction de si l'user est connecté
        if (isset($_SESSION['user_id'])) {
            $connected = 1;
        } else {
            $connected = 0;
        }

        $listCategories = $homeCategories->getAllCategories($connected);

        // Renvoie la page d'accueil
        $this->renderView('app/home.php', [
            'title' => 'Accueil',
            'listCategories' => $listCategories
        ]);
    }
}