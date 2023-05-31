<?php

namespace SpaceQuiz;

use App\Model\Manager\UserManager;
use App\Model\Entity\User;

class Authenticator
{

    // Méthode déclenchée par le routeur qui démarre une session à chq route appelée
    static public function startSession(): void
    {
        session_start();
    }

    // Initialise une variable contenant l'id de l'user connecté
    static public function login(int $id): void
    {
        $_SESSION['user_id'] = $id;
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']) ? true : false;
    }

    public function isAdmin(): bool
    {
        if (isset($_SESSION['user_id'])) {
            $userManager = new UserManager();
            $user = $userManager->find($_SESSION['user_id']);
            if ($user->getRole() == "admin") {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Retourne l'user connecté
    public function getUser(): User
    {
        $userManager = new UserManager();
        return $userManager->find($_SESSION['user_id']);
    }

    static public function logout(): void
    {
        $_SESSION['user_id'] = null;
        session_destroy();
    }
}