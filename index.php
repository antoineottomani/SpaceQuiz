<?php

// Ce fichier est le point d'entrée du site 

use SpaceQuiz\Router;

// Il va charger l'autoload 
require_once 'autoload.php';
require_once './config/appConfig.php';
new Router();