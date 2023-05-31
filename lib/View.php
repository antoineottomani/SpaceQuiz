<?php

namespace SpaceQuiz;

abstract class View
{
    // On déclare 2 const qui stock des chemins
    private const PAGES_PATH = "./views/pages/";
    private const LAYOUT_PATH = "./views/layout.php";

    // La méthode renderView() prend 2 param : 
    // le template html à retourner(requis) et 
    // un array de données dynamique pour ce template 
    public static function renderView(string $template, array $data = [])
    {
        $templatePath = self::PAGES_PATH . $template;
        $data = $data;
        $auth = new Authenticator();
        require_once self::LAYOUT_PATH; // Le layout est importé

    }
}