<?php

namespace App\Controllers;

/**
 * Controller principal
 * @package App\Controllers
 */
class MainController extends Controller
{
      /**
       * Affiche la page d'accueil
       * @return void
       */
      public function index(): void
      {
            // $this->template = 'home'; // On change le template utilisé pour la vue

            $this->render('main/index', [], 'home'); // On appelle la méthode render en lui passant le nom de la vue et le tableau de données en paramètres (ici vide) et le nom du template à utiliser (ici le fichier home.php)
      }
}
