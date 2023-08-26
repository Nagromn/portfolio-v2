<?php

// Design pattern Singleton
// https://fr.wikipedia.org/wiki/Singleton_(patron_de_conception)

namespace App\Core;

use PDO;
use PDOException;

/**
 * Classe Database
 * @package App\Database
 */
class Database extends PDO
{
      private static $instance; // Contiendra l'instance de notre classe

      private const DBHOST = 'localhost'; // Hôte de la base de données
      private const DBUSER = 'root'; // Nom d'utilisateur de la base de données
      private const DBPASS = ''; // Mot de passe de la base de données
      private const DBNAME = 'portfolio-v2'; // Nom de la base de données

      /**
       * Constructeur
       * @throws PDOException
       */
      private function __construct()
      {
            $dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST; // DSN de connexion

            try {
                  parent::__construct($dsn, self::DBUSER, self::DBPASS); // On appelle le constructeur de la classe PDO
                  $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8'); // On définit le jeu de caractères des échanges avec la base de données
                  $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // On définit le mode de fetch par défaut sur FETCH_OBJ (objet)
                  $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // On active les erreurs sous forme d'exceptions
            } catch (PDOException $e) {
                  die('Erreur : ' . $e->getMessage()); // On arrête l'exécution s'il y a du code après
            }
      }

      /**
       * Méthode permettant de récupérer l'instance de la classe Database
       * @return Database
       */
      public static function getInstance(): self
      {
            // Si on n'a pas encore instancié notre classe.
            if (self::$instance === null) {
                  self::$instance = new self(); // On instancie la classe elle même.
            }
            return self::$instance; // On retourne l'instance elle-même.
      }
}
