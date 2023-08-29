<?php

namespace App\Models;

class ProjectCategory extends Model
{
      protected $table = 'project_category'; // Nom de la table intermédiaire
      protected $project_id;
      protected $category_id;

      public function __construct()
      {
            $this->table = 'project_category'; // Définition du nom de la table
      }

      public function getProjectId()
      {
            return $this->project_id;
      }

      public function setProjectId($project_id)
      {
            $this->project_id = $project_id;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }

      public function getCategoryId()
      {
            return $this->category_id;
      }

      public function setCategoryId($category_id)
      {
            $this->category_id = $category_id;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }
}
