<?php

namespace App\Controllers;

/**
 * Controller permettant de gérer les vues
 * @package App\Controllers
 */
class Controller
{
      /**
       * Permet de générer la vue
       * @param string $file
       * @param array $data
       * @param string $template
       * @return void
       */
      public function render(string $file, array $data = [], string $template = 'default'): void
      {
            extract($data); // Extraction des données pour les rendre accessibles dans la vue

            ob_start(); // Démarrer le tampon de sortie pour le contenu

            require_once BASE_PATH . '/Views/partials/header.php'; // Inclure le fichier d'en-tête
            $header = ob_get_clean(); // Capturer le contenu du tampon de sortie de l'en-tête
            ob_start(); // Démarrer le tampon de sortie pour le pied de page

            require_once BASE_PATH . '/Views/' . $file . '.php'; // Inclure le fichier de vue
            $content = ob_get_clean(); // Capturer le contenu du tampon de sortie du contenu
            ob_start(); // Démarrer le tampon de sortie pour l'en-tête

            require_once BASE_PATH . '/Views/partials/footer.php'; // Inclure le fichier de pied de page
            $footer = ob_get_clean(); // Capturer le contenu du tampon de sortie du pied de page
            require_once BASE_PATH . '/Views/' . $template . '.php'; // Inclure le fichier de template en utilisant les variables capturées
      }
}
