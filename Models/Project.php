<?php

namespace App\Models;

use DateTime;

/**
 * Model permettant de gérer les projets
 * @package App\Models
 */
class Project extends Model
{
      protected int $id;
      protected string $projectName;
      protected string $content;
      protected DateTime $created_at;

      public function __construct()
      {
            $this->table = 'project'; // Définition du nom de la table
      }

      /**
       * Get the value of id
       */
      public function getId(): int
      {
            return $this->id;
      }

      /**
       * Set the value of id
       * @return  self
       */
      public function setId($id): self
      {
            $this->id = $id;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }

      /**
       * Get the value of projectName
       */
      public function getProjectName(): string
      {
            return $this->projectName;
      }

      /**
       * Set the value of projectName
       * @return  self
       */
      public function setProjectName($projectName): self
      {
            $this->projectName = $projectName;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }

      /**
       * Get the value of content
       */
      public function getContent(): string
      {
            return $this->content;
      }

      /**
       * Set the value of content
       * @return  self
       */
      public function setContent($content): self
      {
            $this->content = $content;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }

      /**
       * Get the value of created_at
       */
      public function getCreatedAt(): DateTime
      {
            return $this->created_at;
      }

      /**
       * Set the value of created_at
       * @return  self
       */
      public function setCreatedAt($created_at): self
      {
            $this->created_at = $created_at;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }
}
