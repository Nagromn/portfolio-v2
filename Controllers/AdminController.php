<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\User;

/**
 * Controller administrateur
 * @package App\Controllers
 */

class AdminController extends Controller
{
      /**
       * Affiche la page d'administration
       * @return void
       */
      public function index(): void
      {
            $this->render('admin/index');
      }

      /**
       * Affiche la page d'inscription des utilisateurs par l'administrateur
       * @return void
       */
      public function register(): void
      {
            // Si le formulaire est envoyé et valide
            if (Form::validate($_POST, ['email', 'password'])) {
                  $email = strip_tags($_POST['email']); // On récupère l'email de l'utilisateur
                  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // On hash le mot de passe de l'utilisateur

                  $user = new User; // On instancie un nouvel utilisateur

                  $user->setEmail($email) // On hydrate l'email de l'utilisateur
                        ->setPassword($password); // On hydrate le mot de passe de l'utilisateur

                  $user->create(); // On crée l'utilisateur en BDD

                  header('Location: ../../public/main/index'); // On redirige vers la page de connexion de l'administrateur
                  exit;
            }

            $form = new Form; // On instancie un nouvel objet Form

            // On crée le formulaire d'inscription des utilisateurs par l'administrateur
            $form->formStart()
                  ->addLabel('email', 'Email : ')
                  ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'required' => true])
                  ->addLabel('password', 'Mot de passe : ')
                  ->addInput('password', 'password', ['id' => 'password', 'class' => 'form-control', 'autofocus' => true])
                  ->addSubmit('S\'inscrire', ['class' => 'btn btn-primary mt-3'])
                  ->formEnd();

            $this->render('admin/register', ['registerForm' => $form->create()]); // On affiche la page d'inscription des utilisateurs par l'administrateur
      }

      /**
       * Affiche la page de login de l'administrateur
       * @return void
       */
      public function login(): void
      {
            if (Form::validate($_POST, ['email', 'password'])) { // Si le formulaire est envoyé et valide
                  $user = new User; // On instancie un nouvel utilisateur
                  $existingUser = $user->findByEmail(strip_tags($_POST['email'])); // On vérifie l'adresse email

                  if (!$existingUser) {
                        $_SESSION['error'] = 'L\'adresse email n\'existe pas';
                        header('Location: ../../public/admin/login');
                        exit;
                  }

                  $user->hydrate($existingUser); // On hydrate l'utilisateur

                  if (password_verify($_POST['password'], $user->getPassword())) { // Si le mot de passe est correct
                        $user->sessionInit(); // On initialise la session de l'utilisateur
                        $_SESSION['success'] = 'Vous êtes connecté'; // On envoie un message de succès
                        header('Location: ../../public/admin/index'); // On redirige vers la page d'administration
                        exit;
                  } else {
                        $_SESSION['error'] = 'Le mot de passe est incorrect'; // On envoie un message d'erreur
                        header('Location: ../../public/admin/login'); // On redirige vers la page de connexion de l'administrateur
                        exit;
                  }
            }

            $form = new Form; // On instancie un nouvel objet Form

            // On crée le formulaire de connexion de l'administrateur
            $form->formStart()
                  ->addLabel('email', 'Email : ')
                  ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'required' => true])
                  ->addLabel('password', 'Mot de passe : ')
                  ->addInput('password', 'password', ['id' => 'password', 'class' => 'form-control', 'autofocus' => true])
                  ->addSubmit('Se connecter', ['class' => 'btn btn-primary mt-3'])
                  ->formEnd();

            $this->render('admin/login', ['loginForm' => $form->create()]); // On affiche la page de connexion de l'administrateur
      }

      /**
       * Méthode permettant de déconnecter l'administrateur
       * @return void
       */
      public function logout(): void
      {
            unset($_SESSION['user']); // On supprime la session de l'utilisateur
            header('Location: ../../public/main/index'); // Rediriger vers la page de connexion de l'administrateur
            exit();
      }
}
