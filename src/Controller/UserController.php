<?php

namespace App\Controller;

use SpaceQuiz\Controller;
use SpaceQuiz\Authenticator;
use App\Model\Manager\UserManager;
use App\Model\Entity\User;

// Création d'une classe qui va contenir les méthodes relatives aux actions d'un user
class UserController extends Controller
{

    // Méthode qui permet de s'inscrire sur le site
    public function register(): void
    {
        $errors = [];

        if (!empty($_POST)) {
            if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
                $errors[] = "Tous les champs doivent être saisis.";
            } else {
                $loginLength = strlen($_POST['login']);
                if ($loginLength < 5 || $loginLength > 30) {
                    $errors[] = "Le login doit comporter entre 5 et 30 caractères.";
                }
                if (strlen($_POST['password']) < 8) {
                    $errors[] = "Le mot de passe doit comporter au moins 8 caractères.";
                }
                if ($_POST['password'] !== $_POST['confirm_password']) {
                    $errors[] = "Les mots de passe saisis ne correspondent pas.";
                }
            }

            if (empty($errors)) {
                $manager = new UserManager();
                $alreadyExists = $manager->findByLogin($_POST['login']);
                if ($alreadyExists) {
                    $errors[] = "Ce pseudo existe déjà !";
                } else {
                    $user = new User();
                    $user->setLogin($_POST['login']);
                    $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $user->setHash_password($passwordHash);
                    $manager->add($user);
                    $this->redirectToRoute('user_login');
                }
            }
        }

        $this->renderView('user/register.php', [
            'title' => 'Inscription',
            'errors' => $errors
        ]);
    }

    // Méthode qui permet à un user de se connecter
    public function login(): void
    {
        $errors = [];
        if (!empty($_POST)) {
            if (empty($_POST['login']) || empty($_POST['password'])) {
                $errors[] = "Tous les champs doivent être saisis.";
            } else {
                $manager = new UserManager();
                $user = $manager->findByLogin($_POST['login']);
                if (!$user) {
                    $errors[] = "Aucun compte n'est associé à ce login.";
                } elseif (!password_verify($_POST['password'], $user->getHash_password())) {
                    $errors[] = "Mauvais mot de passe.";
                }
            }

            if (empty($errors)) {
                Authenticator::login($user->getId());
                $this->redirectToRoute('user_home');
            }
        }
        $this->renderView('user/login.php', [
            'title' => 'Connexion',
            'errors' => $errors
        ]);
    }

    // Méthode qui permet d'afficher le compte de l'utilisateur
    public function showUserHome(): void
    {

        $errors = [];

        if (!empty($_POST)) {
            if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
                $errors[] = "Tous les champs doivent être saisis.";
            } else {
                $loginLength =  strlen($_POST['login']);
                if ($loginLength < 5 || $loginLength > 30) {
                    $errors[] = "Le login doit comporter entre 5 et 30 caractères.";
                }
                if (strlen($_POST['password']) < 8) {
                    $errors[] = "Le mot de passe doit comporter au moins 8 caractères.";
                }

                if ($_POST['password'] !== $_POST['confirm_password']) {
                    $errors[] = "Les mots de passe saisis ne correspondent pas.";
                }
            }

            if (empty($errors)) {
                $manager = new UserManager();
                $alreadyExists = $manager->findByLogin($_POST['login']);
                if ($alreadyExists) {
                    $errors[] = "Ce pseudo existe déjà !";
                } else {
                    $user = new User();
                    $user->setId($_POST['id']);
                    $user->setLogin($_POST['login']);
                    $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $user->setHash_password($passwordHash);
                    $user->setUpdatedAt(new \DateTime(date("Y-m-d H:i:s")));

                    $manager->editLogin($user);
                    $this->redirectToRoute('user_home');
                }
            }
        }

        $this->renderView('user/userHome.php', [
            'title' => 'Mon Compte',
            'errors' => $errors

        ]);
    }

    // Méthode qui permet de se déconnecter et redirige vers la page de connexion
    public function logout(): void
    {
        Authenticator::logout();
        $this->redirectToRoute('user_login');
    }
}