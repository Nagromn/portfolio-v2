<?php

namespace App\Models;

class User extends Model
{
      protected string $table = 'user';
      protected int $id;
      protected string $username;
      protected string $email;
      protected string $password;
      protected bool $isAdmin = false;

      public function __construct()
      {
            $this->table = 'user';
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
       * Get the value of username
       */
      public function getUsername(): string
      {
            return $this->username;
      }

      /**
       * Set the value of username
       * @return  self
       */
      public function setUsername($username): self
      {
            $this->username = $username;

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
