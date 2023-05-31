<?php

// Ce fichier définit les routes de l'application
// Chq clé correspond au nom d'une route
// Pour chq route -> le namespace de la classe à instancier
// Le nom de la classe à instancier
// La méthode à appeler de l'objet créé

return [

    // Route de l'accueil 
    'home' => [
        'controller' => App\Controller\AppController::class,
        'method'     => 'home'
    ],


    'quiz_preview' => [
        'controller' => App\Controller\PreviewController::class,
        'method'     => 'showPreview'
    ],

    'quiz_results' => [
        'controller' => App\Controller\QuizContainerController::class,
        'method'     => 'quizzResults'
    ],

    'quiz_content' => [
        'controller' => App\Controller\QuizContainerController::class,
        'method'     => 'showQuiz'
    ],


    // Routes pour l'administration
    'admin_panel'  => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'adminPanel'
    ],


    // Routes pour les catégories
    'category_panel' => [
        'controller'    => App\Controller\AdminController::class,
        'method'        => 'categoryPanel'
    ],

    'add_category' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'addCategory'
    ],

    'edit_category' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'editCategory'
    ],

    'delete_category' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'deleteCategory'
    ],

    'list_category' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'listCategory'
    ],

    // Routes pour les questions et réponses
    'question_answers_panel' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'questionAnswersPanel'
    ],

    'add_question_answers' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'addQuestionAnswers'
    ],

    'list_question' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'listQuestion'
    ],

    'list_category_4_question' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'listCategory4Question'
    ],

    'edit_question' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'editQuestion'
    ],

    'delete_question_answers' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'deleteQuestionAnswers'
    ],


    // Route pour la gestion des utilisateurs
    'user_manager' => [
        'controller' => App\Controller\AdminController::class,
        'method'     => 'userManager'
    ],



    // Routes pour les actions connexion / inscription / mon compte
    'user_register' => [
        'controller' => App\Controller\UserController::class,
        'method' => 'register'
    ],

    'user_login' => [
        'controller' => App\Controller\UserController::class,
        'method' => 'login'
    ],

    'user_logout' => [
        'controller' => App\Controller\UserController::class,
        'method' => 'logout'
    ],

    'user_home' => [
        'controller' => App\Controller\UserController::class,
        'method'     => 'showUserHome'
    ],
];