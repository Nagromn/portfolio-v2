<?php

namespace App;

/**
 * Autoloader
 * @package App
 */
class Autoloader
{
      /**
       * Enregistre notre autoloader
       * @return void
       */
      static function register(): void
      {
            spl_autoload_register([
                  __CLASS__,
                  'autoload'
            ]);
      }

      /**
       * Charge un fichier correspondant à notre classe
       * @param $class string // Le nom de la classe à charger
       * @return void
       */
      static function autoload($class): void
      {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class); // Suprimme le namespace de la classe
            $class = str_replace('\\', '/', $class); // Remplace les \ par des /
            $file = __DIR__ . '/' . $class . '.php'; // Crée le chemin absolu du fichier

            // Si le fichier existe, on l'inclut
            if (file_exists($file)) {
                  require_once $file;
            }
      }
}
