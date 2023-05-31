<?php


namespace SpaceQuiz;

abstract class Controller
{
    // Méthode renderView() qui va retourner une vue
    protected function renderView(string $template, array $data = []): void
    {
        View::renderView($template, $data);
    }

    // Méthode qui va rediriger vers une route précise
    protected function redirectToRoute(string $name, array $params = []): void
    {
        Router::redirectToRoute($name, $params);
    }
}