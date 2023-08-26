<?php

namespace App\Models;

/**
 * Model permettant de gérer les catégories
 * @package App\Models
 */
class Category extends Model
{
      protected $id;
      protected $name;

      public function __construct()
      {
            $this->table = 'category'; // Définition du nom de la table
      }

      public function getId()
      {
            return $this->id;
      }

      public function setId($id)
      {
            $this->id = $id;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }

      public function getName()
      {
            return $this->name;
      }

      public function setName($name)
      {
            $this->name = $name;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }
}