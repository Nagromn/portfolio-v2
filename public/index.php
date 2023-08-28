<?php

use App\Autoloader;
use App\Core\Router;

define('BASE_PATH', dirname(__DIR__)); // On définit une constante qui contient le chemin vers le dossier racine du projet

require_once BASE_PATH . '/Autoloader.php'; // On inclut notre autoloader

Autoloader::register(); // On enregistre notre autoloader

$app = new Router(); // On instancie notre classe Router

$app->start(); // On démarre notre application