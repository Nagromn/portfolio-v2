<?php

namespace App\Core;

use App\Controllers\MainController;

/**
 * Router permettant de gérer les routes
 * @package App\Core
 */
class Router
{
      /**
       * Méthode permettant de démarrer le routeur
       * @return void
       */
      public function start()
      {
            session_start(); // On démarre la session

            $uri = $_SERVER['REQUEST_URI']; // On récupère l'URL

            if (!empty($uri) && $uri != '/' && $uri[-1] === '/') {
                  $uri = substr($uri, 0, -1); // On supprime les éventuels '/' en fin d'URL
                  http_response_code(301); // On envoie un code de redirection permanente
                  header('Location: ' . $uri); // On redirige vers l'URL sans le '/'
            }

            $params = []; // On initialise un tableau vide qui contiendra les paramètres de l'URL

            if (isset($_GET['p']))
                  $params = explode('/', $_GET['p']); // On récupère les paramètres de l'URL

            // On vérifie si au moins un paramètre existe
            if (!empty($params) && $params[0] != '') {
                  $controller = '\\App\\Controllers\\' . ucfirst(array_shift($params)) . 'Controller'; // On récupère le nom du contrôleur
                  $controller = new $controller(); // On instancie le contrôleur
                  $action = (isset($params[0])) ? array_shift($params) : 'index'; // On récupère le nom de l'action

                  // On vérifie si l'action existe dans le contrôleur
                  if (method_exists($controller, $action)) {
                        (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action(); // On appelle la méthode $action du contrôleur $controller
                  } else {
                        http_response_code(404); // On envoie un code de réponse 404
                        echo 'La page recherchée n\'existe pas'; // On affiche un message d'erreur
                  }
            } else {
                  $controller = new MainController(); // On instancie le contrôleur MainController
                  $controller->index(); // On appelle la méthode index()
            }
      }
}
