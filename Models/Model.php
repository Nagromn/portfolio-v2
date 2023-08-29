<?php

namespace App\Models;

use App\Core\Database;

/**
 * Model classe parente de tous les models permettant de gérer les requêtes SQL génériques à tous les models enfants (findAll, findBy, find, create, update, delete)
 * @package App\Models
 */
class Model extends Database
{
      protected $table; // Nom de la table en BDD
      protected $id; // ID de l'enregistrement
      private $db; // Instance de PDO

      /**
       * Méthode permettant de récupérer tous les enregistrements d'une table
       * @return array
       */
      public function findAll(): array
      {
            $query = $this->runQuery("SELECT * FROM {$this->table}"); // On stocke la requête SQL dans une variable
            return $query->fetchAll(); // On retourne le résultat de la requête
      }

      /**
       * Méthode permettant de récupérer tous les enregistrements d'une table en fonction de critères
       * @param array $params Tableau associatif contenant les critères
       * @return array
       */
      public function findBy(array $params): array
      {
            $fields = []; // On initialise un tableau vide
            $values = []; // On initialise un tableau vide

            // On boucle sur le tableau $params
            foreach ($params as $field => $value) {
                  $fields[] = "$field = ?"; // On stocke chaque champ dans le tableau $fields
                  $values[] = $value; // On stocke chaque valeur dans le tableau $values
            }

            $fields_list = implode(' AND ', $fields); // On transforme le tableau $fields en chaîne de caractères

            return $this->runQuery("SELECT * FROM {$this->table} WHERE $fields_list", $values)->fetchAll(); // On retourne le résultat de la requête
      }

      /**
       * Méthode permettant de récupérer un enregistrement d'une table en fonction de son ID
       * @param int $id ID de l'enregistrement
       * @return mixed
       */
      public function find(int $id): mixed
      {
            $query = $this->runQuery("SELECT * FROM {$this->table} WHERE id = $id"); // On stocke la requête SQL dans une variable
            return $query->fetch(); // On retourne le résultat de la requête
      }

      /**
       * Méthode permettant d'insérer un enregistrement
       * @return \PDOStatement
       */
      public function create(): \PDOStatement
      {
            $fields = []; // On initialise un tableau vide
            $inter = []; // On initialise un tableau vide
            $values = []; // On initialise un tableau vide

            // On boucle sur le tableau $model
            foreach ($this as $field => $value) {
                  // On vérifie si la valeur est différente de null
                  if ($value !== null && $field !== 'table' && $field !== 'db') {
                        $fields[] = "$field"; // On stocke chaque champ dans le tableau $fields
                        $inter[] = "?"; // On stocke chaque champ dans le tableau $inter
                        $values[] = $value; // On stocke chaque valeur dans le tableau $values
                  }
            }

            $fields_list = implode(', ', $fields); // On transforme le tableau $fields en chaîne de caractères
            $inter_list = implode(', ', $inter); // On transforme le tableau $inter en chaîne de caractères

            return $this->runQuery("INSERT INTO {$this->table} ($fields_list) VALUES ($inter_list)", $values); // On retourne le résultat de la requête
      }

      /**
       * Méthode permettant de mettre à jour un enregistrement
       * @return \PDOStatement
       */
      public function update(): \PDOStatement
      {
            $fields = []; // On initialise un tableau vide
            $values = []; // On initialise un tableau vide

            // On boucle sur le tableau $model
            foreach ($this as $field => $value) {
                  // On vérifie si la valeur est différente de null
                  if ($value !== null && $field !== 'table' && $field !== 'db') {
                        $fields[] = "$field = ?"; // On stocke chaque champ dans 
                        $values[] = $value; // On stocke chaque valeur dans le tableau $values
                  }
            }

            $values[] = $this->id; // On ajoute l'id à la fin du tableau $values
            $fields_list = implode(', ', $fields); // On transforme le tableau $fields en chaîne de caractères

            return $this->runQuery("UPDATE {$this->table} SET $fields_list WHERE id = ?", $values); // On retourne le résultat de la requête
      }

      /**
       * Méthode permettant de supprimer un enregistrement
       * @param int $id ID de l'enregistrement
       * @return \PDOStatement
       */
      public function delete(int $id): \PDOStatement
      {
            return $this->runQuery("DELETE FROM {$this->table} WHERE id = ?", [$id]); // On retourne le résultat de la requête
      }

      /**
       * Méthode permettant d'exécuter une requête SQL
       * @param string $sql Requête SQL
       * @param array|null $attributes Tableau contenant les paramètres de la requête SQL
       * @return \PDOStatement
       */
      public function runQuery(string $sql, ?array $attributes = null): \PDOStatement
      {
            $this->db = Database::getInstance(); // On récupère l'instance de PDO

            // On vérifie si on a des paramètres ou non
            if ($attributes !== null) {
                  $query = $this->db->prepare($sql); // On prépare la requête SQL
                  $query->execute($attributes); // On exécute la requête en passant les paramètres
                  return $query; // On retourne le résultat de la requête
            } else {
                  return $this->db->query($sql); // On retourne le résultat de la requête
            }
      }

      /**
       * Méthode permettant d'hydrater un objet
       * @param $data Tableau contenant les données à hydrater
       * @return Model
       */
      public function hydrate($data): Model
      {
            // On boucle sur le tableau $data
            foreach ($data as $key => $value) {
                  $method = 'set' . ucfirst($key); // On définit le nom de la méthode en fonction de la clé

                  // On vérifie si la méthode existe
                  if (method_exists($this, $method)) {
                        $this->$method($value); // On appelle la méthode
                  }
            }
            return $this; // On retourne l'objet $this pour permettre les appels en chaîne
      }
}
