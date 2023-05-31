<?php

// Le routeur va analyser le paramètre GET 'page' de l'url
// Puis délégue le traitement à la bonne méthode de la bonne classe

namespace SpaceQuiz;


// index.php va instancier la classe Router ce qui va exécuter le constructeur
class Router
{

    private $routes;

    // Le constructeur charge les routes dans l'attribut $routes et exécute la méthode routing()
    public function __construct()
    {
        $this->routes = require './config/routes.php';
        $this->routing();
    }


    // La méthode routing() vérifie si une route match avec le param GET 'page' et 
    // Si un traitement y est associé (namespace, classe et méthode)
    // Si oui, il instancie le contrôleur associé pour appeler la méthode
    public function routing(): void
    {


        $availableRouteNames = array_keys($this->routes);

        if (isset($_GET['page']) && in_array($_GET['page'], $availableRouteNames, true)) {
            $route = $this->routes[$_GET['page']];
            if (
                !isset($route['controller'])
                || !isset($route['method'])
                || !class_exists($route['controller'])
                || !method_exists($route['controller'], $route['method'])
            ) {
                header("Location: index.php?page=home");
            }
        } else {
            header("Location: index.php?page=home");
        }

        Authenticator::startSession();

        $controller = new $route['controller'];
        $controller->{$route['method']}();

        // Ligne suivante commentée car la méthode startSession est static 
        // Donc on peut y accéder sans instancier la classe



        $controller = new $route['controller'];
        $controller->{$route['method']}();
    }

    // Cette méthode prend en paramètre : $name (le nom de la route à appeler)
    // et $params qui est un assoc array de params GET supplémentaires
    public static function redirectToRoute(string $name, array $params = []): void
    {
        // Contient le chemin complet + nom du fichier courant
        $uri = $_SERVER['SCRIPT_NAME'] . "?page=" . $name;


        // array_walk : parcourt l'array $params et écrit les params sous une forme standard
        if (!empty($params)) {
            array_walk($params, function (&$val, $key) {
                $val = urlencode((string) $key) . '=' . urlencode((string) $val);
            });
            $uri .= '&' . implode('&', $params);
        }
        // Effectue la redirection vers la bonne url
        header("Location: " . $uri);
        die;
    }
}