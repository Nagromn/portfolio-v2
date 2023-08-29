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

            $this->render('main/index', []); // On appelle la méthode render en lui passant le nom de la vue et le tableau de données en paramètres (ici vide) et le nom du template à utiliser (ici le fichier home.php)
      }

      public function skills(): void
      {
            $this->render('main/skills', []);
      }

      public function experiences(): void
      {
            $this->render('main/experiences', []);
      }

      public function projects(): void
      {
            $this->render('main/projects', []);
      }

      public function contact(): void
      {
            $this->render('main/contact', []);
      }
}
