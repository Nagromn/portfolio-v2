<?php

namespace App\Models;

use DateTime;

/**
 * Model permettant de gérer les projets
 * @package App\Models
 */
class Project extends Model
{
      protected string $projectName;
      protected string $content;
      protected string $createdAt;
      protected string $updatedAt;
      protected int $user_id;

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
      public function setId(int $id): self
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
      public function setProjectName(string $projectName): self
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
      public function setContent(string $content): self
      {
            $this->content = $content;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }

      /**
       * Get the value of createdAt
       */
      public function getCreatedAt(): string
      {
            return $this->createdAt;
      }

      /**
       * Set the value of createdAt
       * @return  self
       */
      public function setCreatedAt(string $createdAt): self
      {
            $this->createdAt = $createdAt;
            return $this; // Retourne l'objet $this pour permettre les appels en chaîne
      }

      /**
       * Get the value of updatedAt
       */
      public function getUpdatedAt(): string
      {
            return $this->updatedAt;
      }

      /**
       * Set the value of updatedAt
       *
       * @return  self
       */
      public function setUpdatedAt(string $updatedAt): self
      {
            $this->updatedAt = $updatedAt;

            return $this;
      }

      /**
       * Get the value of user_id
       */
      public function getUserId(): int
      {
            return $this->user_id;
      }

      /**
       * Set the value of user_id
       *
       * @return  self
       */
      public function setUserId(int $user_id): self
      {
            $this->user_id = $user_id;

            return $this;
      }
}
