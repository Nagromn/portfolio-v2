<?php

namespace App\Models;

class User extends Model
{
      protected string $email;
      protected string $password = '';
      protected bool $isAdmin = false;

      public function __construct()
      {
            $this->table = 'user'; // Définition du nom de la table
      }

      /**
       * Méthode permettant de récupérer un enregistrement d'une table en fonction de son email
       * @param string $email
       * @return mixed
       */
      public function findByEmail(string $email): mixed
      {
            return $this->runQuery("SELECT * FROM {$this->table} WHERE email = ?", [$email])->fetch();
      }

      /**
       * Méthode permettant d'initiliaser la session de l'utilisateur
       * @return void
       */
      public function sessionInit(): void
      {
            $_SESSION['user'] = [
                  'id' => $this->id,
                  'email' => $this->email,
                  'isAdmin' => $this->isAdmin
            ];
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

            return $this;
      }

      /**
       * Get the value of email
       */
      public function getEmail(): string
      {
            return $this->email;
      }

      /**
       * Set the value of email
       * @return  self
       */
      public function setEmail($email): self
      {
            $this->email = $email;

            return $this;
      }

      /**
       * Get the value of password
       */
      public function getPassword(): string
      {
            return $this->password;
      }

      /**
       * Set the value of password
       * @return  self
       */
      public function setPassword($password): self
      {
            $this->password = $password;

            return $this;
      }

      /**
       * Get the value of isAdmin
       */
      public function getIsAdmin(): bool
      {
            return $this->isAdmin;
      }

      /**
       * Set the value of isAdmin
       * @return  self
       */
      public function setIsAdmin($isAdmin): self
      {
            $this->isAdmin = $isAdmin;

            return $this;
      }
}
